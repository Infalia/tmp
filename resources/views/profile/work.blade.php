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

                        @if($user->positions->isNotEmpty())
                        <ul>
                            @foreach ($user->positions->sortByDesc('start_date')->all() as $position)
                            <li id="position-list-{{ $position->id }}" @if(empty($position->end_date)) class="current" @endif>
                                <span class="profile-section-heading">{{ $position->company_name }}</span>
                                <span class="profile-section-city">{{ $profileLbl1 }}: {{ $position->city_name }}</span>
                                <span class="profile-section-date">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $position->start_date)->format('M Y') }} - @if(!empty($position->end_date)) {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $position->end_date)->format('M Y') }} @else {{ $profileText2 }} @endif</span>
                                <span class="profile-section-role grey-text text-darken-1">{{ $profileLbl2 }}: {{ $position->position_name }}</span>
                                @if(empty($position->end_date))
                                <span class="current-lbl">{{ $profileText1 }}</span>
                                @endif

                                {!! Form::button('<i class="material-icons left">mode_edit</i> '.$profileEditBtn, array('class' => 'edit-position-btn waves-effect waves-light btn-flat', 'data-item-id' => $position->id)) !!}
                                {!! Form::button('<i class="material-icons left">delete</i> '.$profileRemoveBtn, array('class' => 'remove-position-btn waves-effect waves-light btn-flat', 'onclick' => 'confirmDeletePosition('.$position->id.')')) !!}
                            </li>
                            @endforeach
                        </ul>
                        @else
                        <p>{{ $profileMsg1 }}</p>
                        @endif

                        {!! Form::button($profileAddBtn1, array('id' => 'add-position-btn', 'class' => 'waves-effect waves-light btn')) !!}
                    </div>

                    <div class="profile-section studies-section">
                        <h3 class="h6">{{ $profileHeading2 }}</h3>

                        @if($user->studies->isNotEmpty())
                        <ul>
                            @foreach ($user->studies->sortByDesc('id')->all() as $studies)
                            <li id="studies-list-{{ $studies->id }}">
                                <span class="profile-section-heading">{{ $studies->institute_name }}</span>
                                <span class="profile-section-city">{{ $profileLbl1 }}: {{ $studies->city_name }}</span>
                                <span class="profile-section-role grey-text text-darken-1">{{ $profileLbl3 }}: {{ $studies->studies_name }}</span>

                                {!! Form::button('<i class="material-icons left">mode_edit</i> '.$profileEditBtn, array('class' => 'edit-studies-btn waves-effect waves-light btn-flat', 'data-item-id' => $studies->id)) !!}
                                {!! Form::button('<i class="material-icons left">delete</i> '.$profileRemoveBtn, array('class' => 'remove-studies-btn waves-effect waves-light btn-flat', 'onclick' => 'confirmDeleteStudies('.$studies->id.')')) !!}
                            </li>
                            @endforeach
                        </ul>
                        @else
                        <p>{{ $profileMsg2 }}</p>
                        @endif

                        {!! Form::button($profileAddBtn2, array('id' => 'add-studies-btn', 'class' => 'waves-effect waves-light btn')) !!}
                    </div>

                    <div class="profile-section skills-section">
                        <h4 class="h6">{{ $profileHeading3 }}</h4>

                        @if($user->skills->isNotEmpty())
                        <ul>
                            @foreach ($user->skills->sortBy('skill_name')->all() as $skill)
                            <li id="skill-list-{{ $skill->id }}">
                                <span class="profile-section-skill">{{ $skill->skill_name }}</span>

                                {!! Form::button('<i class="material-icons left">mode_edit</i> '.$profileEditBtn, array('class' => 'edit-skill-btn waves-effect waves-light btn-flat', 'data-item-id' => $skill->id)) !!}
                                {!! Form::button('<i class="material-icons left">delete</i> '.$profileRemoveBtn, array('class' => 'remove-skill-btn waves-effect waves-light btn-flat', 'onclick' => 'confirmDeleteSkill('.$skill->id.')')) !!}
                            </li>
                            @endforeach
                        </ul>
                        @else
                        <p>{{ $profileMsg3 }}</p>
                        @endif

                        {!! Form::button($profileAddBtn3, array('id' => 'add-skill-btn', 'class' => 'waves-effect waves-light btn')) !!}
                    </div>
                </div>
            </div>
        </div>


        <div class="loader-overlay">
            <div class="loader">
                <div class="loader-inner line-scale-pulse-out-rapid">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
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
        /****** Suggestions data load ******/

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



        /****** Handling job position actions ******/

        // Add position form
        $(document).on('click', '#add-position-btn', function(e) {
            $('.position-section').append('' +
                '<form id="position-form">' +
                    '<div class="row">' +
                        '<div class="input-field col s12"><input type="text" name="position_company" id="position_company" maxlength="150"><label for="position_company" class="active">{{ $profileFormCompanyLbl }}</label></div>' +
                        '<div class="input-field col s12"><input type="text" name="position_location" id="position_location" maxlength="150"><label for="position_location" class="active">{{ $profileFormCityLbl }}</label></div>' +
                        '<div class="input-field col s12"><input type="text" name="position_role" id="position_role" maxlength="150"><label for="position_role" class="active">{{ $profileFormRoleLbl }}</label></div>' +
                        '<div class="input-field col s12"> <br> <input type="checkbox" name="is_current" id="is_current"><label for="is_current" class="active">{{ $profileFormCurrentLbl }}</label></div>' +
                        '<div class="input-field col s12 m6"><input type="text" name="start_date" id="start_date" class="datepicker-here"><label for="start_date" class="active">{{ $profileFormFromLbl }}</label></div>' +
                        '<div class="input-field col s12 m6"><input type="text" name="end_date" id="end_date" class="datepicker-here"><label for="end_date" class="active">{{ $profileFormToLbl }}</label></div>' +
                        '<div class="col s12">' +
                            '<a id="cancel" class="waves-effect waves-light btn-flat">{{ $cancelBtn }}</a>' +
                            '<button type="button" name="save_btn" id="save-position-btn" class="waves-effect waves-light btn" data-action="insert">{{ $saveBtn }}</button>' +
                        '</div>' +
                    '</div>' +
                '</form>'
            );

            // Datetime pickers
            var $startDatepicker = $('#start_date').datepicker({
                language: "en",
                dateFormat: "mm-yyyy",
                minView: "months",
                view: "months",
                maxDate: new Date(),
                onSelect: function(formattedDate, date, inst) {
                    $endDatepicker.data('datepicker').update('minDate', date);
                }
            });

            var $endDatepicker = $('#end_date').datepicker({
                language: "en",
                dateFormat: "mm-yyyy",
                minView: "months",
                view: "months",
                maxDate: new Date(),
                onSelect: function(formattedDate, date, inst) {
                    $startDatepicker.data('datepicker').update('maxDate', date);
                }
            });

            $('#add-position-btn, .edit-position-btn, .remove-position-btn').hide();

            // Add position cancel
            $(document).on('click', '#position-form #cancel', function(e) {
                $('#position-form').remove();
                $('#add-position-btn, .edit-position-btn, .remove-position-btn').show();
            });


            // Instantiate typeahead
            $('#position_location').typeahead(null, {
                hint: true,
                highlight: true,
                minLength: 3,
                display: 'value',
                source: cities
            });

            $('#position_role').typeahead(null, {
                hint: true,
                highlight: true,
                minLength: 3,
                display: 'value',
                source: positions
            });


            // Enable/disable "end_date" depending on "is_current" position
            $('#is_current').on('click', function() {
                if(this.checked) {
                    $('#end_date').prop("disabled", true);
                } 
                else {
                    $('#end_date').prop("disabled", false);
                }
            });
        });

        // Edit position form
        $(document).on('click', '.edit-position-btn', function(e) {
            var itemId = $(this).attr('data-item-id');

            data = new Object();
            data['position_id'] = itemId;

            var url = "{{ url('profile/position') }}";

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                success: function(data) {
                    var isCurrentChecked = '';

                    if(data.userPosition.is_current == 1) {
                        var isCurrentChecked = 'checked';
                    }

                    $('.position-section > ul > #position-list-' + itemId).after('' +
                        '<form id="position-form">' +
                            '<div class="row">' +
                                '<div class="input-field col s12"><input type="text" name="position_company" id="position_company" maxlength="150" value="' + data.userPosition.company_name + '"><label for="position_company" class="active">{{ $profileFormCompanyLbl }}</label></div>' +
                                '<div class="input-field col s12"><input type="text" name="position_location" id="position_location" maxlength="150" value="' + data.userPosition.city_name + '"><label for="position_location" class="active">{{ $profileFormCityLbl }}</label></div>' +
                                '<div class="input-field col s12"><input type="text" name="position_role" id="position_role" maxlength="150" value="' + data.userPosition.position_name + '"><label for="position_role" class="active">{{ $profileFormRoleLbl }}</label></div>' +
                                '<div class="input-field col s12"> <br> <input type="checkbox" name="is_current" id="is_current" ' + isCurrentChecked + '><label for="is_current" class="active">{{ $profileFormCurrentLbl }}</label></div>' +
                                '<div class="input-field col s12 m6"><input type="text" name="start_date" id="start_date" class="datepicker-here"><label for="start_date" class="active">{{ $profileFormFromLbl }}</label></div>' +
                                '<div class="input-field col s12 m6"><input type="text" name="end_date" id="end_date" class="datepicker-here"><label for="end_date" class="active">{{ $profileFormToLbl }}</label></div>' +
                                '<div class="col s12">' +
                                    '<a id="cancel" class="waves-effect waves-light btn-flat">{{ $cancelBtn }}</a>' +
                                    '<button type="button" name="save_btn" id="save-position-btn" class="waves-effect waves-light btn" data-item-id="' + data.userPosition.id + '" data-action="update">{{ $saveBtn }}</button>' +
                                '</div>' +
                            '</div>' +
                        '</form>'
                    );


                    // Datetime pickers
                    var $startDatepicker = $('#start_date').datepicker({
                        language: "en",
                        dateFormat: "mm-yyyy",
                        minView: "months",
                        view: "months",
                        startDate: new Date(data.startDate),
                        maxDate: new Date(),
                        onSelect: function(formattedDate, date, inst) {
                            // In case "is_current" is not checked
                            if(data.userPosition.is_current == 0) {
                                $endDatepicker.data('datepicker').update('minDate', date);
                            }
                        }
                    });

                    
                    // In case "is_current" is checked
                    if(data.userPosition.is_current == 1) {
                        $('#end_date').prop("disabled", true);
                    }
                    else {
                        var $endDatepicker = $('#end_date').datepicker({
                            language: "en",
                            dateFormat: "mm-yyyy",
                            minView: "months",
                            view: "months",
                            startDate: new Date(data.endDate),
                            maxDate: new Date(),
                            onSelect: function(formattedDate, date, inst) {
                                $startDatepicker.data('datepicker').update('maxDate', date);
                            }
                        });

                        $endDatepicker.data('datepicker').selectDate(new Date(data.endDate));
                    }

                    $startDatepicker.data('datepicker').selectDate(new Date(data.startDate));


                    $('#add-position-btn, .edit-position-btn, .remove-position-btn').hide();


                    // Instantiate typeahead
                    $('#position_location').typeahead(null, {
                        hint: true,
                        highlight: true,
                        minLength: 3,
                        display: 'value',
                        source: cities
                    });

                    $('#position_role').typeahead(null, {
                        hint: true,
                        highlight: true,
                        minLength: 3,
                        display: 'value',
                        source: positions
                    });


                    // Enable/disable "end_date" depending on "is_current" position
                    $('#is_current').on('click', function() {
                        if(this.checked) {
                            $('#end_date').prop("disabled", true);
                        } 
                        else {
                            $('#end_date').prop("disabled", false);
                            
                            var $endDatepicker = $('#end_date').datepicker({
                                language: "en",
                                dateFormat: "mm-yyyy",
                                minView: "months",
                                view: "months",
                                maxDate: new Date(),
                                minDate: new Date(data.startDate),
                                onSelect: function(formattedDate, date, inst) {
                                    $startDatepicker.data('datepicker').update('maxDate', date);
                                }
                            });

                            //$endDatepicker.data('datepicker').selectDate(new Date(data.endDate));

                        }
                    });


                    // Add position cancel
                    $(document).on('click', '#position-form #cancel', function(e) {
                        $('#position-form').remove();
                        $('#add-position-btn, .edit-position-btn, .remove-position-btn').show();
                    });
                },
                error : function(XMLHttpRequest, textStatus, errorThrown) {}
            });

        });


        // Save position
        $(document).on("click", "#save-position-btn", function(e) {
            var itemAction = $(this).attr('data-action');
            var itemId = null;

            if('update' == itemAction) {
                itemId = $(this).attr('data-item-id');
            }


            data = new Object();
            data['action'] = itemAction;
            data['id'] = itemId;
            data['position_company'] = $('#position_company').val();
            data['position_location'] = $('#position_location').val();
            data['position_role'] = $('#position_role').val();
            data['start_date'] = $('#start_date').val();
            data['end_date'] = $('#end_date').val();

            if($('#is_current').is(':checked')) {
                data['is_current'] = 1;
            }
            else {
                data['is_current'] = 0;
            }

            
            var url = "{{ url('profile/position/save') }}";

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                success: function(data) {
                    if((data.errors)) {
                        var errorCount = 0;

                        $.each(data.errors, function(key, value) {
                            if(0 == errorCount) {
                                Materialize.toast(value, 5000, 'red darken-1')
                            }

                            errorCount++;
                        })
                    }
                    else {
                        $('.loader-overlay').fadeIn(0);
                        
                        setTimeout(function() {
                            $('#position-form').remove();
                            $('#add-position-btn').show();

                            $('.position-section').load("{{ url('profile/work/positions') }}", function() {});

                            $('.loader-overlay').fadeOut(0);
                        }, 2500);
                    }
                },
                error : function(XMLHttpRequest, textStatus, errorThrown) {}
            });
        });

        // Delete position
        function confirmDeletePosition(id) {
            if(confirm('{{ $deleteConfirmMsg }}')) {
                var itemId = id;
                data = new Object();

                data['position_id'] = itemId;

                
                var url = "{{ url('profile/position/delete') }}";

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: data,
                    dataType: 'json',
                    success: function(data) {
                        if((data.errors)) {
                            var errorCount = 0;

                            $.each(data.errors, function(key, value) {
                                if(0 == errorCount) {
                                    Materialize.toast(value, 5000, 'red darken-1')
                                }

                                errorCount++;
                            })
                        }
                        else {
                            $('.loader-overlay').fadeIn(0);
                            
                            setTimeout(function() {
                                $('.position-section').load("{{ url('profile/work/positions') }}", function() {});

                                $('.loader-overlay').fadeOut(0);
                            }, 2500);
                        }
                    },
                    error : function(XMLHttpRequest, textStatus, errorThrown) {}
                });
            }
        }




        /****** Handling studies actions ******/

        // Add studies form
        $(document).on('click', '#add-studies-btn', function(e) {
            $('.studies-section').append('' +
                '<form id="studies-form">' +
                    '<div class="row">' +
                        '<div class="input-field col s12"><input id="institute_name" type="text" maxlength="150"><label for="institute_name" class="active">{{ $profileFormInstituteLbl }}</label></div>' +
                        '<div class="input-field col s12"><input id="institute_location" type="text" maxlength="150"><label for="institute_location" class="active">{{ $profileFormCityLbl }}</label></div>' +
                        '<div class="input-field col s12"><input id="institute_studies" type="text" class="validate" maxlength="150"><label for="institute_studies" class="active">{{ $profileFormStudiesLbl }}</label></div>' +
                        '<div class="col s12">' +
                            '<a id="cancel" class="waves-effect waves-light btn-flat">{{ $cancelBtn }}</a>' +
                            '<button type="button" name="save_btn" id="save-studies-btn" class="waves-effect waves-light btn" data-action="insert">{{ $saveBtn }}</button>' +
                        '</div>' +
                    '</div>' +
                '</form>');

            $('#add-studies-btn').hide();


            // Instantiate typeahead
            $('#institute_name').typeahead(null, {
                hint: true,
                highlight: true,
                minLength: 3,
                display: 'value',
                source: universities
            });

            $('#institute_location').typeahead(null, {
                hint: true,
                highlight: true,
                minLength: 3,
                display: 'value',
                source: cities
            });

            $('#institute_studies').typeahead(null, {
                hint: true,
                highlight: true,
                minLength: 3,
                display: 'value',
                source: studies
            });


            $(document).on('click', '#studies-form #cancel', function(e) {
                $('#studies-form').remove();
                $('#add-studies-btn').show();
            });
        });

        // Edit studies form
        $(document).on('click', '.edit-studies-btn', function(e) {
            var itemId = $(this).attr('data-item-id');

            data = new Object();
            data['studies_id'] = itemId;

            var url = "{{ url('profile/studies') }}";

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                success: function(data) {
                    $('.studies-section > ul > #studies-list-' + itemId).after('' +
                        '<form id="studies-form">' +
                            '<div class="row">' +
                                '<div class="input-field col s12"><input type="text" name="institute_name" id="institute_name" maxlength="150" value="' + data.userStudies.institute_name + '"><label for="institute_name" class="active">{{ $profileFormInstituteLbl }}</label></div>' +
                                '<div class="input-field col s12"><input type="text" name="institute_location" id="institute_location" maxlength="150" value="' + data.userStudies.city_name + '"><label for="institute_location" class="active">{{ $profileFormCityLbl }}</label></div>' +
                                '<div class="input-field col s12"><input type="text" name="institute_studies" id="institute_studies" maxlength="150" value="' + data.userStudies.studies_name + '"><label for="institute_studies" class="active">{{ $profileFormStudiesLbl }}</label></div>' +
                                '<div class="col s12">' +
                                    '<a id="cancel" class="waves-effect waves-light btn-flat">{{ $cancelBtn }}</a>' +
                                    '<button type="button" name="save_btn" id="save-studies-btn" class="waves-effect waves-light btn" data-item-id="' + data.userStudies.id + '" data-action="update">{{ $saveBtn }}</button>' +
                                '</div>' +
                            '</div>' +
                        '</form>'
                    );


                    $('#add-studies-btn, .edit-studies-btn, .remove-studies-btn').hide();


                    // Instantiate typeahead
                    $('#institute_name').typeahead(null, {
                        hint: true,
                        highlight: true,
                        minLength: 3,
                        display: 'value',
                        source: universities
                    });

                    $('#institute_location').typeahead(null, {
                        hint: true,
                        highlight: true,
                        minLength: 3,
                        display: 'value',
                        source: cities
                    });

                    $('#institute_studies').typeahead(null, {
                        hint: true,
                        highlight: true,
                        minLength: 3,
                        display: 'value',
                        source: studies
                    });


                    // Add studies cancel
                    $(document).on('click', '#studies-form #cancel', function(e) {
                        $('#studies-form').remove();
                        $('#add-studies-btn, .edit-studies-btn, .remove-studies-btn').show();
                    });
                },
                error : function(XMLHttpRequest, textStatus, errorThrown) {}
            });

        });


        // Save studies
        $(document).on('click', '#save-studies-btn', function(e) {
            var itemAction = $(this).attr('data-action');
            var itemId = null;

            if('update' == itemAction) {
                itemId = $(this).attr('data-item-id');
            }


            data = new Object();
            data['action'] = itemAction;
            data['id'] = itemId;
            data['institute_name'] = $('#institute_name').val();
            data['institute_location'] = $('#institute_location').val();
            data['institute_studies'] = $('#institute_studies').val();

            
            var url = "{{ url('profile/studies/save') }}";

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                success: function(data) {
                    if((data.errors)) {
                        var errorCount = 0;

                        $.each(data.errors, function(key, value) {
                            if(0 == errorCount) {
                                Materialize.toast(value, 5000, 'red darken-1')
                            }

                            errorCount++;
                        })
                    }
                    else {
                        $('.loader-overlay').fadeIn(0);
                        
                        setTimeout(function() {
                            $('#studies-form').remove();
                            $('#add-studies-btn').show();

                            $('.studies-section').load("{{ url('profile/work/studies') }}", function() {});

                            $('.loader-overlay').fadeOut(0);
                        }, 2500);
                    }
                },
                error : function(XMLHttpRequest, textStatus, errorThrown) {}
            });
        });

        // Delete studies
        function confirmDeleteStudies(id) {
            if(confirm('{{ $deleteConfirmMsg }}')) {
                var itemId = id;
                data = new Object();

                data['studies_id'] = itemId;

                
                var url = "{{ url('profile/studies/delete') }}";

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: data,
                    dataType: 'json',
                    success: function(data) {
                        if((data.errors)) {
                            var errorCount = 0;

                            $.each(data.errors, function(key, value) {
                                if(0 == errorCount) {
                                    Materialize.toast(value, 5000, 'red darken-1')
                                }

                                errorCount++;
                            })
                        }
                        else {
                            $('.loader-overlay').fadeIn(0);
                            
                            setTimeout(function() {
                                $('.studies-section').load("{{ url('profile/work/studies') }}", function() {});

                                $('.loader-overlay').fadeOut(0);
                            }, 2500);
                        }
                    },
                    error : function(XMLHttpRequest, textStatus, errorThrown) {}
                });
            }
        }




        /****** Handling skills actions ******/

        // Add skill form
        $(document).on('click', '#add-skill-btn', function(e) {
            $('.skills-section').append('' +
                '<form id="skills-form">' +
                    '<div class="row">' +
                        '<div class="input-field col s12"><input id="skill_name" type="text" maxlength="100"><label for="skill_name" class="active">{{ $profileFormSkillLbl }}</label></div>' +
                        '<div class="col s12">' +
                            '<a id="cancel" class="waves-effect waves-light btn-flat">{{ $cancelBtn }}</a>' +
                            '<button type="button" name="save_btn" id="save-skill-btn" class="waves-effect waves-light btn" data-action="insert">{{ $saveBtn }}</button>' +
                        '</div>' +
                    '</div>' +
                '</form>');

            $('#add-skill-btn').hide();


            // Instantiate typeahead
            $('#skill_name').typeahead(null, {
                hint: true,
                highlight: true,
                minLength: 3,
                display: 'value',
                source: skills
            });


            $(document).on('click', '#skills-form #cancel', function(e) {
                $('#skills-form').remove();
                $('#add-skill-btn').show();
            });
        });

        // Edit skill form
        $(document).on('click', '.edit-skill-btn', function(e) {
            var itemId = $(this).attr('data-item-id');

            data = new Object();
            data['skill_id'] = itemId;

            var url = "{{ url('profile/skill') }}";

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                success: function(data) {
                    $('.skills-section > ul > #skill-list-' + itemId).after('' +
                        '<form id="skills-form">' +
                            '<div class="row">' +
                                '<div class="input-field col s12"><input type="text" name="skill_name" id="skill_name" maxlength="100" value="' + data.userSkill.skill_name + '"><label for="skill_name" class="active">{{ $profileFormSkillLbl }}</label></div>' +
                                '<div class="col s12">' +
                                    '<a id="cancel" class="waves-effect waves-light btn-flat">{{ $cancelBtn }}</a>' +
                                    '<button type="button" name="save_btn" id="save-skill-btn" class="waves-effect waves-light btn" data-item-id="' + data.userSkill.id + '" data-action="update">{{ $saveBtn }}</button>' +
                                '</div>' +
                            '</div>' +
                        '</form>'
                    );


                    $('#add-skill-btn, .edit-skill-btn, .remove-skill-btn').hide();


                    // Instantiate typeahead
                    $('#skill_name').typeahead(null, {
                        hint: true,
                        highlight: true,
                        minLength: 3,
                        display: 'value',
                        source: skills
                    });


                    // Add studies cancel
                    $(document).on('click', '#skills-form #cancel', function(e) {
                        $('#skills-form').remove();
                        $('#add-skill-btn, .edit-skill-btn, .remove-skill-btn').show();
                    });
                },
                error : function(XMLHttpRequest, textStatus, errorThrown) {}
            });

        });

        // Save skill
        $(document).on('click', '#save-skill-btn', function(e) {
            var itemAction = $(this).attr('data-action');
            var itemId = null;

            if('update' == itemAction) {
                itemId = $(this).attr('data-item-id');
            }


            data = new Object();
            data['action'] = itemAction;
            data['id'] = itemId;
            data['skill_name'] = $('#skill_name').val();

            
            var url = "{{ url('profile/skill/save') }}";

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                success: function(data) {
                    if((data.errors)) {
                        var errorCount = 0;

                        $.each(data.errors, function(key, value) {
                            if(0 == errorCount) {
                                Materialize.toast(value, 5000, 'red darken-1')
                            }

                            errorCount++;
                        })
                    }
                    else {
                        $('.loader-overlay').fadeIn(0);
                        
                        setTimeout(function() {
                            $('#skills-form').remove();
                            $('#add-skill-btn').show();

                            $('.skills-section').load("{{ url('profile/work/skill') }}", function() {});

                            $('.loader-overlay').fadeOut(0);
                        }, 2500);
                    }
                },
                error : function(XMLHttpRequest, textStatus, errorThrown) {}
            });
        });

        // Delete skill
        function confirmDeleteSkill(id) {
            if(confirm('{{ $deleteConfirmMsg }}')) {
                var itemId = id;
                data = new Object();

                data['skill_id'] = itemId;

                
                var url = "{{ url('profile/skill/delete') }}";

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: data,
                    dataType: 'json',
                    success: function(data) {
                        if((data.errors)) {
                            var errorCount = 0;

                            $.each(data.errors, function(key, value) {
                                if(0 == errorCount) {
                                    Materialize.toast(value, 5000, 'red darken-1')
                                }

                                errorCount++;
                            })
                        }
                        else {
                            $('.loader-overlay').fadeIn(0);
                            
                            setTimeout(function() {
                                $('.skills-section').load("{{ url('profile/work/skill') }}", function() {});

                                $('.loader-overlay').fadeOut(0);
                            }, 2500);
                        }
                    },
                    error : function(XMLHttpRequest, textStatus, errorThrown) {}
                });
            }
        }
    </script>
@endsection
