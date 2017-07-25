@extends('layouts.app')

@section('csslibs')
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

                <div class="col m8 l9 xl6">

                    {!! Form::open(['id' => 'basic-info-form']) !!}

                    <div class="row">
                        <div class="input-field col s12">
                            <div class="image-preview">
                                @if(!empty($userImage))
                                {!! HTML::image('storage/users/'.$userImage, $user->name, array('class' => '')) !!}
                                @else
                                <img>
                                @endif
                            </div>

                            @php
                                $showBtnClass = '';
                                
                                if(empty($userImage)) {
                                    $showBtnClass = 'hide';
                                }
                            @endphp
                            {!! Form::button($profileBasicBtn2, array('id' => 'remove-img-btn', 'class' => 'waves-effect waves-light btn-flat '.$showBtnClass)) !!}

                            <div class="file-field input-field">
                                <div class="btn">
                                    <span>{{ $profileBasicBtn1 }}</span>
                                    <input type="file" id="user_img" class="validate" name="user_img">
                                </div>
                                
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="input-field col s12">
                            <div class="user-email"><span>{{ $user->email }}</span></div>
                        </div>

                        <div class="input-field col s12">
                            {!! Form::text('phone_num', $userPhone, ['id' => 'phone_num', 'class' => 'validate', 'placeholder' => $phonePldr, 'maxlength' => '16']) !!}
                            {!! Form::label('phone_num', $phoneLbl, ['class' => 'active']) !!}
                        </div>

                        <div class="input-field col s12">
                            {!! Form::text('birthday', '', ['id' => 'birthday', 'class' => 'datepicker-here', 'placeholder' => $birthdayPldr]) !!}
                            {!! Form::label('birthday', $birthdayLbl, ['class' => 'active']) !!}
                        </div>

                        @if($genders->isNotEmpty())
                        <div class="form-radios col s12">
                            @foreach($genders as $gender)
                            @php
                                if($gender->id == $userGenderId) {
                                    $isChecked = true;
                                }
                                else {
                                    $isChecked = false;
                                }
                            @endphp
                            <div class="inline-radio">
                                {!! Form::radio('gender', $gender->id, $isChecked, ['id' => 'gender-'.$gender->id]) !!}
                                {!! Form::label('gender-'.$gender->id, $gender->name, ['class' => 'active']) !!}
                            </div>
                            @endforeach
                        </div>
                        @endif

                        @if($languages->isNotEmpty())
                        <div class="input-field col s12">
                            {!! Form::label('languages', $languagesLbl, ['class' => 'active']) !!}
                            <select name="languages[]" id="languages" multiple>
                                <option value="" disabled selected>{{ $languagesPldr }}</option>
                                
                                @foreach($languages as $language)
                                <option value="{{ $language->id }}">{{ $language->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif

                        <div class="input-field col s12">
                            {!! Form::textarea('bio', $userDescription, ['id' => 'bio', 'class' => 'materialize-textarea', 'placeholder' => $bioPldr]) !!}
                            {!! Form::label('bio', $bioLbl, ['class' => 'active']) !!}
                        </div>

                        <div class="col s12">
                            {!! Form::button($cancelBtn, array('id' => 'cancel-btn', 'class' => 'waves-effect waves-light btn-flat')) !!}
                            {!! Form::button($saveBtn, array('id' => 'save-btn', 'class' => 'waves-effect waves-light btn')) !!}
                        </div>

                    </div>

                    {!! Form::close() !!}
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
    {!! HTML::script('datepicker/datepicker.min.js') !!}
    {!! HTML::script('datepicker/i18n/datepicker.en.js') !!}

    <script>
        // Datetime picker
        var $birthdayDatepicker = $('#birthday').datepicker({
            language: "en",
            dateFormat: "dd-mm-yyyy",
            minDate: new Date("{{ $minDate }}"),
            maxDate: new Date("{{ $maxDate }}")
        });

        var dp = $('#birthday').datepicker().data('datepicker').selectDate(new Date({{ $userBirthday }}));

        

        $(document).ready(function() {
            $('select').material_select();
        });



        $("#user_img").change(function () {
            if(this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.image-preview img').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);
            }
        });

        
        // Selected languages
        var values = "{{ $userLanguageIds->toJson() }}";

        $.each($.parseJSON(values), function(i, e) {
            $("#languages option[value='" + e + "']").prop("selected", true);
        });



        $(document).on("click", "#save-btn", function(e) {
            var formData = new FormData($('#basic-info-form')[0]);
            

            var url = "{{ url('profile/basic-info/save') }}";

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
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
                            if(data.showRemoveImgBtn == 'yes') {
                                $('#remove-img-btn').removeClass('hide');
                            }
                            else {
                                $('#remove-img-btn').addClass('hide');
                            }

                            // Clear file input value
                            $('.file-path-wrapper .file-path').val('');

                            $('.loader-overlay').fadeOut(0);
                        }, 2500);
                    }
                },
                error : function(XMLHttpRequest, textStatus, errorThrown) {}
            });
        });


        $(document).on("click", "#remove-img-btn", function(e) {
            data = new Object();

            var url = "{{ url('profile/basic-info/image/remove') }}";

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                success: function(data) {
                    $('.loader-overlay').fadeIn(0);

                    setTimeout(function() {
                        $('.image-preview img').attr('src', '');
                        $('.image-preview img').attr('alt', '');
                        $('#remove-img-btn').addClass('hide');

                        // Clear file input value
                        $('.file-path-wrapper .file-path').val('');

                        $('.loader-overlay').fadeOut(0);
                    }, 2500);
                },
                error : function(XMLHttpRequest, textStatus, errorThrown) {}
            });
        });
    </script>
@endsection
