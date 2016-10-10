@extends('layouts.app')

@section('content')
<div class="container">
    <div class="is-centered-x">
        <form action="{{route('matches.store')}}" method="post">
            {{csrf_field()}}
            <div class="form-group">
                <h4>Player 1</h4>
                <div class="form-input-group{{ $errors->has('user_1_id') ? ' has-error' : '' }}">
                    <label for="user_1_id">Player</label>
                    <select name="user_1_id">
                        @if($user)
                            <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                        @endif
                        @foreach($users as $player)
                            <option value="{{$player->id}}">{{$player->name}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('user_1_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('user_1_id') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-input-group{{ $errors->has('user_1_score') ? ' has-error' : '' }}">
                    <label for="user_1_score">Score</label>
                    <input type="number" name="user_1_score" required>
                    @if ($errors->has('user_1_score'))
                        <span class="help-block">
                            <strong>{{ $errors->first('user_1_score') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <h4>Player 2</h4>
                <div class="form-input-group{{ $errors->has('user_2_id') ? ' has-error' : '' }}">
                    <label for="user_2_id">Player</label>
                    <select name="user_2_id">
                        @foreach($users as $player)
                            <option value="{{$player->id}}">{{$player->name}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('user_2_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('user_2_id') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-input-group{{ $errors->has('user_2_score') ? ' has-error' : '' }}">
                    <label for="user_2_score">Score</label>
                    <input type="number" name="user_2_score" required>
                    @if ($errors->has('user_2_score'))
                        <span class="help-block">
                            <strong>{{ $errors->first('user_2_score') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</div>
@endsection
