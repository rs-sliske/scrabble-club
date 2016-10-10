<div class="is-centered-x box">
    <h2>Recent Matches</h2>
    <div class="recent-matches-container">
        <div class="recent-matches">
            @foreach($user->matches as $match)
                <div class="match-result-container"> 
                    <div class="match-result-date">
                        {{ $match->created_at }}
                    </div>               
                    <div class="match-result">
                        <div class="match-result-block">
                            <div class="match-result-name">
                                <a class="plain"  href="{{ route('users.show', [$user]) }}">
                                    {{ $user->name }}
                                </a>
                            </div>
                            <div class="match-result-score">
                                {{ $match->score($user) }}
                            </div>
                        </div>
                        <div class="match-result-block">
                            <div class="match-result-name">
                                <a class="plain" href="{{ route('users.show', [$other = $match->otherPlayer($user)]) }}">
                                    {{ $other->name }}
                                </a>
                            </div>
                            <div class="match-result-score">
                                {{ $match->score($other) }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>