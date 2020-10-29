<header class="uis-header">
    <div class="container
            uis-header-container">
        <div class="row">
            <div class="col-lg-10 col-sm-12">
                <h1 class="uis-header-title uis-margin-small-top">
                    {{ $title }}

                </h1>
            </div>
            <div class="col-lg-2 col-sm-12">
                <span class="ml-3">
                    <img src=" {{ asset('static/logo/logo.png') }}" alt="Company Logo" style="height: 100px">
                </span>
            </div>
        </div>

        <ul class="uis-subnav uis-subnav-horizontal-scroll">


            <li class="{{ Request::segment(1) == 'events' ? 'uis-active' : ''}}">
                <a href="/events">
                    Events
                </a>
            </li>
            @if (Auth::user()->user_type == 'admin')
            <li class="{{ Request::segment(1) == 'users ' ? 'uis-active' : ''}}">
                <a href="/users">
                    Users
                </a>
            </li>
            @endif

            <li class="{{ Request::segment(1) == 'members' ? 'uis-active' : ''}}">
                <a href="/members">
                    Members
                </a>
            </li>

            <li class="{{ Request::segment(1) == 'settings' ? 'uis-active' : ''}}">
                <a href="/settings">
                    Settings
                </a>
            </li>

        </ul>
    </div>
</header>