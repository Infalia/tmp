@extends('layouts.app')

@section('content')
    <div class="content">
        @include('partials.sidebar')

        <div class="profile-container">
            @php
                if(!empty($user)) {
                    $fbUser = null;
                    $glUser = null;
                    $linUser = null;

                    if(array_has($user, 'social_data.facebook')) {
                        $fbUser = $user['social_data']['facebook'];
                    }

                    if(array_has($user, 'social_data.google')) {
                        $glUser = $user['social_data']['google'];
                    }

                    if(array_has($user, 'social_data.linkedin')) {
                        $linUser = $user['social_data']['linkedin'];
                    }


                    if(!empty($fbUser)) {
                        echo '<pre>';
                        print_r($fbUser->getRaw());
                        echo '</pre>';
                    }

                    if(!empty($glUser)) {
                        echo '<pre>';
                        print_r($glUser->getRaw());
                        echo '</pre>';
                    }

                    if(!empty($linUser)) {
                        echo '<pre>';
                        print_r($linUser->getRaw());
                        echo '</pre>';
                    }
                }
                else {
                    echo 'It is null';
                }
            @endphp
        </div>

    </div>
@endsection
