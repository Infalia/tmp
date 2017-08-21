@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            @php
                echo $user->getId().'<br>';
                echo $user->getNickname().'<br>';
                echo $user->getName().'<br>';
                echo $user->getEmail().'<br>';
                echo $user->getAvatar();

                echo '<pre>';
                print_r($user->getRaw());
                echo '</pre>';
            @endphp
        </div>
    </div>
@endsection

@section('jslibs')
@endsection