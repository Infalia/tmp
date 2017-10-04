@extends('layouts.app')

@section('csslibs')
     {!! HTML::style('plugins/autocomplete/typeahead.min.css') !!}
     {!! HTML::style('datepicker/datepicker.min.css') !!}
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
                    <div class="profile-section position-section">
                        <h2 class="h6">{{ $profileHeading1 }}</h2>

                        <ul>
                            <li class="current">
                                <span class="profile-section-heading">Infalia Private Company</span>
                                <span class="profile-section-city">{{ $profileLbl1 }}: Thessaloniki, Central Macedonia, Greece</span>
                                <span class="profile-section-city">Oct 2016 - Ongoing</span>
                                <span class="profile-section-role grey-text text-darken-1">{{ $profileLbl2 }}: Web developer</span>
                                <span class="current-lbl">{{ $profileText1 }}</span>
                            </li>

                            <li>
                                <span class="profile-section-heading">Google</span>
                                <span class="profile-section-city">{{ $profileLbl1 }}: Dublin, Leinster, Ireland</span>
                                <span class="profile-section-city">Apr 2011 - Aug 2016</span>
                                <span class="profile-section-role grey-text text-darken-1">{{ $profileLbl2 }}: PHP developer</span>
                            </li>
                        </ul>

                        {!! Form::button($profileAddBtn1, array('id' => 'add-position-btn', 'class' => 'waves-effect waves-light btn')) !!}
                    </div>

                    <div class="profile-section studies-section">
                        <h3 class="h6">{{ $profileHeading2 }}</h3>

                        <ul>
                            <li>
                                <span class="profile-section-heading">Aristotle University of Thessaloniki</span>
                                <span class="profile-section-city">{{ $profileLbl1 }}: Thessaloniki, Central Macedonia, Greece</span>
                                <span class="profile-section-role grey-text text-darken-1">{{ $profileLbl3 }}: Data Processing and Data Processing Technology/Technician</span>
                            </li>

                            <li>
                                <span class="profile-section-heading">Massachusetts Institute of Technology</span>
                                <span class="profile-section-city">{{ $profileLbl1 }}: West Barnstable, Massachusetts, United States</span>
                                <span class="profile-section-role grey-text text-darken-1">{{ $profileLbl3 }}: Computer and Information Sciences - General</span>
                            </li>
                        </ul>

                        {!! Form::button($profileAddBtn2, array('id' => 'add-studies-btn', 'class' => 'waves-effect waves-light btn')) !!}
                    </div>

                    <div class="profile-section skills-section">
                        <h4 class="h6">{{ $profileHeading3 }}</h4>

                        <ul>
                            <li class="section-item">
                                <span class="profile-section-skill">Apache</span>
                            </li>
                            <li class="section-item">
                                <span class="profile-section-skill">PHP</span>
                            </li>
                            <li class="section-item">
                                <span class="profile-section-skill">MySQL</span>
                            </li>
                            <li class="section-item">
                                <span class="profile-section-skill">JavaScript</span>
                            </li>
                            <li class="section-item">
                                <span class="profile-section-skill">CSS</span>
                            </li>
                            <li class="section-item">
                                <span class="profile-section-skill">Laravel 5</span>
                            </li>
                            <li class="section-item">
                                <span class="profile-section-skill">Debian</span>
                            </li>
                        </ul>

                        {!! Form::button($profileAddBtn3, array('id' => 'add-skill-btn', 'class' => 'waves-effect waves-light btn')) !!}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('jslibs')
    {!! HTML::script('plugins/autocomplete/typeahead.bundle.min.js') !!}
    {!! HTML::script('datepicker/datepicker.min.js') !!}
    {!! HTML::script('datepicker/i18n/datepicker.en.js') !!}

    <script>
        // Positions suggestions
        var positions = new Bloodhound({
            datumTokenizer: function(datum) {
                return Bloodhound.tokenizers.whitespace(datum.value);
            },
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                wildcard: '%QUERY',
                url: '{{ url("api/positions/%QUERY") }}',
                transform: function(response) {
                    // Map the remote source JSON array to a JavaScript object array
                    return $.map(response, function(position) {
                        return {
                            value: position.name
                        };
                    });
                }
            }
        });

        // Universities suggestions
        var universities = new Bloodhound({
            datumTokenizer: function(datum) {
                return Bloodhound.tokenizers.whitespace(datum.value);
            },
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                wildcard: '%QUERY',
                url: '{{ url("api/universities/%QUERY") }}',
                transform: function(response) {
                    // Map the remote source JSON array to a JavaScript object array
                    return $.map(response, function(university) {
                        return {
                            value: university.name
                        };
                    });
                }
            }
        });

        // Studies suggestions
        var studies = new Bloodhound({
            datumTokenizer: function(datum) {
                return Bloodhound.tokenizers.whitespace(datum.value);
            },
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                wildcard: '%QUERY',
                url: '{{ url("api/studies/%QUERY") }}',
                transform: function(response) {
                    // Map the remote source JSON array to a JavaScript object array
                    return $.map(response, function(study) {
                        return {
                            value: study.name
                        };
                    });
                }
            }
        });

        // Skills suggestions
        var skills = new Bloodhound({
            datumTokenizer: function(datum) {
                return Bloodhound.tokenizers.whitespace(datum.value);
            },
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                wildcard: '%QUERY',
                url: '{{ url("api/skills/%QUERY") }}',
                transform: function(response) {
                    // Map the remote source JSON array to a JavaScript object array
                    return $.map(response, function(skill) {
                        return {
                            value: skill.name
                        };
                    });
                }
            }
        });

        // Cities suggestions
        var cities = new Bloodhound({
            datumTokenizer: function(datum) {
                return Bloodhound.tokenizers.whitespace(datum.value);
            },
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                wildcard: '%QUERY',
                url: '{{ url("api/cities/%QUERY") }}',
                transform: function(response) {
                    // Map the remote source JSON array to a JavaScript object array
                    return $.map(response, function(city) {
                        return {
                            value: city.name + ', ' + city.subdivision_name + ', ' + city.country_name
                        };
                    });
                }
            }
        });



        // Add position
        $(document).on('click', '#add-position-btn', function(e) {
            $('.position-section > ul').after('' +
                '<form id="position-form">' +
                    '<div class="row">' +
                        '<div class="input-field col s12"><input type="text" name="position_company" id="position-company" maxlength="30"><label for="position-company" class="active">{{ $profileFormCompanyLbl }}</label></div>' +
                        '<div class="input-field col s12"><input type="text" name="position_location" id="position-location" maxlength="150"><label for="position-location" class="active">{{ $profileFormCityLbl }}</label></div>' +
                        '<div class="input-field col s12"><input type="text" name="position_role" id="position-role" maxlength="150"><label for="position-role" class="active">{{ $profileFormRoleLbl }}</label></div>' +
                        '<div class="input-field col s12 m6"><input type="text" name="start_date" id="start-date" class="datepicker-here"><label for="start-date" class="active">{{ $profileFormFromLbl }}</label></div>' +
                        '<div class="input-field col s12 m6"><input type="text" name="end_date" id="end-date" class="datepicker-here"><label for="end-date" class="active">{{ $profileFormToLbl }}</label></div>' +
                        '<div class="col s12">' +
                            '<a id="cancel" class="waves-effect waves-light btn-flat">{{ $cancelBtn }}</a>' +
                            '<button type="button" name="save_btn" id="save-btn" class="waves-effect waves-light btn">{{ $saveBtn }}</button>' +
                        '</div>' +
                    '</div>' +
                '</form>'
            );

            // Datetime pickers
            var $startDatepicker = $('#start-date').datepicker({
                language: "en",
                dateFormat: "dd-mm-yyyy",
                //minDate: new Date(),
                onSelect: function(formattedDate, date, inst) {
                    $endDatepicker.data('datepicker').update('minDate', date);
                }
            });

            var $endDatepicker = $('#end-date').datepicker({
                language: "en",
                dateFormat: "dd-mm-yyyy",
                //minDate: new Date(),
                onSelect: function(formattedDate, date, inst) {
                    $startDatepicker.data('datepicker').update('maxDate', date);
                }
            });

            $('#add-position-btn').hide();


            // Instantiate typeahead
            $('#position-location').typeahead(null, {
                hint: true,
                highlight: true,
                minLength: 3,
                display: 'value',
                source: cities
            });

            $('#position-role').typeahead(null, {
                hint: true,
                highlight: true,
                minLength: 3,
                display: 'value',
                source: positions
            });
        });

        $(document).on('click', '#position-form #cancel', function(e) {
            $('#position-form').remove();
            $('#add-position-btn').show();
        });

        $(document).on('click', '#position-form #save-btn', function(e) {

        });


        // Add studies
        $(document).on('click', '#add-studies-btn', function(e) {
            $('.studies-section > ul').after('' +
                '<form id="studies-form">' +
                    '<div class="row">' +
                        '<div class="input-field col s12"><input id="institute-name" type="text" maxlength="150"><label for="institute-company" class="active">{{ $profileFormInstituteLbl }}</label></div>' +
                        '<div class="input-field col s12"><input id="institute-location" type="text" maxlength="150"><label for="institute-location" class="active">{{ $profileFormCityLbl }}</label></div>' +
                        '<div class="input-field col s12"><input id="institute-studies" type="text" class="validate" maxlength="150"><label for="institute-studies" class="active">{{ $profileFormStudiesLbl }}</label></div>' +
                        '<div class="col s12">' +
                            '<a id="cancel" class="waves-effect waves-light btn-flat">{{ $cancelBtn }}</a>' +
                            '<button type="button" name="save_btn" id="save-btn" class="waves-effect waves-light btn">{{ $saveBtn }}</button>' +
                        '</div>' +
                    '</div>' +
                '</form>');

            $('#add-studies-btn').hide();


            // Instantiate typeahead
            $('#institute-name').typeahead(null, {
                hint: true,
                highlight: true,
                minLength: 3,
                display: 'value',
                source: universities
            });

            $('#institute-location').typeahead(null, {
                hint: true,
                highlight: true,
                minLength: 3,
                display: 'value',
                source: cities
            });

            $('#institute-studies').typeahead(null, {
                hint: true,
                highlight: true,
                minLength: 3,
                display: 'value',
                source: studies
            });
        });

        $(document).on('click', '#studies-form #cancel', function(e) {
            $('#studies-form').remove();
            $('#add-studies-btn').show();
        });

        $(document).on('click', '#studies-form #save-btn', function(e) {

        });


        // Add skills
        $(document).on('click', '#add-skill-btn', function(e) {
            $('.skills-section > ul').after('' +
                '<form id="skills-form">' +
                    '<div class="row">' +
                        '<div class="input-field col s12"><input id="skill-title" type="text" maxlength="30"><label for="skill-title" class="active">{{ $profileFormSkillLbl }}</label></div>' +
                        '<div class="col s12">' +
                            '<a id="cancel" class="waves-effect waves-light btn-flat">{{ $cancelBtn }}</a>' +
                            '<button type="button" name="save_btn" id="save-btn" class="waves-effect waves-light btn">{{ $saveBtn }}</button>' +
                        '</div>' +
                    '</div>' +
                '</form>');

            $('#add-skill-btn').hide();


            // Instantiate typeahead
            $('#skill-title').typeahead(null, {
                hint: true,
                highlight: true,
                minLength: 3,
                display: 'value',
                source: skills
            });
        });

        $(document).on('click', '#skills-form #cancel', function(e) {
            $('#skills-form').remove();
            $('#add-skill-btn').show();
        });

        $(document).on('click', '#skills-form #save-btn', function(e) {

        });
    </script>
@endsection
