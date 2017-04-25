@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container home-container">
            <div class="card-panel yellow lighten-3">{{ $alert1 }}</div>

            <div class="row">
                <div class="col l7">
                    <h1 class="h4">{{ $heading1 }}</h1>

                    <ul class="numbered-list">
                        <li>{{ $listOption1 }}</li>
                        <li>{{ $listOption2 }}</li>
                        <li>{{ $listOption3 }}</li>
                        <li>{{ $listOption4 }}</li>
                    </ul>
                </div>

                <div class="col l5">
                    <div class="social-linking">
                        <h2 class="h5">{{ $heading2 }}</h2>

                        {{--<a id="facebook-btn" class="waves-effect waves-light btn light-blue darken-4" onclick="centerWindow(600, 400, 50, '{{ url('login/facebook') }}', 'facebook');">{{ $socialBtnFb }}</a>--}}
                        <a class="waves-effect waves-light btn light-blue darken-4" href="{{ url('login/facebook') }}">{{ $socialBtnFb }}</a>
                        <a class="waves-effect waves-light btn red" href="{{ url('login/google') }}">{{ $socialBtnGgl }}</a>
                        <a class="waves-effect waves-light btn red darken-4">{{ $socialBtnPint }}</a>
                        <a class="waves-effect waves-light btn light-blue darken-3" href="{{ url('login/linkedin') }}">{{ $socialBtnLin }}</a>
                    </div>
                </div>
            </div>

            <div class="bottom-msg center-align">{{ $alert2 }}</div>
        </div>
    </div>
@endsection

@section('jslibs')
    <script>
        function centerWindow(windowWidth, windowHeight, windowOuterHeight, url, wname, features) {
            var centerLeft = parseInt((window.screen.availWidth - windowWidth) / 2);
            var centerTop = parseInt(((window.screen.availHeight - windowHeight) / 2) - windowOuterHeight);

            var misc_features;
            if (features) {
                misc_features = ', ' + features;
            }
            else {
                misc_features = ', status=no, location=no, scrollbars=yes, resizable=yes';
            }

            var windowFeatures = 'width=' + windowWidth + ',height=' + windowHeight + ',left=' + centerLeft + ',top=' + centerTop + misc_features;
            var win = window.open(url, wname, windowFeatures);
            win.focus();

            return win;
        }
    </script>
@endsection