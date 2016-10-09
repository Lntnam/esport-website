<div class="form-group">
    <label for="schedule">Schedule</label>
    <div class="input-group date" id="schedulepicker">
        <input type="text" class="form-control" name="schedule"
               placeholder="{{ \Carbon\Carbon::now(config('settings.default_timezone'))->format(config('settings.match_format')) }}"
               value="{{ old('schedule', $model->schedule) }}"/>
        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
    </div>
</div>

<div class="form-group">
    <label for="tournament_id">Tournament</label>
    <div class="input-group" id="groupTournament">
        {!! Form::select('tournament_id',
            $tournaments,
            old('tournament_id', $model->tournament_id),
            ['placeholder'=>trans('contents.match-tour-default'), 'id'=>'tournament'])
        !!}
    </div>
</div>

<div class="form-group">
    <label for="opponent_id">Opponent</label>
    <div class="input-group" id="groupOpponent">
        {!! Form::select('opponent_id',
            $opponents,
            old('opponent_id', $model->opponent_id),
            ['placeholder'=>trans('contents.match-opponent-default'), 'id'=>'opponent'])
        !!}
    </div>
</div>

<div class="form-group">
    <label for="games">Best of</label>
    {!! Form::select('games', [1=>1, 2=>2, 3=>3, 5=>5, 7=>7], old('games', $model->games), ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    <label for="stream">Stream / Video URL</label>
    <input id="stream" type="url" class="form-control" name="stream"
           value="{{ old('stream', $model->stream) }}"/>
</div>

<div class="form-group">
    <label for="round">Round</label>
    <input id="round" type="text" class="form-control" name="round"
           placeholder="Qualifier / Play-off / Main event"
           value="{{ old('round', $model->round) }}"/>
</div>

<div class="form-group">
    <label for="result">Result</label>
    <div class="input-group">
        <div class="col-md-4">
            <input type="number" class="form-control" name="for"
                   placeholder="wins"
                   value="{{ old('for', $model->for) }}"/>
        </div>
        <div class="col-md-1">
            <span class="glyphicon glyphicon-minus" style="margin-top: 8px;"></span>
        </div>
        <div class="col-md-4">
            <input type="number" class="form-control" name="against"
                   placeholder="loses"
                   value="{{ old('against', $model->against) }}"/>
        </div>
    </div>
</div>

<div class="checkbox">
    <label>
        <input type="hidden" name="over" value="0">
        <input type="checkbox" name="over" value="1" {{ old('over', $model->over) ? 'checked="checked"' : '' }}>
        This match is over</label>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">Submit</button>
    <button type="reset" class="btn btn-default">Reset</button>
    <a href="{{ route('back.fixtures.index', ['game' => $game]) }}" type="button" class="btn btn-link">&laquo; Back</a>
</div>
