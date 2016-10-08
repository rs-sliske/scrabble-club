@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <form action="{{route('matches.store')}}" method="post">
            {{csrf_field()}}
            <div class="form-group">
                <h4>Player 1</h4>
                <div class="form-input-group">
                    <label for="user_1_id">Player</label>
                    <select name="user_1_id">
                        <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                        @foreach($users as $player)
                            <option value="{{$player->id}}">{{$player->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-input-group">
                    <label for="user_1_score">Score</label>
                    <input type="number" name="user_1_score">
                </div>
            </div>
            <div class="form-group">
                <h4>Player 2</h4>
                <div class="form-input-group">
                    <label for="user_2_id">Player</label>
                    <select name="user_2_id">
                        @foreach($users as $player)
                            <option value="{{$player->id}}">{{$player->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-input-group">
                    <label for="user_2_score">Score</label>
                    <input type="number" name="user_2_score">
                </div>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</div>
@endsection
