@extends('layouts.app')

@section('csslibs')
    {!! HTML::style('owl/assets/owl.carousel.min.css') !!}
    {!! HTML::style('owl/assets/owl.theme.green.min.css') !!}
    {!! HTML::style('baguettebox/baguetteBox.min.css') !!}
@endsection

@section('content')
    <div class="content">
        @if(Auth::check())
            @include('partials.sidebar')
        @endif

        <div class="profile-container {{ Auth::check() ? '' : 'no-margin' }}">
            <div class="initiative">

                <div class="row">
                    @if(!empty($initiative))
                    <div class="col s12">
                        @if(!empty($initiative->initiativeImages))
                        <div class="owl-carousel owl-theme">
                            @foreach ($initiative->initiativeImages as $image)
                            <div class="item carousel-item">
                                <a href="{{ env('APP_URL') }}/storage/initiatives/{{ $image->name }}" data-caption="{{ $initiative->title }}">
                                    {!! HTML::image('storage/initiatives/'.$image->name, $initiative->title, array('class' => '')) !!}
                                </a>
                            </div>
                            @endforeach
                        </div>
                        @endif


                        <h1 class="h5 initiative-title">{{ $initiative->title }}</h1>

                        <div class="initiative-info">
                            <span class="initiative-type">{{ $initiative->initiativeType->name }}</span>
                            <span class="initiative-created grey-text text-darken-1">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $initiative->created_at)->diffForHumans() }}</span>
                        </div>

                        <div class="initiative-info">
                            <span class="initiative-start-date">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $initiative->start_date)->format('l, j M Y H:i') }}</span>
                            <span class="initiative-address">Not available</span>
                        </div>

                        <div class="initiative-engagements">
                            <span class="initiative-engagement"><i class="material-icons inline-icon grey-text text-darken-3">comment</i> {{ $comments = 2 }} {{ str_plural($commentLbl, $comments) }}</span>
                            <span class="initiative-engagement"><i class="material-icons inline-icon grey-text text-darken-3">people</i> {{ $supporters = 5 }} {{ str_plural($supportLbl, $supporters) }}</span>
                        </div>

                        <div class="divider"></div>

                        <div class="initiative-engagement-buttons">
                            <button class="waves-effect waves-teal btn-flat initiative-engagement">{{ $commentBtn }}</button>
                            <button class="waves-effect waves-teal btn-flat initiative-engagement">{{ $supportBtn }}</button>
                        </div>
                    </div>
                    @else
                        <p>{{ $noRecordsMsg }}</p>
                    @endif

                </div>
            </div>
        </div>

    </div>
@endsection

@section('jslibs')
    {!! HTML::script('owl/owl.carousel.min.js') !!}
    {!! HTML::script('baguettebox/baguetteBox.min.js') !!}
    <script>
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                margin: 5,
                
                autoWidth:true,
                responsive: {
                    // breakpoint from 0 up
                    0 : {
                        items: 1
                    },
                    // breakpoint from 480 up
                    480 : {
                        items: 2
                    },
                    // breakpoint from 768 up
                    768 : {
                        items: 3
                    },
                    // breakpoint from 1024 up
                    1024 : {
                        items: 4
                    },
                    // breakpoint from 1200 up
                    1200 : {
                        items: 5
                    },
                    // breakpoint from 1400 up
                    1400 : {
                        items: 6
                    }
                }
            });
        });


        baguetteBox.run('.owl-carousel', {

        });
    </script>
@endsection
