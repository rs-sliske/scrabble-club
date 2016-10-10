<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\AddResult;
use Auth;

use App\Models\Match;
use App\Models\User;

class MatchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except'=>['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Match::with('players')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('match.create', [
            'user' => Auth::user(),
            'users' => User::whereNotIn('id', [Auth::id()])->orderBy('name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\AddResult  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddResult $request)
    {
        $match = Match::make($request->all());
        return redirect()->route('matches.show', [$match]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Match $match)
    {
        return view('match.show', [
            'match' => $match->load('players'),
            'user' => Auth::user() ?? $match->players->first(),
        ]);
    }

}
