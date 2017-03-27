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
                    <div class="profile-section position-section">
                        <h2 class="h6">{{ $profileHeading1 }}</h2>

                        <ul>
                            @for ($i = 0; $i < 2; $i++)
                                <li @if ($i == 0) class="current" @endif>
                                    <span class="profile-section-heading">Some company {{ $i+1 }}</span>
                                    <span class="profile-section-city">{{ $profileLbl1 }}: Some city {{ $i+1 }}</span>
                                    <span class="profile-section-role grey-text text-darken-1">{{ $profileLbl2 }}: Some role {{ $i+1 }}</span>
                                    @if ($i == 0) <span class="current-lbl">{{ $profileText1 }}</span> @endif
                                </li>
                            @endfor
                        </ul>

                        {!! Form::button($profileAddBtn1, array('id' => 'add-position-btn', 'class' => 'waves-effect waves-light btn')) !!}
                    </div>

                    <div class="profile-section studies-section">
                        <h3 class="h6">{{ $profileHeading2 }}</h3>

                        <ul>
                            @for ($i = 0; $i < 3; $i++)
                                <li>
                                    <span class="profile-section-heading">Some institute {{ $i+1 }}</span>
                                    <span class="profile-section-city">{{ $profileLbl1 }}: Some city {{ $i+1 }}</span>
                                    <span class="profile-section-role grey-text text-darken-1">{{ $profileLbl3 }}: Some studies {{ $i+1 }}</span>
                                </li>
                            @endfor
                        </ul>

                        {!! Form::button($profileAddBtn2, array('id' => 'add-studies-btn', 'class' => 'waves-effect waves-light btn')) !!}
                    </div>

                    <div class="profile-section skills-section">
                        <h4 class="h6">{{ $profileHeading3 }}</h4>

                        <ul>
                            @for ($i = 0; $i < 5; $i++)
                                <li class="section-item">
                                    <span class="profile-section-skill">Some skill {{ $i+1 }}</span>
                                </li>
                            @endfor
                        </ul>

                        {!! Form::button($profileAddBtn3, array('id' => 'add-skill-btn', 'class' => 'waves-effect waves-light btn')) !!}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('jslibs')
    <script>
        {{-- Add position --}}
        $(document).on('click', '#add-position-btn', function(e) {
            $('.position-section > ul').after('' +
                '<form id="position-form">' +
                    '<div class="row">' +
                        '<div class="input-field col s12"><input id="position-company" type="text" class="validate" maxlength="30"><label for="position-company" class="active">{{ $profileFormCompanyLbl }}</label></div>' +
                        '<div class="input-field col s12"><input id="position-location" type="text" class="validate" maxlength="50"><label for="position-location" class="active">{{ $profileFormCityLbl }}</label></div>' +
                        '<div class="input-field col s12"><input id="position-role" type="text" class="validate" maxlength="30"><label for="position-role" class="active">{{ $profileFormRoleLbl }}</label></div>' +
                        '<div class="input-field col s12 m6"><input id="position-from" class="datepicker" type="text"><label for="position-from" class="active">{{ $profileFormFromLbl }}</label></div>' +
                        '<div class="input-field col s12 m6"><input id="position-to" class="datepicker" type="text"><label for="position-to" class="active">{{ $profileFormToLbl }}</label></div>' +
                        '<div class="col s12">' +
                            '<a id="cancel" class="waves-effect waves-light btn-flat">{{ $cancelBtn }}</a>' +
                            '<button type="button" name="save_btn" id="save-btn" class="waves-effect waves-light btn">{{ $saveBtn }}</button>' +
                        '</div>' +
                    '</div>' +
                '</form>'
            );

            $('#position-from, #position-to').pickadate({
                selectMonths: true,
                selectYears: 64,
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

            $('#add-position-btn').hide();
        });

        $(document).on('click', '#position-form #cancel', function(e) {
            $('#position-form').remove();
            $('#add-position-btn').show();
        });

        $(document).on('click', '#position-form #save-btn', function(e) {

        });


        {{-- Add studies --}}
        $(document).on('click', '#add-studies-btn', function(e) {
            $('.studies-section > ul').after('' +
                '<form id="studies-form">' +
                    '<div class="row">' +
                        '<div class="input-field col s12"><input id="institute-company" type="text" class="validate" maxlength="30"><label for="institute-company" class="active">{{ $profileFormCompanyLbl }}</label></div>' +
                        '<div class="input-field col s12"><input id="institute-location" type="text" class="validate" maxlength="50"><label for="institute-location" class="active">{{ $profileFormCityLbl }}</label></div>' +
                        '<div class="input-field col s12"><input id="institute-studies" type="text" class="validate" maxlength="50"><label for="institute-studies" class="active">{{ $profileFormStudiesLbl }}</label></div>' +
                        '<div class="col s12">' +
                            '<a id="cancel" class="waves-effect waves-light btn-flat">{{ $cancelBtn }}</a>' +
                            '<button type="button" name="save_btn" id="save-btn" class="waves-effect waves-light btn">{{ $saveBtn }}</button>' +
                        '</div>' +
                    '</div>' +
                '</form>');

            $('#add-studies-btn').hide();
        });

        $(document).on('click', '#studies-form #cancel', function(e) {
            $('#studies-form').remove();
            $('#add-studies-btn').show();
        });

        $(document).on('click', '#studies-form #save-btn', function(e) {

        });


        {{-- Add skills --}}
        $(document).on('click', '#add-skill-btn', function(e) {
            $('.skills-section > ul').after('' +
                '<form id="skills-form">' +
                    '<div class="row">' +
                        '<div class="input-field col s12"><input id="skill-title" type="text" class="validate" maxlength="30"><label for="skill-title" class="active">{{ $profileFormSkillLbl }}</label></div>' +
                        '<div class="col s12">' +
                            '<a id="cancel" class="waves-effect waves-light btn-flat">{{ $cancelBtn }}</a>' +
                            '<button type="button" name="save_btn" id="save-btn" class="waves-effect waves-light btn">{{ $saveBtn }}</button>' +
                        '</div>' +
                    '</div>' +
                '</form>');

            $('#add-skill-btn').hide();
        });

        $(document).on('click', '#skills-form #cancel', function(e) {
            $('#skills-form').remove();
            $('#add-skill-btn').show();
        });

        $(document).on('click', '#skills-form #save-btn', function(e) {

        });
    </script>
@endsection
