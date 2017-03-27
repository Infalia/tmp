@extends('layouts.app')

@section('content')
    <div class="content">
        @include('partials.sidebar')

        <div class="profile-container">
            <div class="notifications">

                <div class="row">
                    <div class="col s12 m10 l8 xl6">

                        <ul class="collection">
                            <li class="collection-item avatar-like">
                                <span class="collection-item-title">Make a party for over aged people</span>

                                <div class="collection-item-secondary-content">
                                    <span>Offers</span>
                                    <span class="collection-item-time grey-text text-darken-1">23m</span>
                                    <span>- {{ $byLbl }} Nick Galis</span>
                                </div>

                                <div class="secondary-content">
                                    <span class="new badge"></span>
                                </div>
                            </li>
                            <li class="collection-item avatar-like">
                                <span class="collection-item-title">Make a party for over aged people</span>

                                <div class="collection-item-secondary-content">
                                    <span>Demands</span>
                                    <span class="collection-item-time grey-text text-darken-1">8h</span>
                                    <span>- {{ $byLbl }} Larry Bird</span>
                                </div>

                                <div class="secondary-content">
                                    <span class="new badge"></span>
                                </div>
                            </li>
                            <li class="collection-item">
                                <span class="collection-item-title">Make a party for over aged people</span>

                                <div class="collection-item-secondary-content">
                                    <span>Demands</span>
                                    <span class="collection-item-time grey-text text-darken-1">Yesterday</span>
                                    <span>- {{ $byLbl }} Arvydas Sabonis</span>
                                </div>
                            </li>
                            <li class="collection-item">
                                <span class="collection-item-title">Make a party for over aged people</span>

                                <div class="collection-item-secondary-content">
                                    <span>Offers</span>
                                    <span class="collection-item-time grey-text text-darken-1">5d</span>
                                    <span>- {{ $byLbl }} Kobe Bryant</span>
                                </div>
                            </li>
                            <li class="collection-item">
                                <span class="collection-item-title">Make a party for over aged people</span>

                                <div class="collection-item-secondary-content">
                                    <span>Offers</span>
                                    <span class="collection-item-time grey-text text-darken-1">20 Jan 2017</span>
                                    <span>- {{ $byLbl }} Reggie Miller</span>
                                </div>
                            </li>
                            <li class="collection-item">
                                <span class="collection-item-title">Make a party for over aged people</span>

                                <div class="collection-item-secondary-content">
                                    <span>Offers</span>
                                    <span class="collection-item-time grey-text text-darken-1">8 Jan 2017</span>
                                    <span>- {{ $byLbl }} Joe Doe</span>
                                </div>
                            </li>
                            <li class="collection-item">
                                <span class="collection-item-title">Make a party for over aged people</span>

                                <div class="collection-item-secondary-content">
                                    <span>Offers</span>
                                    <span class="collection-item-time grey-text text-darken-1">5d</span>
                                    <span>- {{ $byLbl }} Kobe Bryant</span>
                                </div>
                            </li>
                            <li class="collection-item">
                                <span class="collection-item-title">Make a party for over aged people</span>

                                <div class="collection-item-secondary-content">
                                    <span>Offers</span>
                                    <span class="collection-item-time grey-text text-darken-1">20 Jan 2017</span>
                                    <span>- {{ $byLbl }} Reggie Miller</span>
                                </div>
                            </li>
                            <li class="collection-item">
                                <span class="collection-item-title">Make a party for over aged people</span>

                                <div class="collection-item-secondary-content">
                                    <span>Offers</span>
                                    <span class="collection-item-time grey-text text-darken-1">8 Jan 2017</span>
                                    <span>- {{ $byLbl }} Joe Doe</span>
                                </div>
                            </li>
                        </ul>

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
