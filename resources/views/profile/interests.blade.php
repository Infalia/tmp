@extends('layouts.app')

@section('csslibs')
     {!! HTML::style('plugins/autocomplete/typeahead.min.css') !!}
@endsection

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
                            <li class="section-item">
                                <span class="profile-section-interest">Traveling</span>
                            </li>
                            <li class="section-item">
                                <span class="profile-section-interest">Bicycling</span>
                            </li>
                            <li class="section-item">
                                <span class="profile-section-interest">Basketball</span>
                            </li>
                            <li class="section-item">
                                <span class="profile-section-interest">Photography</span>
                            </li>
                        </ul>

                        {!! Form::button($profileAddBtn1, array('id' => 'add-interest-btn', 'class' => 'waves-effect waves-light btn')) !!}
                    </div>

                    <div class="profile-section areas-section">
                        <h4 class="h6">{{ $profileHeading2 }}</h4>

                        <ul>
                            <li class="section-item">
                                <span class="profile-section-interest"><i class="tiny material-icons">room</i> Thessaloniki, Greece</span>
                            </li>
                            <li class="section-item">
                                <span class="profile-section-interest"><i class="tiny material-icons">room</i> Kalamaria, Thessaloniki, Greece</span>
                            </li>
                            <li class="section-item">
                                <span class="profile-section-interest"><i class="tiny material-icons">room</i> Epanomi, Thessaloniki, Greece</span>
                            </li>
                        </ul>

                        {!! Form::button($profileAddBtn2, array('id' => 'add-area-btn', 'class' => 'waves-effect waves-light btn')) !!}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('jslibs')
    {!! HTML::script('plugins/autocomplete/typeahead.bundle.min.js') !!}

    <script>
        // Interests suggestions
        var interests = new Bloodhound({
            datumTokenizer: function(datum) {
                return Bloodhound.tokenizers.whitespace(datum.value);
            },
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                wildcard: '%QUERY',
                url: '{{ url("api/interests/%QUERY") }}',
                transform: function(response) {
                    // Map the remote source JSON array to a JavaScript object array
                    return $.map(response, function(interest) {
                        return {
                            value: interest.name
                        };
                    });
                }
            }
        });


        // Add interests
        $(document).on('click', '#add-interest-btn', function(e) {
            $('.interests-section > ul').after('' +
                '<form id="interests-form">' +
                    '<div class="row">' +
                        '<div class="input-field col s12"><input id="interest-title" type="text" maxlength="30"><label for="interest-title" class="active">{{ $profileFormInterestLbl }}</label></div>' +
                        '<div class="col s12">' +
                            '<a id="cancel" class="waves-effect waves-light btn-flat">{{ $cancelBtn }}</a>' +
                            '<button type="button" name="save_btn" id="save-btn" class="waves-effect waves-light btn">{{ $saveBtn }}</button>' +
                        '</div>' +
                    '</div>' +
                '</form>');

            $('#add-interest-btn').hide();


            // Instantiate typeahead
            $('#interest-title').typeahead(null, {
                hint: true,
                highlight: true,
                minLength: 3,
                display: 'value',
                source: interests
            });
        });

        $(document).on('click', '#interests-form #cancel', function(e) {
            $('#interests-form').remove();
            $('#add-interest-btn').show();
        });

        $(document).on('click', '#interests-form #save-btn', function(e) {

        });


        // Add areas
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
