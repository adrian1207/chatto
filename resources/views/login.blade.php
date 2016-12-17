@extends('layouts.welcome')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">Podaj nick i dołącz!</div>
        <div class="panel-body">

            @if ($errors->has('global'))
                <div class="alert alert-danger">
                    <strong>{{ $errors->first('global') }}</strong>
                </div>
            @endif

            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('nick') ? ' has-error' : '' }}">
                    <label for="nick" class="col-md-4 control-label">Nick</label>

                    <div class="col-md-6">
                        <input id="nick" type="nick" class="form-control" name="nick" value="{{ old('nick') }}" autofocus>

                        @if ($errors->has('nick'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nick') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                    <div class="col-md-6 col-md-offset-4">
                        <label class="radio-inline">
                            <input type="radio" name="gender" id="gender_male" value="male" {{ (old('gender') == "male")? 'checked':'' }}> <strong>Mężczyzna</strong>
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="gender" id="gender_female" value="female" {{ (old('gender') == "female")? 'checked':'' }}> <strong>Kobieta</strong>
                        </label>

                        @if ($errors->has('gender'))
                            <span class="help-block">
                                <strong>{{ $errors->first('gender') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <span class="button-checkbox">
                            <button type="button" class="btn btn-default btn-sm">Mam już zarezerwowany nick</button>
                            <input type="checkbox" class="hidden" name="reserved" id="reserved" value="1" {{ (old('reserved') == "1")? 'checked':'' }} />
                        </span>
                    </div>
                </div>

                <div class="pass-field form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label">Hasło</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password">

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <hr />
                <div class="form-group">
                    <div class="col-md-3 col-md-offset-7">
                        <button type="submit" class="btn btn-primary btn-block">
                            Dołącz
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
