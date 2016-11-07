<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Styles -->
        <link href="/css/app.css" rel="stylesheet">

        <!-- Scripts -->
        <script>
            window.Laravel = <?php echo json_encode([
                    'csrfToken' => csrf_token(),
            ]); ?>
        </script>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="panel panel-default">
                                <div class="panel-heading">Podaj nick i dołącz!</div>
                                <div class="panel-body">
                                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                                        {{ csrf_field() }}

                                        <div class="form-group{{ $errors->has('nick') ? ' has-error' : '' }}">
                                            <label for="nick" class="col-md-4 control-label">Nick</label>

                                            <div class="col-md-6">
                                                <input id="nick" type="nick" class="form-control" name="nick" value="{{ old('nick') }}" required autofocus>

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
                                                    <input type="radio" name="gender" id="gender_male" value="male"> Mężczyzna
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="gender" id="gender_female" value="female"> Kobieta
                                                </label>

                                                @if ($errors->has('gender'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('gender') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('reserved') ? ' has-error' : '' }}">
                                            <div class="col-md-6 col-md-offset-4">
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" name="reserved" id="reserved" value="1"> Mam już zarezerwowany nick
                                                </label>

                                                @if ($errors->has('reserved'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('reserved') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
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

                                        <div class="form-group">
                                            <div class="col-md-8 col-md-offset-4">
                                                <button type="submit" class="btn btn-primary">
                                                    Wejdź
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
