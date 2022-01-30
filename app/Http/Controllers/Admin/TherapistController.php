<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\State;
use App\Models\Country;
use App\Models\Services;
use App\Models\TherapistServices;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use App\Notifications\AcceptRejectNotification;

class TherapistController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin.therapist.index', ['title' => "Therapist"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function registrationTherapist() {
        return view('admin.therapist.registration', ["country" => Country::all(), "state" => State::all(), 'services' => Services::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                        'name' => 'required|unique:users,name',
                        'email' => "email|email|unique:users,email",
                        "phone_number" => "required",
                        "state" => "required",
                        "country" => 'required',
                        "services" => 'required|min:1',
                        "services.*" => 'required|min:1',
                        'password' => 'required|string|min:8'
            ]);
            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }
            $recordId = User::updateOrCreate(['id' => $request->id], [
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone_number' => $request->phone_number,
                        'state' => $request->state,
                        'country' => $request->country,
                        "user_type" => 'Therapist',
                        "password" => Hash::make($request->password)
            ]);
            foreach ($request->services as $service) {
                TherapistServices::create(['user_id' => $recordId->id, 'service_id' => $service, 'service_name' => Services::find($service)->name]);
            }
            if ($recordId) {
                $user = User::where(['user_type' => 'Admin'])->first();
                $statuts = [2 => 'Reject', 1 => 'Accept', 0 => 'Pending'];
                $data = [
                    'subject' => 'Hi ' . $user->name . ',',
                    'body' => $request->name . ' is Registration as a therapist Can you please review Application and Accept or Reject it',
                    'thanks' => 'Thank you for being with us!',
                ];
                $user->notify(new AcceptRejectNotification($data));
                session()->flash('success', 'Registration successfully');
            } else {
                session()->flash('error', "There is some thing went, Please try after some time.");
            }
            return redirect()->route('login');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->route('registration-therapist');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return Datatables::of(User::with(['country_data', 'state_data'])->where(['user_type' => 'Therapist'])->get())->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        return view('admin.therapist.create', ['title' => "Therapist", 'btn' => "Update", 'data' => User::with(['service_data', 'country_data', 'state_data'])->find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        
    }

    public function updateData(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                        'is_active' => 'required',
            ]);
            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }
            $recordId = User::updateOrCreate(['id' => $request->id], [
                        "is_active" => $request->is_active
            ]);
            if ($recordId) {
                $user = User::find($request->id);
                $statuts = [2 => 'Reject', 1 => 'Accept', 0 => 'Pending'];
                $data = [
                    'subject' => 'Hi ' . $user->name . ',',
                    'body' => 'your Account is ' . $statuts[$request->is_active],
                    'thanks' => 'Thank you for being with us!',
                ];
                $user->notify(new AcceptRejectNotification($data));
                session()->flash('success', 'Update successfully');
            } else {
                session()->flash('error', "There is some thing went, Please try after some time.");
            }
            return redirect()->route('therapist.index');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->route('therapist.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $data = User::find($id);
        $data->delete();
        $response = array('status' => 'success', 'msg' => 'Record Deleted Successfully.');
        return response()->json($response);
    }

}
