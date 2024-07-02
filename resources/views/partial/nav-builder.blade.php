@php
    $users = \Auth::user();
    $currantLang = $users->currentLanguage();
    $logo = asset('uploads/logo/');
    $checkIsHotelCreated = DB::table('hotel_profiles')->where('user_id', Auth::id())->first();
@endphp
<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
        <img class="c-sidebar-brand-full"
            src="{{ $logo . (isset($company_logo) && !empty($company_logo) ? $company_logo : '/light_logo.png') }}"
            height="46" class="navbar-brand-img">
        <img class="c-sidebar-brand-minimized"
            src="{{ $logo . (isset($company_logo) && !empty($company_logo) ? $company_logo : '/small_logo.png') }}"
            height="46" class="navbar-brand-img">
    </div>
    <ul class="c-sidebar-nav ps ps--active-y">
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ url('/dashboard') }}">
                <i class="cil-speedometer c-sidebar-nav-icon"></i> {{ __('Dashboard') }}</a>
        </li>
        @can('manage-user')
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('users.index') }}">
                    <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Users') }}
                </a>
            </li>
        @endcan

        @role('admin')
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('criminals.index') }}">
                    <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Criminals') }}
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('admin.report') }}">
                    <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Report') }}
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('admin.irregular_checkin') }}">
                    <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Irregular Check Ins ') }}
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('admin.suspicious_checkins') }}">
                    <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Suspicicous Check Ins ') }}
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('messages') }}">
                    <i class="cil-chat-bubble c-sidebar-nav-icon"></i>{{ __('Messages ') }}
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('admin.queries') }}">
                    <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Queries ') }}
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('hotel_report.report') }}">
                    <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Hotel Report') }}
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a href="{{ url('/notificationsettings') }}" class="c-sidebar-nav-link">
                    <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Notification Settings') }}
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a href="{{ url('/countries') }}" class="c-sidebar-nav-link">
                    <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Countries') }}
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a href="{{ url('/states') }}" class="c-sidebar-nav-link">
                    <i class="cil-user c-sidebar-nav-icon"></i>{{ __('States') }}
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a href="{{ url('/districts') }}" class="c-sidebar-nav-link">
                    <i class="cil-user c-sidebar-nav-icon"></i>{{ __('District') }}
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a href="{{ url('/cities') }}" class="c-sidebar-nav-link">
                    <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Cities') }}
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a href="{{ url('/police_stations') }}" class="c-sidebar-nav-link">
                    <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Police Station') }}
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a href="{{ url('/plans') }}" class="c-sidebar-nav-link">
                    <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Plans') }}
                </a>
            </li>
        @endrole
        @role('viewer')
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('admin.report') }}">
                    <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Report') }}
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('viewer_report.report') }}">
                    <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Hotel Report') }}
                </a>
            </li>
        @endrole
        @role('free')
            @if ($checkIsHotelCreated && ($checkIsHotelCreated->city != null || $checkIsHotelCreated->police_station != null))
                @can('show-Booking')
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{ route('booking.index') }}">
                            <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Bookings') }}
                        </a>
                    </li>
                @endcan
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{ route('guest.create') }}">
                        <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Guest Check In') }}
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{ route('guest.list') }}">
                        <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Guest Check Out') }}
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{ route('order.index') }}">
                        <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Order') }}
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{ route('messages') }}">
                        <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Messages ') }}
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{ route('guest.queries') }}">
                        <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Queries ') }}
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{ route('guest.report') }}">
                        <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Report') }}
                    </a>
                </li>
                @can('show-System Management')
                    <li class="c-sidebar-nav-item">
                        <a href="{{ url('/system_management') }}" class="c-sidebar-nav-link">
                            <i class="cil-cog c-sidebar-nav-icon"></i>{{ __('System Management') }}
                        </a>
                    </li>
                @endcan
                @can('show-food')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{ route('food.management') }}">
                        <i class="cil-fastfood c-sidebar-nav-icon"></i>{{ __('Food') }}
                    </a>
                </li>
                @endcan
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{ route('upgrade_plan') }}">
                        <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Upgrade Plan') }}
                    </a>
                </li>
                @can('show-inventory')
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{ route('stock_inventory') }}">
                            <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Stock & Inventory') }}
                        </a>
                    </li>
                @endcan
                @can('show-housekeeping')
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{ route('housekeeping.index') }}">
                            <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Housekeeping') }}
                        </a>
                    </li>
                @endcan
                @can('show-laundry')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{ route('laundry.index') }}">
                        <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Laundry') }}
                    </a>
                </li>
                @endcan
                @can('show-vendor')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{ route('vendors_management') }}">
                        <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Vendors') }}
                    </a>
                </li>
                @endcan
                @can('show-expense')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{ route('expenses.management') }}">
                        <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Expenses') }}
                    </a>
                </li>
                @endcan
            @endif
            <li class="c-sidebar-nav-item">
                @if ($checkIsHotelCreated)
                    {{-- <a class="c-sidebar-nav-link" href="{{ asset(url('edit-hotel/'.$checkIsHotelCreated->id)) }}">
                <i class="cil-building c-sidebar-nav-icon"></i>{{ __('Edit Hotel') }}
            </a> --}}
                @else
                    <a class="c-sidebar-nav-link" href="{{ route('add-hotel') }}">
                        <i class="cil-building c-sidebar-nav-icon"></i>{{ __('Add Hotel') }}
                    </a>
                @endif
            </li>
        @endrole
        @include('layouts.menu')
    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
        data-class="c-sidebar-minimized"></button>
</div>
