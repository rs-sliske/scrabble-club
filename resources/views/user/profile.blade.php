@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{$user->name}}</h2>

    <div class="recent-games-container">
        <div class="recent-matches">
            @foreach($user->matches as $match)
                <div class="match-result">
                    <div class="match-result-block">
                        <div class="match-result-name">
                            {{ $user->name }}
                        </div>
                        <div class="match-result-score">
                            {{ $match->score($user) }}
                        </div>
                    </div>
                    <div class="match-result-block">
                        <div class="match-result-name">
                            {{ ($other = $match->otherPlayer($user))->name }}
                        </div>
                        <div class="match-result-score">
                            {{ $match->score($other) }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
