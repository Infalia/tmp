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

                @if(!empty($socialNetworks))
                <div class="col s12 m8 l9 xl6">
                    <div class="profile-section social-accounts-section">
                        <h4 class="h6">{{ $profileHeading1 }}</h4>

                        <ul>
                            @foreach($socialNetworks as $socialNetwork)
                            @php
                                $exists = false;

                                foreach($userSocialNetworks as $userSocialNetwork) {
                                    if($socialNetwork->id == $userSocialNetwork->id) {
                                        $exists = true;
                                    }
                                }
                            @endphp
                            <li class="social-account-item {{ $socialNetwork->class_name }}">
                                <span>{{ __('messages.profile_social_accounts_btn', ['socialNetwork' => $socialNetwork->title, 'isLinked' => ($exists ? '' : 'not')]) }}</span>
                                <div class="switch">
                                    <label>
                                        <i>{{ $switchOff }}</i>
                                        {!! Form::checkbox('facebook-chk', $socialNetwork->id, $exists, ['id' => 'facebook-chk']) !!}
                                        <span class="lever"></span>
                                        <i>{{ $switchOn }}</i>
                                    </label>
                                </div>
                            </li>
                            @endforeach

                            {{-- <li class="social-account-item google-item">
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
                            </li> --}}
                        </ul>
                    </div>
                </div>
                @endif
            </div>
        </div>

    </div>
@endsection

@section('jslibs')
    <script>

    </script>
@endsection
