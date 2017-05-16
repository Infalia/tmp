@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            {{--@php--}}
                {{--echo '<h5>Accessibility categories</h5>';--}}

                {{--foreach ($acsbltyCats as $acsbltyCat) {--}}
                    {{--if(!$acsbltyCat->categoryTranslations->isEmpty()) {--}}
                        {{--//$translation = $acsbltyCat->translate('el');--}}
                        {{--//echo $acsbltyCat->id.' - '.$translation->name.'<br>';--}}

                        {{--echo $acsbltyCat->id.' - '.$acsbltyCat->name.'<br>';--}}
                    {{--}--}}
                {{--}--}}

                {{--echo '<br>';--}}

                {{--echo '<h5>Accessibility options</h5>';--}}

                {{--foreach ($acsbltyCats as $acsbltyCat) {--}}
                    {{--$options = $acsbltyCat->categoryOptions;--}}

                    {{--if(!$options->isEmpty()) {--}}
                        {{--foreach ($options as $option) {--}}
                            {{--echo $acsbltyCat->id.' - '.$option->name.'<br>';--}}
                        {{--}--}}
                    {{--}--}}
                {{--}--}}

                {{--echo '<br>';--}}

                {{--echo '<h5>User accessibility options</h5>';--}}

                {{--foreach ($user->accessibilityOptions as $accessibilityOption) {--}}
                    {{--echo $accessibilityOption->name.'<br>';--}}
                {{--}--}}
            {{--@endphp--}}



            <div class="row">
                <div class="col s12">
                    <h1 class="h5">{{ $heading1 }}</h1>
                </div>
            </div>

            @if(!is_null($accessibilityCats))
            <div class="accessibility-options">
                <form action="#">
                    <ul class="collapsible" data-collapsible="accordion">
                        @foreach ($accessibilityCats as $accessibilityCat)
                        <li>
                            <div class="collapsible-header active">
                                <span class="list-iterator">{{ $loop->iteration.'.' }}</span>
                                <span>{{ $accessibilityCat->name }}</span>
                            </div>

                            <div class="collapsible-body">
                                <div class="row">
                                    @if(!is_null($accessibilityCat->categoryOptions))
                                        <div class="col m6 l5 xl4">
                                            @foreach ($accessibilityCat->categoryOptions as $accessibilityCatOption)
                                            @php
                                                $isChecked = false;

                                                if($loop->first) {
                                                    $isChecked = true;
                                                }

                                                if(!empty($userAccessibilityOpts)) {
                                                    if(in_array($accessibilityCatOption->id, $userAccessibilityOpts)) {
                                                        $isChecked = true;
                                                    }
                                                }
                                            @endphp
                                            <p>
                                                {!! Form::radio('group-'.$accessibilityCat->id, $accessibilityCatOption->id, $isChecked, ['id' => 'option'.$accessibilityCatOption->id]) !!}
                                                {!! Form::label('option'.$accessibilityCatOption->id, $accessibilityCatOption->name, ['class' => '']) !!}
                                            </p>
                                            @endforeach
                                        </div>
                                    @endif

                                    <div class="col m6 l7 xl8">
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>

                    {!! Form::button($saveBtn, array('id' => 'save-btn', 'class' => 'waves-effect waves-light btn')) !!}
                </form>
            </div>
            @endif

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
    <script>
        $(document).on("click", "#save-btn", function(e) {
            data = new Object();
            var radioGroups = [];
            var radioGroupValues = [];

            $("input:radio").each(function(){
                var name = $(this).attr("name");

                radioGroups.push(name); // Array with radio group names
            });

            radioGroups = $.unique(radioGroups).sort();

            for(var i=0, l=radioGroups.length; i<l; i++) {
                //radioGroupValues.push([radioGroups[i], $("input:radio[name="+radioGroups[i]+"]:checked").val()]); // Array with radio group values by radio group name
                radioGroupValues.push($("input:radio[name="+radioGroups[i]+"]:checked").val()); // Array with radio group values by radio group name
                data[radioGroups[i]] = $("input:radio[name="+radioGroups[i]+"]:checked").val();                   // Make a key to data array with each radio group name just for validation
            }

            data['radio_groups'] = radioGroups;
            data['options'] = radioGroupValues;


            var url = "{{ url('accessibility/save-options') }}";

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                success: function(data) {
                    if((data.errors)) {
                        Materialize.toast(data.errors.required, 5000, 'red darken-1')
                    }
                    else {
                        $('.loader-overlay').fadeIn(0);

                        setTimeout(function() {
                            window.location.reload();
                        }, 2500);
                    }
                },
                error : function(XMLHttpRequest, textStatus, errorThrown) {}
            });
        });
    </script>
@endsection