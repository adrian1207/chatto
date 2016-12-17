<div id="profile">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3 class="white">{{ \Auth::user()->nick }}</h3>
                <form class="form-horizontal" role="form" v-on:submit.prevent='update'>
                    {{ csrf_field() }}

                    <div class="top-buffer">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-preview thumbnail {{ (\Auth::user()->gender) ? 'female':'male' }}" data-trigger="fileinput"></div>
                            <div>
                                <span class="btn btn-primary btn-file pull-right">
                                    <span class="fileinput-new">Wybierz zdjęcie</span>
                                    <span class="fileinput-exists">Zmień zdjęcie</span>
                                    <input type="file" name="avatar">
                                </span>
                                <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Usuń</a>
                            </div>
                        </div>
                    </div>

                    <div class="top-buffer">
                        <div class="age-profile">
                            <div class="age-handle ui-slider-handle"></div>
                        </div>
                        <input type="text" class="age-input hidden" v-model="age" />
                    </div>

                    <div class="top-buffer-20">
                        <select class="selectpicker form-control" data-style="btn-primary"  v-model="region">
                            <option> - moje województwo - </option>
                            <option>Dolnośląskie</option>
                            <option>Kujawsko-pomorskie</option>
                            <option>Lubelskie</option>
                            <option>Lubuskie</option>
                            <option>Łódzkie</option>
                            <option>Małopolskie</option>
                            <option>Mazowieckie</option>
                            <option>Opolskie</option>
                            <option>Podkarpackie</option>
                            <option>Podlaskie</option>
                            <option>Pomorskie</option>
                            <option>Śląskie</option>
                            <option>Świętokrzyskie</option>
                            <option>Warmińsko-mazurskie</option>
                            <option>Wielkopolskie</option>
                            <option>Zachodniopomorskie</option>
                        </select>
                    </div>

                    <div class="top-buffer">
                        <select class="selectpicker form-control" v-model="interests"
                                multiple
                                data-selected-text-format="count"
                                data-count-selected-text="Wybrane cele: {0}"
                                data-style="btn-primary"
                                data-none-selected-text=" - poszukuję - ">
                            <option>Luźnej rozmowy</option>
                            <option>Spotkania</option>
                            {{--<option>Seksu</option>--}}
                            <option>Związku</option>
                            <option>Niczego</option>
                        </select>
                    </div>

                    <div class="top-buffer">
                        <textarea class="form-control profile-description" rows="3" placeholder="Opisz się w kilku słowach..." v-model="about"></textarea>
                    </div>

                    <div class="top-buffer">
                        <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-pencil fa-fw"></i> Ustaw</button>
                    </div>
                </form>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-md-12">
                <form class="form-horizontal" role="reserve" method="POST" action="{{ url('/update') }}">
                    <div class="top-buffer">
                        <input type="password" class="form-control" name="password" placeholder="Hasło rezerwacji" />
                    </div>
                    <div class="top-buffer">
                        <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save fa-fw"></i> Zarezerwuj nick</button>
                    </div>
                </form>
            </div>
        </div>
        <hr />
        <div class="row">

            <div class="form-group">
                <div class="col-md-12">
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger pull-right"><i class="fa fa-sign-out fa-fw"></i> Wyloguj</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>