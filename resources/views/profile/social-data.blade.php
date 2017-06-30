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
                    $twUser = null;
                    $pinUser = null;


                    if(array_has($user, 'social_data.facebook')) {
                        $fbUser = $user['social_data']['facebook'];
                    }

                    if(array_has($user, 'social_data.google')) {
                        $glUser = $user['social_data']['google'];
                    }

                    if(array_has($user, 'social_data.linkedin')) {
                        $linUser = $user['social_data']['linkedin'];
                    }

                    if(array_has($user, 'social_data.twitter')) {
                        $twUser = $user['social_data']['twitter'];
                    }

                    if(array_has($user, 'social_data.pinterest')) {
                        $pinUser = $user['social_data']['pinterest'];
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

                    if(!empty($twUser)) {
                        echo '<pre>';
                        print_r($twUser->getRaw());
                        echo '</pre>';
                    }

                    if(!empty($pinUser)) {
                        echo '<pre>';
                        //$pinUser->getRaw();
                        print_r($pinUser);
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
