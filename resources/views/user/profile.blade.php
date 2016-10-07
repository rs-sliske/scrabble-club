@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{$user->name}}</h2>

    <div class="recent-games-container">
        <ul class="recent-games">
            @foreach($games as $game)
                <li>
                    @if($game->winner_id == $user->id)
                        {{-- won --}}
                        <span>Won against <a href="{{ route('user.show', [$game->loser]) }}">{{$game->loser->name}}</a></span>
                        <span>{{$game->winnerScore()}} : {{$game->loserScore()}}</span>
                        <span>{{$game->created_at->diffForHumans()}}</span>
                    @else
                        @if($game->loser_id == $user->id)
                            {{-- lost --}}
                            <span>Lost against <a href="{{ route('user.show', [$game->winner]) }}">{{$game->winner->name}}</a></span>
                            <span>{{$game->winnerScore()}} : {{$game->loserScore()}}</span>
                            <span>{{$game->created_at->diffForHumans()}}</span>
                        @else
                            {{-- draw --}}
                            <span>Drew with <a href="{{ route('user.show', [$game->otherPlayer($user)]) }}">{{$game->otherPlayer($user)->name}}</a></span>
                            <span>{{$game->winnerScore()}} all</span>
                            <span>{{$game->created_at->diffForHumans()}}</span>
                        @endif
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
