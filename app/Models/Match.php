<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Match extends Model
{
    public function players()
    {
        return $this->belongsToMany(User::class)->withTimestamps()->withPivot('score')->orderBy('pivot_score', 'DESC');
    }

    public static function make(array $data)
    {
        $match = new self;
        $match->save();

        for ($i = 1; $i <= 2; $i++) {
            $match->players()->attach($data["user_{$i}_id"], ['score' => $data["user_{$i}_score"]]);
        }

        return $match;
    }

    public function score(User $user = null)
    {
        $user = $user ?? Auth::user();
        if (! $user) {
            return -1;
        }

        return $this->players->where('id', $user->id)->first()->pivot->score;
    }

    public function otherPlayer(User $user = null)
    {
        $user = $user ?? Auth::user();
        if (! $user) {
            return new User;
        }

        return $this->players->filter(function ($value) use ($user) {
            return $value->id != $user->id;
        })->first();
    }

    public function winner()
    {
        return $this->players->first();
    }

    public function loser()
    {
        return $this->players->last();
    }

    public function winnerScore()
    {
        return $this->winner()->pivot->score;
    }

    public function loserScore()
    {
        return $this->loser()->pivot->score;
    }
}
