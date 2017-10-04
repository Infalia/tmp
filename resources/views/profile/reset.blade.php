@extends('layouts.app')

@section('content')
    <div class="content">
        @include('partials.sidebar')

        <div class="profile-container">
            <div class="row">
                <div class="col s12">
                    <h1 class="h4">{{ $profileBasicHeading1 }}</h1>
                </div>
            </div>

            <div class="row">
                <div class="col s12 m4 l3">
                    @include('partials.profile-menu')
                </div>

                <div class="col s12 m8 l9 xl6">
                    <h4 class="h5">{{ $profileHeading1 }}</h4>
                    <br>
                    <div class="card-panel red lighten-1 white-text">To erase your WeGovNow personal data, actions, timeline and log files, click the button "RESET DATA" below. All WeGovNow data that are related to your profile will be erased permanently. Please note that this action cannot undone.</div>
                    <br><br>
                    <a class="waves-effect waves-light btn right"><i class="material-icons left">clear</i> RESET DATA</a>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('jslibs')
    <script>
        
    </script>
@endsection
