<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li><a href="{{route('dashboard.index')}}" class="" aria-expanded="false">
                    <i class="flaticon-025-dashboard"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-locations"></i>
                    <span class="nav-text">Countries & cities</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('dashboard.country.index')}}">Countries</a></li>
                    <li><a href="{{route('dashboard.city.index')}}">Cities</a></li>
                </ul>

            </li>
        </ul>
    </div>
</div>
