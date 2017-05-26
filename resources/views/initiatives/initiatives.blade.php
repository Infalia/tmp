@extends('layouts.app')

@section('content')
    <div class="content">
        @include('partials.sidebar')

        <div class="profile-container">
            <div class="initiatives">

                <div class="row">

                    @forelse($initiatives->event_list as $initiative)
                    <div class="col s12 m4 l6 xl3">
                        <div class="card">
                            @if(!empty($initiative->activity_objects[0]->properties->additionalProperties->images))
                            <div class="card-image">
                                <a href="{{ $initiative->activity_objects[0]->properties->external_url }}">
                                    {!! HTML::image('storage/initiatives/'.$initiative->activity_objects[0]->properties->additionalProperties->images[0], $initiative->activity_objects[0]->properties->hasName, array('class' => '')) !!}
                                    <a class="waves-effect waves-light btn">{{ $showBtn }}</a>
                                </a>
                            </div>
                            @endif

                            <div class="card-content">
                                <a href="{{ $initiative->activity_objects[0]->properties->external_url }}"><span class="card-title">{{ $initiative->activity_objects[0]->properties->hasName }}</span></a>


                                <div class="card-post-action">
                                    @isset($initiative->activity_objects[0]->properties->additionalProperties->initiative_type)
                                    <span>{{ $initiative->activity_objects[0]->properties->additionalProperties->initiative_type }}</span>
                                    @endisset

                                    <span class="card-post-action-time grey-text text-darken-1">{{ \Carbon\Carbon::createFromTimestamp($initiative->timestamp)->diffForHumans() }}</span>
                                </div>

                                @isset($initiative->activity_objects[0]->properties->additionalProperties->start_date)
                                <span class="card-post-calendar">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $initiative->activity_objects[0]->properties->additionalProperties->start_date)->format('l, j M Y H:i') }}</span>
                                @endisset

                                <span class="card-post-address">Not available</span>
                            </div>

                            <div class="card-action card-action-footer">
                                <span><i class="material-icons inline-icon grey-text text-darken-3">comment</i> {{ $comments = 2 }} {{ str_plural($commentLbl, $comments) }}</span>
                                <span><i class="material-icons inline-icon grey-text text-darken-3">people</i> {{ $supporters = 5 }} {{ str_plural($supportLbl, $supporters) }}</span>
                            </div>
                        </div>
                    </div>
                    @empty
                        <p>{{ $noRecordsMsg }}</p>
                    @endforelse

                </div>
            </div>
        </div>

    </div>
@endsection

@section('jslibs')
    <script>

    </script>
@endsection
