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
                    <div class="profile-section social-accounts-section">
                        <h4 class="h6">{{ $profileHeading1 }}</h4>

                        <ul>
                            <li class="social-account-item facebook-item">
                                <span>{{ $socialBtnFb }}</span>
                                <div class="switch">
                                    <label>
                                        <i>Off</i>
                                        {!! Form::checkbox('facebook-chk', 1, true, ['id' => 'facebook-chk']) !!}
                                        <span class="lever"></span>
                                        <i>On</i>
                                    </label>
                                </div>
                            </li>

                            <li class="social-account-item google-item">
                                <span>{{ $socialBtnGgl }}</span>
                                <div class="switch">
                                    <label>
                                        <i>Off</i>
                                        {!! Form::checkbox('google-chk', 1, false, ['id' => 'google-chk']) !!}
                                        <span class="lever"></span>
                                        <i>On</i>
                                    </label>
                                </div>
                            </li>

                            <li class="social-account-item pinterest-item">
                                <span>{{ $socialBtnPint }}</span>
                                <div class="switch">
                                    <label>
                                        <i>Off</i>
                                        {!! Form::checkbox('pinterest-chk', 1, false, ['id' => 'pinterest-chk']) !!}
                                        <span class="lever"></span>
                                        <i>On</i>
                                    </label>
                                </div>
                            </li>

                            <li class="social-account-item linkedin-item">
                                <span>{{ $socialBtnLin }}</span>
                                <div class="switch">
                                    <label>
                                        <i>Off</i>
                                        {!! Form::checkbox('linkedin-chk', 1, false, ['id' => 'linkedin-chk']) !!}
                                        <span class="lever"></span>
                                        <i>On</i>
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('jslibs')
    <script>

    </script>
@endsection
