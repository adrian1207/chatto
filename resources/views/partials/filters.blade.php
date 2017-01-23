<div id="filters" class="form-inline filters">

    <div class="form-group form-group-sm">
        <label class="sr-only" for="nick">Nick</label>
        <input type="text" class="form-control" id="nick" placeholder="Nick" v-model="filters.nick" v-on:keyup="setFilters()">
    </div>

    <div class="form-group form-group-sm filter-region">
        <select class="selectpicker form-control" v-model="filters.region" v-on:change="setFilters()"
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
        <select class="selectpicker form-control" v-model="filters.interests" v-on:change="setFilters()"
                multiple
                data-selected-text-format="count"
                data-count-selected-text="Cele: {0}"
                data-style="btn btn-default btn-sm"
                data-none-selected-text=" - poszukujący - ">

            <option>Luźnej rozmowy</option>
            <option>Spotkania</option>
            <option>Związku</option>
            <option>Przyjaźni</option>
            <option>Seksu</option>
            <option>Niczego</option>
        </select>
    </div>

    <div class="form-group form-group-sm btn btn-default btn-sm">
        Od <span class="age-min">14</span>
        <div class="age-range"></div>
        do <span class="age-max">70</span> lat
    </div>

    <span class="button-checkbox">
        <button type="button" class="btn btn-default btn-sm" v-on:click="setFemale()">Kobiety</button>
        <input type="checkbox" class="hidden" checked />
    </span>
    <span class="button-checkbox">
        <button type="button" class="btn btn-default btn-sm" v-on:click="setMale()">Mężczyźni</button>
        <input type="checkbox" class="hidden" checked/>
    </span>
    <span class="button-checkbox">
        <button type="button" class="btn btn-default btn-sm" v-on:click="setPhoto()">Ze zdjęciem</button>
        <input type="checkbox" class="hidden" />
    </span>
    <span class="button-checkbox">
        <button type="button" class="btn btn-default btn-sm" v-on:click="setAbout()">Z opisem</button>
        <input type="checkbox" class="hidden"/>
    </span>

    <div class="form-group form-group-sm sorting">
        <select class="selectpicker form-control" data-style="btn btn-default btn-sm" v-model="sorting" v-on:change="changeSorting()">
            <option value="by_nick">Sortuj po nicku</option>
            <option value="by_age">Sortuj po wieku</option>
        </select>
    </div>
</div>