@extends('layouts.app')

@section('content')
    <div class="content">
        @include('partials.sidebar')

        <div class="profile-container">
            <div class="initiatives">

                <div class="row">
                    <div class="col s12 m4 l6 xl3">
                        <div class="card">
                            <div class="card-image">
                                <a href="#!">
                                    {!! HTML::image('images/initiatives/image-1.jpg', 'offer title', array('class' => '')) !!}
                                    <a class="waves-effect waves-light btn">{{ $showBtn }}</a>
                                </a>
                            </div>

                            <div class="card-content">
                                <a href="#!"><span class="card-title">Make a party for over aged people</span></a>


                                <div class="card-post-action">
                                    <span>Offers</span>
                                    <span class="card-post-action-time grey-text text-darken-1">23m</span>
                                </div>

                                <span class="card-post-calendar">Friday, 13 March 2017 18.00</span>
                                <span class="card-post-address">Via Casamassima, 46, 70010 Valenzano BA, Italy</span>
                            </div>

                            <div class="card-action card-action-footer">
                                <span><i class="material-icons inline-icon grey-text text-darken-3">comment</i> {{ $comments = 2 }} {{ str_plural($commentLbl, $comments) }}</span>
                                <span><i class="material-icons inline-icon grey-text text-darken-3">people</i> {{ $supporters = 5 }} {{ str_plural($supportLbl, $supporters) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col s12 m4 l6 xl3">
                        <div class="card">
                            <div class="card-image">
                                <a href="#!">
                                    {!! HTML::image('images/initiatives/image-2.jpg', 'offer title', array('class' => '')) !!}
                                    <a class="waves-effect waves-light btn">{{ $showBtn }}</a>
                                </a>
                            </div>

                            <div class="card-content">
                                <a href="#!"><span class="card-title">Help older people go for swimming</span></a>


                                <div class="card-post-action">
                                    <span>Demands</span>
                                    <span class="card-post-action-time grey-text text-darken-1">4h</span>
                                </div>

                                <span class="card-post-calendar">Thursday, 27 February 2017 10.00</span>
                                <span class="card-post-address">Via Casamassima, 46, 70010 Valenzano BA, Italy</span>
                            </div>

                            <div class="card-action card-action-footer">
                                <span><i class="material-icons inline-icon grey-text text-darken-3">comment</i> {{ $comments = 13 }} {{ str_plural($commentLbl, $comments) }}</span>
                                <span><i class="material-icons inline-icon grey-text text-darken-3">people</i> {{ $supporters = 2 }} {{ str_plural($supportLbl, $supporters) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col s12 m4 l6 xl3">
                        <div class="card">
                            <div class="card-image">
                                <a href="#!">
                                    {!! HTML::image('images/initiatives/image-3.jpg', 'offer title', array('class' => '')) !!}
                                    <a class="waves-effect waves-light btn">{{ $showBtn }}</a>
                                </a>
                            </div>

                            <div class="card-content">
                                <a href="#!"><span class="card-title">Make a party for over aged people</span></a>


                                <div class="card-post-action">
                                    <span>Offers</span>
                                    <span class="card-post-action-time grey-text text-darken-1">23m</span>
                                </div>

                                <span class="card-post-calendar">Friday, 13 January 2017 18.00</span>
                                <span class="card-post-address">Via Casamassima, 46, 70010 Valenzano BA, Italy</span>
                            </div>

                            <div class="card-action card-action-footer">
                                <span><i class="material-icons inline-icon grey-text text-darken-3">comment</i> {{ $comments = 2 }} {{ str_plural($commentLbl, $comments) }}</span>
                                <span><i class="material-icons inline-icon grey-text text-darken-3">people</i> {{ $supporters = 5 }} {{ str_plural($supportLbl, $supporters) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col s12 m4 l6 xl3">
                        <div class="card">
                            <div class="card-image">
                                <a href="#!">
                                    {!! HTML::image('images/initiatives/image-1.jpg', 'offer title', array('class' => '')) !!}
                                    <a class="waves-effect waves-light btn">{{ $showBtn }}</a>
                                </a>
                            </div>

                            <div class="card-content">
                                <a href="#!"><span class="card-title">Make a party for over aged people</span></a>


                                <div class="card-post-action">
                                    <span>Offers</span>
                                    <span class="card-post-action-time grey-text text-darken-1">23m</span>
                                </div>

                                <span class="card-post-calendar">Friday, 13 March 2017 18.00</span>
                                <span class="card-post-address">Via Casamassima, 46, 70010 Valenzano BA, Italy</span>
                            </div>

                            <div class="card-action card-action-footer">
                                <span><i class="material-icons inline-icon grey-text text-darken-3">comment</i> {{ $comments = 2 }} {{ str_plural($commentLbl, $comments) }}</span>
                                <span><i class="material-icons inline-icon grey-text text-darken-3">people</i> {{ $supporters = 5 }} {{ str_plural($supportLbl, $supporters) }}</span>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection

@section('jslibs')
    <script>

    </script>
@endsection
