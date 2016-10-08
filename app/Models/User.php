<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'contact_number'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'administrator' => 'bool',
    ];

    public function matches()
    {
        return $this->belongsToMany(Match::class)->withTimestamps()->withPivot('score')->latest('pivot_created_at');
    }

    public function won()
    {
        return $this->matches->filter(function($value, $key){
            return $value->winner()->id === $this->id;
        });
    }

    public function lost()
    {
        return $this->matches->filter(function($value, $key){
            return $value->loser()->id === $this->id;
        });
    }

    public function totalScore()
    {
        return $this->matches->sum(function($value){
            return $value->pivot->score;
        });
    }
    public function bestScore()
    {
        return $this->matches->max(function($value){
            return $value->pivot->score;
        });
    }
    public function averageScore()
    {
        return (int) ($this->totalScore() / $this->matches->count());
    }

    public function winRatio()
    {
        $res = $this->won()->count() / $this->matches->count();
        $res *= 100.0;
        return (int) $res;
    }

    public function toArray()
    {
        $data = [
            'name' => $this->name,
            'played' => $this->matches->count(),
            'wins' => $this->won()->count(),
            'losses' => $this->lost()->count(),
            'wlr' => $this->winRatio(),
            's-latest' => $this->matches->first()->pivot->score,
            's-total' => $this->totalScore(),
            's-best' => $this->bestScore(),
            's-average' => $this->averageScore(),
        ];

        $formatted = $data;

        $formatted['wlr'] .= '%';

        return [
            'data' => $data,
            'formatted' => $formatted,
        ];
    }
}
