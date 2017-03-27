@extends('layouts.app')

@section('content')
    <div class="content">
        @include('partials.sidebar')

        <div class="profile-container">
            <div class="timeline">

                <div class="row">
                    <div class="col s12 m10 l8 xl6">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-post-action">
                                    <span class="card-post-action-component grey-text text-darken-1">{{ $postedOfferLbl }}</span> Trusted Marketplace
                                    <span class="card-post-action-time grey-text text-darken-1">23m</span>
                                </div>
                                {{--<div class="divider"></div>--}}

                                <span class="card-title">Make a party for over aged people</span>
                                <span class="card-post-address">Via Casamassima, 46, 70010 Valenzano BA, Italy</span>
                            </div>

                            <div class="card-action card-action-footer">
                                <span><i class="material-icons inline-icon grey-text text-darken-3">comment</i> {{ $comments = 2 }} {{ str_plural($commentLbl, $comments) }}</span>
                                <span><i class="material-icons inline-icon grey-text text-darken-3">people</i> {{ $supporters = 5 }} {{ str_plural($supportLbl, $supporters) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12 m10 l8 xl6">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-post-action">
                                    <span class="card-post-action-component grey-text text-darken-1">{{ $postedIssueLbl }}</span> Improve My City
                                    <span class="card-post-action-time grey-text text-darken-1">5h</span>
                                </div>

                                <span class="card-title">Cratere in Via Casamassima</span>
                                <span class="card-post-address">Via Casamassima, 46, 70010 Valenzano BA, Italy</span>
                            </div>

                            <div class="card-action card-action-footer">
                                <span><i class="material-icons inline-icon grey-text text-darken-3">trending_up</i> Recorded</span>
                                <span><i class="material-icons inline-icon grey-text text-darken-3">comment</i> {{ $comments = 1 }} {{ str_plural($commentLbl, $comments) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12 m10 l8 xl6">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-post-action">
                                    <span class="card-post-action-component grey-text text-darken-1">{{ $postedOfferLbl }}</span> Trusted Marketplace
                                    <span class="card-post-action-time grey-text text-darken-1">20 Jan 2017</span>
                                </div>
                                {{--<div class="divider"></div>--}}

                                <span class="card-title">Restore the appearence of town hall</span>
                                <span class="card-post-address">Via Casamassima, 46, 70010 Valenzano BA, Italy</span>
                            </div>

                            <div class="card-action card-action-footer">
                                <span><i class="material-icons inline-icon grey-text text-darken-3">comment</i> {{ $comments = 1 }} {{ str_plural($commentLbl, $comments) }}</span>
                                <span><i class="material-icons inline-icon grey-text text-darken-3">people</i> {{ $supporters = 2 }} {{ str_plural($supportLbl, $supporters) }}</span>
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
