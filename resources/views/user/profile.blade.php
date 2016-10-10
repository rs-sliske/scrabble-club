@extends('layouts.app')

@section('content')
<div class="container profile-page">
    <div class="is-centered-x">
        <h1>Viewing {{ $user->name }}'s Profile</h1>
        <div>
            @include('user.partials.best-result')

            @include('user.partials.stats')

            @include('user.partials.recent-matches')
        </div>
    </div>
</div>
@endsection
