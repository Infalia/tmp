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
                <div class="col m4 l3">
                    @include('partials.profile-menu')
                </div>

                <div class="col m8 l9 xl6">

                    {!! Form::open(['id' => 'basic-info-form']) !!}

                    <div class="row">
                        <div class="input-field col s12">
                            {!! Form::email('email', 'example@gmail.com', ['id' => 'email', 'class' => 'validate', 'placeholder' => $emailPldr, 'maxlength' => '30', 'disabled' =>'disabled']) !!}
                            {!! Form::label('email', $emailLbl, ['class' => 'active']) !!}
                        </div>

                        <div class="input-field col s12">
                            {!! Form::text('phone_num', '', ['id' => 'phone_num', 'class' => 'validate', 'placeholder' => $phonePldr, 'maxlength' => '16']) !!}
                            {!! Form::label('phone_num', $phoneLbl, ['class' => 'active']) !!}
                        </div>

                        <div class="input-field col s12">
                            {!! Form::date('birthday', '', ['id' => 'birthday', 'class' => 'datepicker', 'placeholder' => $birthdayPldr]) !!}
                            {!! Form::label('birthday', $birthdayLbl, ['class' => 'active']) !!}
                        </div>

                        <div class="input-field col s12">
                            {!! Form::date('nameday', '', ['id' => 'nameday', 'class' => '', 'placeholder' => $namedayPldr]) !!}
                            {!! Form::label('nameday', $namedayLbl, ['class' => 'active']) !!}
                        </div>

                        <div class="form-radios col s12">
                            <div class="inline-radio">
                                {!! Form::radio('gender', 'male', false, ['id' => 'male']) !!}
                                {!! Form::label('male', $maleLbl, ['class' => 'active']) !!}
                            </div>

                            <div class="inline-radio">
                                {!! Form::radio('gender', 'female', false, ['id' => 'female']) !!}
                                {!! Form::label('female', $femaleLbl, ['class' => 'active']) !!}
                            </div>
                        </div>

                        <div class="input-field col s12">
                            {!! Form::label('languages', $languagesLbl, ['class' => 'active']) !!}
                            {!! Form::select('languages', ['En_UK' => 'English UK', 'En_US' => 'English US', 'El_GR' => 'Greek'], null, ['id' => 'languages', 'multiple' => true]) !!}
                        </div>

                        <div class="input-field col s12">
                            {!! Form::textarea('bio', '', ['id' => 'bio', 'class' => 'materialize-textarea', 'placeholder' => $bioPldr]) !!}
                            {!! Form::label('bio', $bioLbl, ['class' => 'active']) !!}
                        </div>

                        <div class="col s12">
                            {!! Form::button($cancelBtn, array('id' => 'profile-cancel-btn', 'class' => 'waves-effect waves-light btn-flat')) !!}
                            {!! Form::button($saveBtn, array('id' => 'profile-save-btn', 'class' => 'waves-effect waves-light btn')) !!}
                        </div>

                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>
@endsection

@section('jslibs')
    <script>
        $('#birthday').pickadate({
            selectMonths: true,
            selectYears: 70,
            min: -25550,
            max: -5840,
            today: false,
            close: false,
            clear: false,
            closeOnSelect: true,
            onClose: function() {
                $('.datepicker').blur();
                $('.picker').blur();
            }
        });

        $('#nameday').pickadate({
            selectMonths: true,
            selectYears: false,
            today: false,
            close: false,
            clear: false,
            closeOnSelect: true,
            onClose: function() {
                $('.datepicker').blur();
                $('.picker').blur();
            }
        });

        $(document).ready(function() {
            $('select').material_select();
        });
    </script>
@endsection
