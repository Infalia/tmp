@extends('layouts.app')

@section('content')
    <div class="content">
        @include('partials.sidebar')

        <div class="profile-container">
            <div class="timeline">

                @if(!empty($userEvents))
                @forelse($userEvents->event_list as $event)
                <div class="row">
                    <div class="col s12 m10 l8 xl6">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-post-action">
                                    <span class="card-post-action-component grey-text text-darken-1">{{ $postedOfferLbl }}</span> Trusted Marketplace
                                    <span class="card-post-action-time grey-text text-darken-1">{{ \Carbon\Carbon::createFromTimestamp($event->timestamp)->diffForHumans() }}</span>
                                </div>
                                
                                @if(isset($event->activity_objects[0]->properties->hasName))
                                <a class="card-title" href="{{ $event->activity_objects[0]->properties->external_url }}">{{ $event->activity_objects[0]->properties->hasName }}</a>
                                @endif
                                
                                <span class="card-post-address">Address is not available yet</span>
                            </div>

                            <div class="card-action card-action-footer">
                                <span class="initiative-engagement"><i class="material-icons inline-icon grey-text text-darken-3">comment</i> {{ $comments = 2 }} {{ str_plural($commentLbl, $comments) }}</span>
                                <span class="initiative-engagement"><i class="material-icons inline-icon grey-text text-darken-3">people</i> {{ $supporters = 5 }} {{ str_plural($supportLbl, $supporters) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                    <p>{{ $noRecordsMsg }}</p>
                @endforelse
                @endif
            </div>
        </div>
    </div>
@endsection

@section('jslibs')
    <script>

    </script>
@endsection
