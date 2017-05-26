<div class="collection">
    <a href="{{ url('profile/basic-info') }}" class="collection-item @if ($routeUri == 'profile/basic-info') active @endif">{{ $profileOption1 }}</a>
    <a href="{{ url('profile/work') }}" class="collection-item @if ($routeUri == 'profile/work') active @endif">{{ $profileOption2 }}</a>
    <a href="{{ url('profile/interests') }}" class="collection-item @if ($routeUri == 'profile/interests') active @endif">{{ $profileOption3 }}</a>
    <a href="{{ url('profile/social-accounts') }}" class="collection-item @if ($routeUri == 'profile/social-accounts') active @endif">{{ $profileOption4 }}</a>
    <a href="{{ url('profile/reset') }}" class="collection-item @if ($routeUri == 'profile/reset') active @endif">{{ $profileOption5 }}</a>
</div>