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
                    <div class="profile-section interests-section">
                        <h4 class="h6">{{ $profileHeading1 }}</h4>

                        <ul>
                            @for ($i = 0; $i < 5; $i++)
                                <li class="section-item">
                                    <span class="profile-section-interest">Some interest {{ $i+1 }}</span>
                                </li>
                            @endfor
                        </ul>

                        {!! Form::button($profileAddBtn1, array('id' => 'add-interest-btn', 'class' => 'waves-effect waves-light btn')) !!}
                    </div>

                    <div class="profile-section areas-section">
                        <h4 class="h6">{{ $profileHeading2 }}</h4>

                        <ul>
                            @for ($i = 0; $i < 3; $i++)
                                <li class="section-item">
                                    <span class="profile-section-interest"><i class="tiny material-icons">room</i> Some area {{ $i+1 }}</span>
                                </li>
                            @endfor
                        </ul>

                        {!! Form::button($profileAddBtn2, array('id' => 'add-area-btn', 'class' => 'waves-effect waves-light btn')) !!}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('jslibs')
    <script>
        {{-- Add interests --}}
        $(document).on('click', '#add-interest-btn', function(e) {
            $('.interests-section > ul').after('' +
                '<form id="interests-form">' +
                    '<div class="row">' +
                        '<div class="input-field col s12"><input id="interest-title" type="text" class="validate" maxlength="30"><label for="interest-title" class="active">{{ $profileFormInterestLbl }}</label></div>' +
                        '<div class="col s12">' +
                            '<a id="cancel" class="waves-effect waves-light btn-flat">{{ $cancelBtn }}</a>' +
                            '<button type="button" name="save_btn" id="save-btn" class="waves-effect waves-light btn">{{ $saveBtn }}</button>' +
                        '</div>' +
                    '</div>' +
                '</form>');

            $('#add-interest-btn').hide();
        });

        $(document).on('click', '#interests-form #cancel', function(e) {
            $('#interests-form').remove();
            $('#add-interest-btn').show();
        });

        $(document).on('click', '#interests-form #save-btn', function(e) {

        });


        {{-- Add areas --}}
        $(document).on('click', '#add-area-btn', function(e) {
            $('.areas-section > ul').after('' +
                '<form id="areas-form">' +
                    '<div class="row">' +
                        '<div class="input-field col s12"><input id="area-title" type="text" class="validate" maxlength="30"><label for="area-title" class="active">{{ $profileFormAreaLbl }}</label></div>' +
                        '<div class="col s12">' +
                            '<a id="cancel" class="waves-effect waves-light btn-flat">{{ $cancelBtn }}</a>' +
                            '<button type="button" name="save_btn" id="save-btn" class="waves-effect waves-light btn">{{ $saveBtn }}</button>' +
                        '</div>' +
                    '</div>' +
                '</form>');

            $('#add-area-btn').hide();
        });

        $(document).on('click', '#areas-form #cancel', function(e) {
            $('#areas-form').remove();
            $('#add-area-btn').show();
        });

        $(document).on('click', '#areas-form #save-btn', function(e) {

        });
    </script>
@endsection
