@extends('layouts.app')

@section('content')


<div class="container">
    <h3>All Users</h3>

    <div class="user-list-container">
        <ul class="user-list">

        @foreach($users as $user)
            <li>
                <a href="{{ route('users.show', [$user]) }}">
                    {{ $user->name }}
                </a>
            </li>
        @endforeach

        </ul>

    </div>



</div>


@endsection
