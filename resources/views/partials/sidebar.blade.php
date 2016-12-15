<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/update') }}">
                {{ csrf_field() }}

                <div class="top-buffer">
                    <img src="/images/male.png" style="width: 160px; height: 160px;"/>
                </div>

                <div class="top-buffer">
                    <input type="file" class="filestyle btn btn-primary btn-block" data-badge="false" data-input="false">
                </div>

                <div class="top-buffer">
                    <div class="age-profile">
                        <div class="age-handle ui-slider-handle"></div>
                    </div>
                </div>

                <div class="top-buffer-20">
                    <select class="selectpicker form-control"
                            data-style="btn-primary">

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
                    <select class="selectpicker form-control"
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
                    <textarea class="form-control profile-description" rows="3" placeholder="Opisz się w kilku słowach..."></textarea>
                </div>
            </form>
        </div>
    </div>
</div>
<hr />

<div class="form-group">
    <div class="col-md-12">
        <form id="logout-form" action="{{ url('/logout') }}" method="POST">
            {{ csrf_field() }}
            <input type="submit" class="btn btn-danger" value="Wyloguj" />
        </form>
    </div>
</div>
