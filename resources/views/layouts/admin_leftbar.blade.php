<!-- Left Pannel Starts-->
<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">
    <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
        <div class="kt-aside__brand-logo">
            <a href="{{url('admin/dashboard')}}">
                <img alt="Logo" src="{{url('assets/admin/media/logos/logo-light.png')}}" />                                
            </a>
        </div>
        <div class="kt-aside__brand-tools">                                                       
        </div>
    </div>
    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
        <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">
            <ul class="kt-menu__nav ">
                <li class="kt-menu__item  kt-menu__item{{ (Route::is('dashboard')) ? '--active' : '' }}" aria-haspopup="true">
                    <a href="{{url('admin/dashboard')}}" class="kt-menu__link">
                        <span class="kt-menu__link-text">Dashboard</span>
                    </a>
                </li>
                @if(Auth::user()->user_type=="Admin")
                <li class="kt-menu__item  kt-menu__item{{ (Route::is('country.index') || Route::is('country.create') || Route::is('country.edit')) ? '--active' : '' }}" aria-haspopup="true">
                    <a href="{{route('country.index')}}" class="kt-menu__link">
                        <span class="kt-menu__link-text">Country</span>
                    </a>
                </li>
                <li class="kt-menu__item  kt-menu__item{{ (Route::is('states.index') || Route::is('states.create') || Route::is('states.edit')) ? '--active' : '' }}" aria-haspopup="true">
                    <a href="{{route('states.index')}}" class="kt-menu__link">
                        <span class="kt-menu__link-text">State</span>
                    </a>
                </li>
                <li class="kt-menu__item  kt-menu__item{{ (Route::is('services.index') || Route::is('services.create') || Route::is('services.edit')) ? '--active' : '' }}" aria-haspopup="true">
                    <a href="{{route('services.index')}}" class="kt-menu__link">
                        <span class="kt-menu__link-text">Services</span>
                    </a>
                </li>
                <li class="kt-menu__item  kt-menu__item{{ (Route::is('therapist.index') || Route::is('therapist.create') || Route::is('therapist.edit')) ? '--active' : '' }}" aria-haspopup="true">
                    <a href="{{route('therapist.index')}}" class="kt-menu__link">
                        <span class="kt-menu__link-text">Therapist</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>
<!-- Left Pannel Starts-->