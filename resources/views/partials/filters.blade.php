<div class="form-inline filters">

    <div class="form-group form-group-sm">
        <label class="sr-only" for="nick">Nick</label>
        <input type="text" class="form-control" id="nick" placeholder="Nick">
    </div>

    <div class="btn-group">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="chosen"> - wybierz województwo - </span> <span class="caret"></span>
        </button>
        <div class="dropdown-menu region">
            <span class="button-checkbox">
                <button type="button" class="btn btn-default btn-block btn-sm">Dolnośląskie</button>
                <input type="checkbox" class="hidden" />
            </span>
            <span class="button-checkbox">
                <button type="button" class="btn btn-default btn-block btn-sm">Kujawsko-pomorskie</button>
                <input type="checkbox" class="hidden" />
            </span>
            <span class="button-checkbox">
                <button type="button" class="btn btn-default btn-block btn-sm">Lubelskie</button>
                <input type="checkbox" class="hidden" />
            </span>
            <span class="button-checkbox">
                <button type="button" class="btn btn-default btn-block btn-sm">Lubuskie</button>
                <input type="checkbox" class="hidden" />
            </span>
            <span class="button-checkbox">
                <button type="button" class="btn btn-default btn-block btn-sm">Łódzkie</button>
                <input type="checkbox" class="hidden" />
            </span>
            <span class="button-checkbox">
                <button type="button" class="btn btn-default btn-block btn-sm">Małopolskie</button>
                <input type="checkbox" class="hidden" />
            </span>
            <span class="button-checkbox">
                <button type="button" class="btn btn-default btn-block btn-sm">Mazowieckie</button>
                <input type="checkbox" class="hidden" />
            </span>
            <span class="button-checkbox">
                <button type="button" class="btn btn-default btn-block btn-sm">Opolskie</button>
                <input type="checkbox" class="hidden" />
            </span>
            <span class="button-checkbox">
                <button type="button" class="btn btn-default btn-block btn-sm">Podkarpackie</button>
                <input type="checkbox" class="hidden" />
            </span>
            <span class="button-checkbox">
                <button type="button" class="btn btn-default btn-block btn-sm">Podlaskie</button>
                <input type="checkbox" class="hidden" />
            </span>
            <span class="button-checkbox">
                <button type="button" class="btn btn-default btn-block btn-sm">Pomorskie</button>
                <input type="checkbox" class="hidden" />
            </span><span class="button-checkbox">
                <button type="button" class="btn btn-default btn-block btn-sm">Śląskie</button>
                <input type="checkbox" class="hidden" />
            </span>
            <span class="button-checkbox">
                <button type="button" class="btn btn-default btn-block btn-sm">Świętokrzyskie</button>
                <input type="checkbox" class="hidden" />
            </span>
            <span class="button-checkbox">
                <button type="button" class="btn btn-default btn-block btn-sm">Warmińsko-mazurskie</button>
                <input type="checkbox" class="hidden" />
            </span>
            <span class="button-checkbox">
                <button type="button" class="btn btn-default btn-block btn-sm">Wielkopolskie</button>
                <input type="checkbox" class="hidden" />
            </span>
            <span class="button-checkbox">
                <button type="button" class="btn btn-default btn-block btn-sm">Zachodniopomorskie</button>
                <input type="checkbox" class="hidden" />
            </span>
        </div>
    </div>

    <div class="btn-group">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <span class="chosen"> - wybierz poszukujących - </span> <span class="caret"></span>
        </button>
        <div class="dropdown-menu interest">
            <span class="button-checkbox">
                <button type="button" class="btn btn-default btn-block btn-sm">Luźnej rozmowy</button>
                <input type="checkbox" class="hidden" />
            </span>
            <span class="button-checkbox">
                <button type="button" class="btn btn-default btn-block btn-sm">Spotkania</button>
                <input type="checkbox" class="hidden" />
            </span>
            {{--<span class="button-checkbox">--}}
                {{--<button type="button" class="btn btn-default btn-block btn-sm">Seksu</button>--}}
                {{--<input type="checkbox" class="hidden" />--}}
            {{--</span>--}}
            <span class="button-checkbox">
                <button type="button" class="btn btn-default btn-block btn-sm">Związku</button>
                <input type="checkbox" class="hidden" />
            </span>
            <span class="button-checkbox">
                <button type="button" class="btn btn-default btn-block btn-sm">Niczego</button>
                <input type="checkbox" class="hidden" />
            </span>
        </div>
    </div>

    <div class="form-group form-group-sm btn btn-default btn-sm">
        Od <span class="age-min">14</span>
        <div class="age-range"></div>
        do <span class="age-max">80</span> lat
    </div>

    <span class="button-checkbox">
        <button type="button" class="btn btn-default btn-sm">Kobiety</button>
        <input type="checkbox" class="hidden" checked />
    </span>
    <span class="button-checkbox">
        <button type="button" class="btn btn-default btn-sm">Mężczyźni</button>
        <input type="checkbox" class="hidden" checked />
    </span>
    <span class="button-checkbox">
        <button type="button" class="btn btn-default btn-sm">Ze zdjęciem</button>
        <input type="checkbox" class="hidden" />
    </span>
    <span class="button-checkbox">
        <button type="button" class="btn btn-default btn-sm">Z opisem</button>
        <input type="checkbox" class="hidden" />
    </span>
</div>