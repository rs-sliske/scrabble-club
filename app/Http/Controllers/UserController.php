<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UpdateUser;
use Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $minGames = $request->input('mingames', 0);
        $users = User::with('matches.players')->withCount('matches')->where('matches_count', '>=', $minGames)->get();

        if (! count($users)) {
            return view('user.emptyindex');
        }

        $desc = $request->input('direction', 'desc') == 'desc';
        $method = 'sortBy';

        if ($desc) {
            $method .= 'Desc';
        }

        $sort = $request->input('sortby', 'name');

        $users = $users->$method(function ($value) use ($sort) {
            return $value->toArray()['data'][$sort];
        });

        $cols = [];
        foreach (array_keys($users->first()->toArray()['data']) as $col) {
            $cols[$col] = $col;
        }

        $cols['s-latest'] = 'Latest Score';
        $cols['s-average'] = 'Average Score';
        $cols['s-total'] = 'Total Score';
        $cols['s-best'] = 'Best Score';
        $cols['name'] = 'Name';
        $cols['played'] = 'Games Played';
        $cols['wins'] = 'Games Won';
        $cols['losses'] = 'Games Lost';
        $cols['wlr'] = 'Win %';

        $data = [
            'users' => $users,
            'sort' => $sort,
            'desc' => $desc,
            'cols' => $cols,
        ];

        return view('user.index', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('user.profile', [
            'user' => $user->load('matches.players'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if ($user->id != Auth::id()) {
            return redirect('/');
        }

        return view('user.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UpdateUser  $request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, User $user)
    {
        // dd($request);
        if ($user->id != Auth::id()) {
            return redirect('/');
        }
        $user->update($request->all());

        return redirect()->route('users.show', [$user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->id != Auth::id()) {
            return redirect('/');
        }
        $user->delete();

        return redirect()->route('users.index');
    }
}
