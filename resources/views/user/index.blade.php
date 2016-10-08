@extends('layouts.app')

@section('content')


<div class="container">
    <div class="user-list-container">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    @foreach($cols as $key => $val)
                        <td class="{{$sort == $key ? 'current' : ''}}">
                            <a 
                                class="plain" 
                                href="{{ 
                                    route('users.index', 
                                        array_merge(
                                            request()->all(),
                                            [
                                                'sortby' => $key, 
                                                'direction' => $sort == $key ? ($desc ? 'asc' : 'desc') : 'desc'
                                            ]
                                        )
                                    ) 
                                }}"
                            >
                                {{$val}}
                            </a>
                        </td>
                    @endforeach
                    
                </tr>
            </thead>
            <tbody>
                @foreach($users as $player)
                    <tr class="{{ $player->id === auth()->id() ? 'success' : '' }}">

                        @foreach($cols as $key => $val)
                            <td class="{{$sort == $key ? 'current' : ''}}">
                                @if($key == 'name')
                                    <a href="{{ route('users.show', [$player]) }}">
                                @endif
                                {{ $player->toArray()['formatted'][$key] }}
                                @if($key == 'name')
                                    </a>
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach                
            </tbody>
        </table>

    </div>



</div>


@endsection
