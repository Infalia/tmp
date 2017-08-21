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
                                        {!! Form::checkbox(mb_convert_case($socialNetwork->title.'-chk', MB_CASE_LOWER, "UTF-8"), url('login/'.mb_convert_case($socialNetwork->title, MB_CASE_LOWER, "UTF-8")), $exists, ['id' => $socialNetwork->id, 'class' => 'social-chk']) !!}
                                        <span class="lever"></span>
                                        <i>{{ $switchOn }}</i>
                                    </label>
                                </div>
                            </li>
                            @endforeach
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
        $('.social-chk').change(function() {
            if($(this).is(":checked")) {
                window.location.href = this.value;
            }
            else {
                data = new Object();
                data['id'] = $(this).attr('id');
                
                var url = "{{ url('account/remove') }}";

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: data,
                    dataType: 'json',
                    success: function(data) {},
                    error : function(XMLHttpRequest, textStatus, errorThrown) {}
                });
            }
        });
    </script>
@endsection
