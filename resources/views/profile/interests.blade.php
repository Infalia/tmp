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

                        @if($user->interests->isNotEmpty())
                        <ul>
                            @foreach ($user->interests->sortBy('interest_name')->all() as $interest)
                            <li id="interest-list-{{ $interest->id }}">
                                <span class="profile-section-interest">{{ $interest->interest_name }}</span>

                                {!! Form::button('<i class="material-icons left">mode_edit</i> '.$profileEditBtn, array('class' => 'edit-interest-btn waves-effect waves-light btn-flat', 'data-item-id' => $interest->id)) !!}
                                {!! Form::button('<i class="material-icons left">delete</i> '.$profileRemoveBtn, array('class' => 'remove-interest-btn waves-effect waves-light btn-flat', 'onclick' => 'confirmDeleteInterest('.$interest->id.')')) !!}
                            </li>
                            @endforeach
                        </ul>
                        @else
                        <p>{{ $profileMsg1 }}</p>
                        @endif

                        {!! Form::button($profileAddBtn1, array('id' => 'add-interest-btn', 'class' => 'waves-effect waves-light btn')) !!}
                    </div>

                    <div class="profile-section areas-section">
                        <h4 class="h6">{{ $profileHeading2 }}</h4>

                        @if($user->areas->isNotEmpty())
                        <ul>
                            @foreach ($user->areas->sortBy('id')->all() as $area)
                            <li>
                                <span class="profile-section-interest"><i class="tiny material-icons">room</i> {{ $area->address }}</span>

                                {!! Form::button('<i class="material-icons left">mode_edit</i> '.$profileEditBtn, array('class' => 'edit-area-btn waves-effect waves-light btn-flat', 'data-item-id' => $area->id)) !!}
                                {!! Form::button('<i class="material-icons left">delete</i> '.$profileRemoveBtn, array('class' => 'remove-area-btn waves-effect waves-light btn-flat', 'onclick' => 'confirmDeleteArea('.$area->id.')')) !!}
                            </li>
                            @endforeach
                        </ul>
                        @else
                        <p>{{ $profileMsg2 }}</p>
                        @endif

                        {!! Form::button($profileAddBtn2, array('id' => 'add-area-btn', 'class' => 'waves-effect waves-light btn')) !!}
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


        /****** Handling interests actions ******/

        // Add interest form
        $(document).on('click', '#add-interest-btn', function(e) {
            $('.interests-section').append('' +
                '<form id="interests-form">' +
                    '<div class="row">' +
                        '<div class="input-field col s12"><input id="interest_name" type="text" maxlength="30"><label for="interest_name" class="active">{{ $profileFormInterestLbl }}</label></div>' +
                        '<div class="col s12">' +
                            '<a id="cancel" class="waves-effect waves-light btn-flat">{{ $cancelBtn }}</a>' +
                            '<button type="button" name="save_btn" id="save-interest-btn" class="waves-effect waves-light btn" data-action="insert">{{ $saveBtn }}</button>' +
                        '</div>' +
                    '</div>' +
                '</form>');

            $('#add-interest-btn').hide();


            // Instantiate typeahead
            $('#interest_name').typeahead(null, {
                hint: true,
                highlight: true,
                minLength: 3,
                display: 'value',
                source: interests
            });


            $(document).on('click', '#interests-form #cancel', function(e) {
                $('#interests-form').remove();
                $('#add-interest-btn').show();
            });
        });

        // Edit interest form
        $(document).on('click', '.edit-interest-btn', function(e) {
            var itemId = $(this).attr('data-item-id');

            data = new Object();
            data['interest_id'] = itemId;

            var url = "{{ url('profile/interest') }}";

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                success: function(data) {
                    $('.interests-section > ul > #interest-list-' + itemId).after('' +
                        '<form id="interests-form">' +
                            '<div class="row">' +
                                '<div class="input-field col s12"><input type="text" name="interest_name" id="interest_name" maxlength="100" value="' + data.userInterest.interest_name + '"><label for="interest_name" class="active">{{ $profileFormInterestLbl }}</label></div>' +
                                '<div class="col s12">' +
                                    '<a id="cancel" class="waves-effect waves-light btn-flat">{{ $cancelBtn }}</a>' +
                                    '<button type="button" name="save_btn" id="save-interest-btn" class="waves-effect waves-light btn" data-item-id="' + data.userInterest.id + '" data-action="update">{{ $saveBtn }}</button>' +
                                '</div>' +
                            '</div>' +
                        '</form>'
                    );


                    $('#add-interest-btn, .edit-interest-btn, .remove-interest-btn').hide();


                    // Instantiate typeahead
                    $('#interest_name').typeahead(null, {
                        hint: true,
                        highlight: true,
                        minLength: 3,
                        display: 'value',
                        source: interests
                    });


                    // Add studies cancel
                    $(document).on('click', '#interests-form #cancel', function(e) {
                        $('#interests-form').remove();
                        $('#add-interest-btn, .edit-interest-btn, .remove-interest-btn').show();
                    });
                },
                error : function(XMLHttpRequest, textStatus, errorThrown) {}
            });

        });

        // Save interest
        $(document).on('click', '#save-interest-btn', function(e) {
            var itemAction = $(this).attr('data-action');
            var itemId = null;

            if('update' == itemAction) {
                itemId = $(this).attr('data-item-id');
            }


            data = new Object();
            data['action'] = itemAction;
            data['id'] = itemId;
            data['interest_name'] = $('#interest_name').val();

            
            var url = "{{ url('profile/interest/save') }}";

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
                            $('#interests-form').remove();
                            $('#add-interest-btn').show();

                            $('.interests-section').load("{{ url('profile/interests/interest') }}", function() {});

                            $('.loader-overlay').fadeOut(0);
                        }, 2500);
                    }
                },
                error : function(XMLHttpRequest, textStatus, errorThrown) {}
            });
        });

        // Delete interest
        function confirmDeleteInterest(id) {
            if(confirm('{{ $deleteConfirmMsg }}')) {
                var itemId = id;
                data = new Object();

                data['interest_id'] = itemId;

                
                var url = "{{ url('profile/interest/delete') }}";

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
                                $('.interests-section').load("{{ url('profile/interests/interest') }}", function() {});

                                $('.loader-overlay').fadeOut(0);
                            }, 2500);
                        }
                    },
                    error : function(XMLHttpRequest, textStatus, errorThrown) {}
                });
            }
        }




        /****** Handling areas of interest actions ******/

        // Add areas
        $(document).on('click', '#add-area-btn', function(e) {
            $('.areas-section').append('' +
                '<div class="modal">' +
                    '<div class="modal-content">' +
                        '<iframe class="init-form-map" title="input a location" src="{{ config('app.url') }}/plugins/inputmap/src/index.html?domain={{ config('app.url') }}&mode=lite"></iframe>' +
                        '<br><br>' +
                        '<h4 class="h6"><u>Address</u></h4>' +
                        '<ul>' +
                            '<li><b>Display Name:</b> <span id="display-name"></span></li>' +
                            '<li><b>Address:</b> <span id="address"></span></li>' +
                            '<li><b>Latitude:</b> <span id="lat"></span></li>' +
                            '<li><b>Longitude:</b> <span id="lon"></span></li>' +
                        '</ul>' +
                    '</div>' +
                    '<div class="modal-footer">' +
                        '<button type="button" name="save_btn" id="save-area-btn" class="waves-effect waves-light btn" data-action="insert">{{ $saveBtn }}</button>' +
                    '</div>' +
                '</div>');

            $('.modal').modal({
                complete: function() {
                    $('#add-area-btn').show();
                    $('.modal').remove();
                }
            });
            $('.modal').modal('open');


            // InputMap
            var iframeDomain = "{{ config('app.url') }}";

            window.addEventListener("message",
                function(e) {
                    if(e.defaultPrevented)
                        return
                    e.preventDefault();

                    if(e.origin !== iframeDomain) {
                        return;
                    }

                    if(e.data.src == 'InputMap')
                        setInputMapData(e.data);
            });

            function setInputMapData(data) {
                console.log('got message', data);
                document.getElementById("lat").innerHTML = data.lat;
                document.getElementById("lon").innerHTML = data.lng;
                document.getElementById("display-name").innerHTML = data.display_name ? data.display_name : 'undefined';
                document.getElementById("address").innerHTML = data.address ? JSON.stringify(data.address) : 'undefined';
            }



            $('#add-area-btn').hide();
        });

        // Edit area form
        $(document).on('click', '.edit-area-btn', function(e) {
            var itemId = $(this).attr('data-item-id');

            data = new Object();
            data['area_id'] = itemId;

            var url = "{{ url('profile/area') }}";

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                success: function(data) {
                    $('.areas-section').append('' +
                        '<div class="modal">' +
                            '<div class="modal-content">' +
                                '<iframe class="init-form-map" title="input a location" src="{{ config('app.url') }}/plugins/inputmap/src/index.html?domain={{ config('app.url') }}&mode=lite"></iframe>' +
                                '<br><br>' +
                                '<h4 class="h6"><u>Address</u></h4>' +
                                '<ul>' +
                                    '<li><b>Display Name:</b> <span id="display-name"></span></li>' +
                                    '<li><b>Address:</b> <span id="address"></span></li>' +
                                    '<li><b>Latitude:</b> <span id="lat"></span></li>' +
                                    '<li><b>Longitude:</b> <span id="lon"></span></li>' +
                                '</ul>' +
                            '</div>' +
                            '<div class="modal-footer">' +
                                '<button type="button" name="save_btn" id="save-area-btn" class="waves-effect waves-light btn" data-item-id="' + data.userArea.id + '" data-action="update">{{ $saveBtn }}</button>' +
                            '</div>' +
                        '</div>');

                    $('.modal').modal({
                        complete: function() {
                            $('#add-area-btn').show();
                            $('.modal').remove();
                        }
                    });
                    $('.modal').modal('open');


                    // InputMap
                    var iframeDomain = "{{ config('app.url') }}";

                    window.addEventListener("message",
                        function(e) {
                            if(e.defaultPrevented)
                                return
                            e.preventDefault();

                            if(e.origin !== iframeDomain) {
                                return;
                            }

                            if(e.data.src == 'InputMap')
                                setInputMapData(e.data);
                    });

                    function setInputMapData(data) {
                        console.log('got message', data);
                        document.getElementById("lat").innerHTML = data.lat;
                        document.getElementById("lon").innerHTML = data.lng;
                        document.getElementById("display-name").innerHTML = data.display_name ? data.display_name : 'undefined';
                        document.getElementById("address").innerHTML = data.address ? JSON.stringify(data.address) : 'undefined';
                    }



                    $('#add-area-btn').hide();
                },
                error : function(XMLHttpRequest, textStatus, errorThrown) {}
            });

        });

        // Save area
        $(document).on('click', '#save-area-btn', function(e) {
            var itemAction = $(this).attr('data-action');
            var itemId = null;

            if('update' == itemAction) {
                itemId = $(this).attr('data-item-id');
            }


            data = new Object();
            data['action'] = itemAction;
            data['id'] = itemId;
            data['address'] = $('#display-name').text();
            data['full_address'] = $('#address').text();
            data['latitude'] = $('#lat').text();
            data['longitude'] = $('#lon').text();

            
            var url = "{{ url('profile/area/save') }}";

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
                            $('#add-area-btn').show();
                            $('.modal').modal('close');
                            $('.modal').remove();

                            $('.areas-section').load("{{ url('profile/interests/area') }}", function() {});

                            $('.loader-overlay').fadeOut(0);
                        }, 2500);
                    }
                },
                error : function(XMLHttpRequest, textStatus, errorThrown) {}
            });
        });

        // Delete interest
        function confirmDeleteArea(id) {
            if(confirm('{{ $deleteConfirmMsg }}')) {
                var itemId = id;
                data = new Object();

                data['area_id'] = itemId;

                
                var url = "{{ url('profile/area/delete') }}";

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
                                $('.areas-section').load("{{ url('profile/interests/area') }}", function() {});

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
