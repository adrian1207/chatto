<div class="container-fluid">
    <div class="row">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/update') }}">
            {{ csrf_field() }}

            {{--<img src="/images/male.png" style="width: 160px; height: 160px;"/>--}}


            <div class="forum-group">
                <div class="col-md-12">
                    <input type="file" class="filestyle btn btn-primary btn-block" data-badge="false" data-input="false">
                </div>
            </div>


            <div class="forum-group">
                <div class="col-md-12">
                    <div class="btn-group btn-block">
                        <button type="button" class="btn btn-primary dropdown-toggle btn-block" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="chosen"> - moje województwo - </span> <span class="caret"></span>
                        </button>
                        <div class="dropdown-menu primary region">
                            <div class="row">
                                <div class="col-md-4">
                                    <span class="button-radio">
                                        <button type="button" class="btn btn-primary btn-block">Dolnośląskie</button>
                                        <input type="radio" name="region" class="hidden" />
                                    </span>
                                    <span class="button-radio">
                                        <button type="button" class="btn btn-primary btn-block">Kujawsko-pomorskie</button>
                                        <input type="radio" name="region" class="hidden" />
                                    </span>
                                    <span class="button-radio">
                                        <button type="button" class="btn btn-primary btn-block">Lubelskie</button>
                                        <input type="radio" name="region" class="hidden" />
                                    </span>
                                    <span class="button-radio">
                                        <button type="button" class="btn btn-primary btn-block">Lubuskie</button>
                                        <input type="radio" name="region" class="hidden" />
                                    </span>
                                    <span class="button-radio">
                                        <button type="button" class="btn btn-primary btn-block">Łódzkie</button>
                                        <input type="radio" name="region" class="hidden" />
                                    </span>
                                    <span class="button-radio">
                                        <button type="button" class="btn btn-primary btn-block">Małopolskie</button>
                                        <input type="radio" name="region" class="hidden" />
                                    </span>
                                </div>
                                <div class="col-md-4">
                                    <span class="button-radio">
                                        <button type="button" class="btn btn-primary btn-block">Mazowieckie</button>
                                        <input type="radio" name="region" class="hidden" />
                                    </span>
                                    <span class="button-radio">
                                        <button type="button" class="btn btn-primary btn-block">Opolskie</button>
                                        <input type="radio" name="region" class="hidden" />
                                    </span>
                                    <span class="button-radio">
                                        <button type="button" class="btn btn-primary btn-block">Podkarpackie</button>
                                        <input type="radio" name="region" class="hidden" />
                                    </span>
                                    <span class="button-radio">
                                        <button type="button" class="btn btn-primary btn-block">Podlaskie</button>
                                        <input type="radio" name="region" class="hidden" />
                                    </span>
                                    <span class="button-radio">
                                        <button type="button" class="btn btn-primary btn-block">Pomorskie</button>
                                        <input type="radio" name="region" class="hidden" />
                                    </span>
                                    <span class="button-radio">
                                        <button type="button" class="btn btn-primary btn-block">Śląskie</button>
                                        <input type="radio" name="region" class="hidden" />
                                    </span>
                                </div>
                                <div class="col-md-4">
                                    <span class="button-radio">
                                        <button type="button" class="btn btn-primary btn-block">Świętokrzyskie</button>
                                        <input type="radio" name="region" class="hidden" />
                                    </span>
                                    <span class="button-radio">
                                        <button type="button" class="btn btn-primary btn-block">Warmińsko-mazurskie</button>
                                        <input type="radio" name="region" class="hidden" />
                                    </span>
                                    <span class="button-radio">
                                        <button type="button" class="btn btn-primary btn-block">Wielkopolskie</button>
                                        <input type="radio" name="region" class="hidden" />
                                    </span>
                                    <span class="button-radio">
                                        <button type="button" class="btn btn-primary btn-block">Zachodniopomorskie</button>
                                        <input type="radio" name="region" class="hidden" />
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="forum-group">
                <div class="col-md-12">
                    <div class="btn-group btn-block">
                        <button type="button" class="btn btn-primary dropdown-toggle btn-block" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="chosen"> - poszukuję - </span> <span class="caret"></span>
                        </button>
                        <div class="dropdown-menu primary interest">
                            <span class="button-checkbox">
                                <button type="button" class="btn btn-primary btn-block">Luźnej rozmowy</button>
                                <input type="checkbox" class="hidden" />
                            </span>
                            <span class="button-checkbox">
                                <button type="button" class="btn btn-primary btn-block">Spotkania</button>
                                <input type="checkbox" class="hidden" />
                            </span>
                            {{--<span class="button-checkbox">--}}
                                {{--<button type="button" class="btn btn-primary btn-block">Seksu</button>--}}
                                {{--<input type="checkbox" class="hidden" />--}}
                            {{--</span>--}}
                            <span class="button-checkbox">
                                <button type="button" class="btn btn-primary btn-block">Związku</button>
                                <input type="checkbox" class="hidden" />
                            </span>
                            <span class="button-checkbox">
                                <button type="button" class="btn btn-primary btn-block">Niczego</button>
                                <input type="checkbox" class="hidden" />
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{--<div class="forum-group">--}}
                {{--<div class="col-md-12">--}}
                    {{--<input id="nick" type="nick" class="form-control" name="nick" placeholder="">--}}
                {{--</div>--}}
            {{--</div>--}}
        </form>
    </div>
</div>


<form id="logout-form" action="{{ url('/logout') }}" method="POST">
    {{ csrf_field() }}
    <input type="submit" class="btn btn-danger" value="Wyloguj" />
</form>
