<div class="sidebar-nav side-nav fixed">
    <div class="userView">
        <div class="background">
            {!! HTML::image('images/abstract.jpg', 'user-bg') !!}
        </div>

        @if(isset($user) && !empty($user->userDetails->image))
        {!! HTML::image('storage/users/'.$user->userDetails->image, 'user', array('class' => 'circle')) !!}
        @else
        {!! HTML::image('images/user.png', 'user', array('class' => 'circle')) !!}
        @endif

        @if(isset($user))
        <span class="white-text name">{{ $user->name }}</span>
        @else
        <span class="white-text name">Unknown user</span>
        @endif

        <span class="white-text email">Reputation score 70%</span>
    </div>

    <div class="sidebar-nav-options">
        <ul>
            <li><a href="{{ url('offer/new') }}" class="waves-effect"><i class="material-icons">toll</i>{{ $sidebarOption1 }}</a></li>
            {{--  <li><a href="#!" class="waves-effect"><i class="material-icons">dashboard</i>{{ $sidebarOption2 }}</a></li>  --}}
            <li><a href="{{ url('offers') }}" class="waves-effect @if ($routeUri == 'offers') active @endif"><i class="material-icons">list</i>{{ $sidebarOption3 }}</a></li>
            <li><a href="{{ url('timeline') }}" class="waves-effect @if ($routeUri == 'timeline') active @endif"><i class="material-icons">perm_identity</i>{{ $sidebarOption4 }}</a></li>
            <li><a href="{{ url('notifications') }}" class="waves-effect @if ($routeUri == 'notifications') active @endif"><i class="material-icons">snooze</i>{{ $sidebarOption5 }} <span class="new badge">4</span></a></li>
            <li><a href="#!" class="waves-effect"><i class="material-icons">power_settings_new</i>{{ $sidebarOption6 }}</a></li>
        </ul>

        <div class="divider"></div>

        <div class="sidebar-inline-options">
            <a href="{{ url('profile/basic-info') }}"><i class="material-icons inline-icon">settings</i> {{ $sidebarOption7 }}</a>
            <a href="#!"><i class="material-icons inline-icon">info</i> {{ $sidebarOption8 }}</a>
        </div>
    </div>
</div>