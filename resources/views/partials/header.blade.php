<header class="wgn-nav-bar">
    <div class="brand">
        <a class="logo" href="#">
            {!! HTML::image('images/logo.png', 'WeGovNow') !!}
            <span class="slogan">WeGovNow <br> Test Community</span>
        </a>
    </div>

    <nav id="nav-menu" class="nav-menu">
        @foreach($uwumNavigation as $navigation => $items)
            @foreach($items as $item)
                @if($loop->parent->first && $loop->first)
                <ul>
                @endif

                @if(!$loop->last)
                <li>
                    <a @if(isset($item['active']) && true == $item['active']) class="active" @endif href="{{ $item['url'] }}">
                        <span class="anchor-name">{{ $item['name'] }}</span>
                        <span class="anchor-slogan">{{ $item['description'] }}</span>
                    </a>
                </li>
                @endif

                @if($loop->parent->last && $loop->last)
                </ul>

                <a class="account-btn" href="{{ $item['url'] }}">
                    <span class="anchor-name">{{ $item['name'] }}</span>
                    <span class="anchor-slogan">{{ $item['description'] }}</span>
                </a>
                @endif
            @endforeach
        @endforeach
    </nav>


    <button id="mobile-menu-btn" class="mobile-menu-btn">
        <div>
            <span class="custom-icon-bar"></span>
            <span class="custom-icon-bar"></span>
            <span class="custom-icon-bar"></span>
        </div>
    </button>
</header>