@extends('layouts.admin')
@section('content')
<!-- begin:: Bradcrubs -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="javascript:void(0);" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="{{route('dashboard')}}" class="kt-subheader__breadcrumbs-link">
                    Dashboard </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="{{url('admin/therapist')}}" class="kt-subheader__breadcrumbs-link">
                    Therapist </a>  
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="javascript:void(0);" class="kt-subheader__breadcrumbs-link">
                    Add {{$title}} </a>   
            </div>
        </div>         
    </div>
</div>

<!-- end:: Breadcrubms -->

<!-- begin:: Content -->

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <!--Begin::App-->
    <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">
        <!--Begin:: App Aside Mobile Toggle-->
        <button class="kt-app__aside-close" id="kt_user_profile_aside_close">
            <i class="la la-close"></i>
        </button>
        <!--End:: App Aside Mobile Toggle-->
        <!--Begin:: App Content-->
        <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
            <div class="row">
                <div class="col-xl-12">
                    @include('errormessage')
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">{{$title}}<small>{{isset($data->id) ? 'Update': 'Create'}}  </small></h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                    <a href="{{route('therapist.index')}}" class="btn btn-clean btn-icon-sm">
                                        <i class="la la-long-arrow-left"></i>
                                        Back
                                    </a>
                                    &nbsp;                      
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('therapist.update-data') }}" method="POST" id="create_therapist" name="create_therapist"  class="form-horizontal kt-form kt-form--label-right" enctype="multipart/form-data">
                            @csrf                    
                            <input type="hidden" name="id"  id="id" value="{{isset($data->id) ? $data->id: ''}}">
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Name</label>
                                            <div class="col-lg-9 col-xl-4">  
                                                <input type="text" name="name" readonly="readonly" value="{{old('name',isset($data->name)?$data->name:'')}}" id="name" class="form-control" placeholder="therapist name" > 
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Email</label>
                                            <div class="col-lg-9 col-xl-4">  
                                                <input type="text" name="email" readonly="readonly" value="{{old('email',isset($data->email)?$data->email:'')}}" id="email" class="form-control"> 
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Phone Number</label>
                                            <div class="col-lg-9 col-xl-4">  
                                                <input type="text" name="phone_number" readonly="readonly" value="{{old('phone_number',isset($data->phone_number)?$data->phone_number:'')}}" id="phone_number" class="form-control"> 
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">State</label>
                                            <div class="col-lg-9 col-xl-4">  
                                                <input type="text" name="state" readonly="readonly" value="{{old('state',isset($data->state_data)?$data->state_data->name:'')}}" id="state" class="form-control"> 
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Country</label>
                                            <div class="col-lg-9 col-xl-4">  
                                                <input type="text" name="country" readonly="readonly" value="{{old('country',isset($data->country_data)?$data->country_data->name:'')}}" id="country" class="form-control"> 
                                            </div>
                                        </div>
                                        <div class="form-group row col-xl-12 col-lg-12 col-form-label">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Service</label>
                                            <div class="col-lg-9 col-xl-4">  
                                                @foreach($data->service_data as $val)
                                                {{$val->service_name}},
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Status</label>
                                            <div class="col-lg-9 col-xl-4">  
                                                <div class="col-lg-9 col-xl-4">  
                                                    <select class="form-control" id="is_active" name="is_active">
                                                        <option value="0" {{isset($data->is_active) ? $data->is_active == 0 ? 'selected="selected"' : '':'' }}>Pending</option>
                                                        <option value="1" {{isset($data->is_active) ? $data->is_active == 1 ? 'selected="selected"' : '':'' }}>Accept</option>
                                                        <option value="2" {{isset($data->is_active) ? $data->is_active == 2 ? 'selected="selected"' : '':'' }}>Reject</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-portlet__foot">
                                <div class="kt-form__actions">
                                    <div class="row">
                                        <div class="col-lg-3 col-xl-3">
                                        </div>
                                        <div class="col-lg-9 col-xl-9">
                                            <button type="submit" class="btn btn-success">{{$btn}}</button>&nbsp;
                                            <a href="{{route('therapist.index')}}" id="cancel_btn" class="btn btn-secondary">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--End:: App Content-->
    </div>
    <!--End::App-->
</div>
<!-- end :: Contest --> 
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        $.validator.addMethod("alpha", function (value, element) {
            return this.optional(element) || value == value.match(/^[a-zA-Z\s]+$/);
        }, "Letters only please");

        $('#create_therapist').validate({
            rules: {
                is_active: {
                    required: true,
                }
            }
        });
    });
</script>
@endsection
