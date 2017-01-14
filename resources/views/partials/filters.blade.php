<div class="form-inline filters">

    <div class="form-group form-group-sm">
        <label class="sr-only" for="nick">Nick</label>
        <input type="text" class="form-control" id="nick" placeholder="Nick">
    </div>

    <div class="form-group form-group-sm filter-region">
        <select class="selectpicker form-control"
                multiple
                data-selected-text-format="count"
                data-count-selected-text="Województwa: {0}"
                data-style="btn btn-default btn-sm"
                data-none-selected-text=" - województwa - ">

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

    <div class="form-group form-group-sm filter-target">
        <select class="selectpicker form-control"
                multiple
                data-selected-text-format="count"
                data-count-selected-text="Cele: {0}"
                data-style="btn btn-default btn-sm"
                data-none-selected-text=" - poszukujący - ">

            <option>Luźnej rozmowy</option>
            <option>Spotkania</option>
            {{--<option>Seksu</option>--}}
            <option>Związku</option>
            <option>Niczego</option>
        </select>
    </div>

    <div class="form-group form-group-sm btn btn-default btn-sm">
        Od <span class="age-min">14</span>
        <div class="age-range"></div>
        do <span class="age-max">70</span> lat
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