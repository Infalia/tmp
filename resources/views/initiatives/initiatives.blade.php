@extends('layouts.app')

@section('content')
    <div class="content">
        @if(Auth::check())
            @include('partials.sidebar')
        @endif

        <div class="profile-container {{ Auth::check() ? '' : 'no-margin' }}">
            <div class="initiatives">

                <div class="row">
                    @forelse($initiatives as $initiative)
                    <div class="col {{ Auth::check() ? 's12 m6 l6 xl3' : 's12 m4 l4 xl2' }}">
                        <div class="card">
                            @if(!empty($initiative->initiativeImages))
                            <div class="card-image">
                                <a href="{{ 'offer/'.$initiative->id.'/'.str_slug($initiative->title) }}">
                                    {!! HTML::image('storage/initiatives/'.$initiative->initiativeImages->first()->name, $initiative->title, array('class' => '')) !!}
                                    
                                    @if(Auth::check() && Auth::id() == $initiative->user->id)
                                    <a class="waves-effect waves-light btn" href="{{ 'offer/edit/'.$initiative->id.'/'.str_slug($initiative->title) }}"><i class="material-icons left">mode_edit</i> {{ $editBtn }}</a>
                                    @endif
                                </a>
                            </div>
                            @endif

                            <div class="card-content">
                                <a href="{{ 'offer/'.$initiative->id.'/'.str_slug($initiative->title) }}"><span class="card-title">{{ $initiative->title }}</span></a>

                                <div class="card-post-action">
                                    <span>{{ $initiative->initiativeType->name }}</span>
                                    <span class="card-post-action-time grey-text text-darken-1">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $initiative->created_at)->diffForHumans() }}</span>
                                    <span>- by {{ $initiative->user->name }}</span>
                                </div>

                                @isset($initiative->start_date)
                                <span class="card-post-calendar">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $initiative->start_date)->format('l, j M Y H:i') }}</span>
                                @endisset

                                <span class="card-post-address">Not available</span>
                            </div>


                            <div class="card-action card-action-footer">
                                <span class="initiative-engagement"><i class="material-icons inline-icon grey-text text-darken-3">comment</i> {{ $comments = $initiative->comments->count() }} {{ str_plural($commentLbl, $comments) }}</span>
                                <span class="initiative-engagement"><i class="material-icons inline-icon grey-text text-darken-3">people</i> {{ $supporters = $initiative->users->count() }} {{ str_plural($supportLbl, $supporters) }}</span>
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
