/**
 * Komponent boksa użytkownika
 */
Vue.component('user', require('./components/user.vue'));

/**
 * Komponent okna rozmowy
 */
Vue.component('talk', require('./components/talk.vue'));

/**
 * Komponent VueIsotope do siatek na Vue (https://github.com/David-Desmaisons/Vue.Isotope)
 */
Vue.component('isotope', window.vueIsotope);

/**
 * Dyrektywa VueImagesLoaded do ustawienia blokó po załadowaniu zdjęć (https://github.com/David-Desmaisons/Vue.ImagesLoaded)
 */
Vue.directive('imagesLoaded', window.imagesLoaded);

/**
 * Główna aplikacja Czatu
 */
var chatApp = new Vue({
    el: '#chat',
    data: {
        user_id: null,
        users: [],
        talks: {},
        nobody: false,
        filters: {}
    },
    methods: {

        /**
         * Połączenie do czatu ogólnego
         */
        echoGlobal: function()
        {
            Echo.join('presence')
                .here((users) => {
                    this.users = users;
                })
                .joining((user) => {
                    this.users.push(user);
                })
                .leaving((user) => {
                    var index = this.users.map(function(usr) { return usr.id; }).indexOf(user.id);
                    this.users.splice(index, 1);
                })
                .listen('InvitationEvent', (participants) => {
                    this.privateConnect(participants.sender, participants.recipient);
                });
        },

        /**
         * Połączenie do czatu prywatnego
         *
         * @param channel
         * @param sender
         * @param recipient
         */
        echoPrivate: function(channel, sender, recipient)
        {
            Echo.join(channel)
                .joining((user) => {
                    this.talks[channel].messages.push({content: 'Dołączył: '+user.nick, type: 'info'});
                })
                .leaving((user) => {
                    this.talks[channel].messages.push({content: 'Opuścił: '+user.nick, type: 'info'});
                })
                .listen('MessageEvent', (message) => {
                    this.privateOpen(sender, recipient);
                    this.talks[channel].messages.push({content: message.message, type: 'received'});
                });
        },

        /**
         * Event zaproszenia innego użytkownika do kanału prywatnego
         *
         * @param sender
         * @param recipient
         */
        eventInvite: function(sender, recipient)
        {
            if (sender == recipient)
                return false;

            this.privateConnect(sender, recipient);
            this.privateOpen(sender, recipient);
            this.$http.post('/chat/invite', {sender: sender, recipient: recipient});
        },

        /**
         * Dołączenie użytkownika do kanału prywatnego
         *
         * @param sender
         * @param recipient
         */
        privateConnect: function(sender, recipient)
        {
            var channel = setChannelName(sender, recipient);

            this.echoPrivate(channel, sender, recipient);
        },

        /**
         * Otworzenie okna rozmowy użytkownikowi
         *
         * @param sender
         * @param recipient
         */
        privateOpen: function(sender, recipient)
        {
            var channel = setChannelName(sender, recipient);
            var members = setMembers(this.users, this.user_id, sender, recipient);

            if ((sender == this.user_id || recipient == this.user_id) && !this.talks[channel])
            {
                this.$set(this.talks, channel, {messages: [], members: members});
            }
        },

        /**
         * Opuszczenie kanału prywatnego
         *
         * @param channel
         */
        privateExit: function(channel)
        {
            Echo.leave(channel);
            this.$delete(this.talks, channel);
        },

        /**
         * Wykonanie sortowania vue isotope
         *
         * @param name
         */
        sort: function(name)
        {
            this.$refs.grid.sort(name);
        },

        /**
         * Wykonanie filtrowania vue isotope
         *
         * @param filters
         */
        filter: function(filters)
        {
            var $vue = this;

            this.filters = filters;
            this.$refs.grid.filter('filter');

            setTimeout(function(){$vue.nobody = $('.grid .user:visible').length == 0;}, 400);
        },

        /**
         * Wykonanie przeboksowania po załadowaniu zdjęć
         */
        layout: function()
        {
            this.$refs.grid.layout('masonry');
        },

        /**
         * Ustawienia vue isotope
         *
         * @returns json
         */
        isotopeOptions: function()
        {
            var $vue = this;

            return {
                sortBy: 'by_nick',
                getSortData: {
                    by_nick: function(user) {
                        return user.nick.toLowerCase();
                    },
                    by_age: function(user) {
                        return user.age;
                    }
                },
                getFilterData: {
                    filter: function(user) {
                        return filter(user, $vue.filters);
                    }
                }
            };
        }
    },
    mounted: function()
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        /**
         * User ID pobrane z meta
         *
         * @type {*|jQuery}
         */
        this.user_id = $('meta[name="user-id"]').attr('content');

        /**
         * Połączenie do czatu ogólnego
         */
        this.echoGlobal();
    }
});

var filtersApp = new Vue({
    el: '#filters',
    data: {
        sorting: 'by_nick',
        filters: {
            nick: '',
            region: [],
            interests: [],
            age_min: 14,
            age_max: 70,
            female: true,
            male: true,
            photo: false,
            about: false
        },
        age_min: 14,
        age_max: 70
    },
    methods: {
        /**
         * Zmiana sortowania w aplikacji czatu
         */
        changeSorting: function ()
        {
            chatApp.sort(this.sorting);
        },

        /**
         * Filtrowanie po nazwie filtru w aplikacji czatu
         */
        setFilters: function ()
        {
            this.filters.age_min = this.age_min;
            this.filters.age_max = this.age_max;

            chatApp.filter(this.filters);
        },

        /**
         * Filtrowanie mężczyzn
         */
        setMale: function ()
        {
            this.filters.male = !this.filters.male;

            chatApp.filter(this.filters);
        },

        /**
         * Filtrowanie kobiet
         */
        setFemale: function ()
        {
            this.filters.female = !this.filters.female;

            chatApp.filter(this.filters);
        },

        /**
         * Filtrowanie ze zdjeciami
         */
        setPhoto: function ()
        {
            this.filters.photo = !this.filters.photo;

            chatApp.filter(this.filters);
        },

        /**
         * Filtrowanie z opisami
         */
        setAbout: function ()
        {
            this.filters.about = !this.filters.about;

            chatApp.filter(this.filters);
        }
    }
});

/**
 * Aplikacja ustawień użytkownika
 */
var profileApp = new Vue({
    el: '#profile',
    data: {
        reserved: false,
        changed: false,
        updated: false
    },
    methods: {
        /**
         * Aktualizacja profilu użytkownika
         */
        update: function(event)
        {
            var $vue = this;

            Echo.leave('presence');

            if (!$(event.target).valid())
                return;

            this.$http.post('/chat/update', new FormData(event.target))
                .then((response) => {
                    $vue.changed = !response.ok;
                    $vue.updated = response.ok;
                    showingAlert(false);

                    chatApp.echoGlobal();
            });
        },

        /**
         * Zdarzenie zmiany wartości w formularzu
         */
        change: function()
        {
            this.changed = true;
            this.updated = false;
        },

        /**
         * Rezerwacja nicku użytkownika
         */
        reserve: function(event)
        {
            var $vue = this;

            if (!$(event.target).valid())
                return;

            this.$http.post('/chat/reserve', new FormData(event.target))
                .then((response) => {
                    $vue.reserved = response.ok;
                    showingAlert(true);
            });
        }
    },
    mounted: function()
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }
});

/**
 * Jednolita nazwa kanału
 *
 * @param sender
 * @param recipient
 */
function setChannelName(sender, recipient)
{
    if (sender > recipient)
        return 'priv-'+sender+'-'+recipient;
    if (sender < recipient)
        return 'priv-'+recipient+'-'+sender;
}

/**
 * Obiekt członków czatu
 *
 * @param users
 * @param me
 * @param sender
 * @param recipient
 * @returns {{me: *, guest: *}}
 */
function setMembers(users, me, sender, recipient)
{
    var senderIndex = users.map(function(usr) { return usr.id; }).indexOf(sender);
    var recipientIndex = users.map(function(usr) { return usr.id; }).indexOf(recipient);

    if (me == sender)
        return {'me': users[senderIndex], 'guest': users[recipientIndex]};
    if (me == recipient)
        return {'me': users[recipientIndex], 'guest': users[senderIndex]};
}

/**
 * Główny filtr użytkownika
 *
 * @param user
 * @param filters
 * @returns {boolean}
 */
function filter (user, filters)
{
    // inicjujemy wszystkie filtry na spełnione
    var nick = true;
    var region = true;
    var interests = true;
    var age_min = user.age >= filters.age_min;
    var age_max = user.age <= filters.age_max;
    var female = true;
    var male = true;
    var photo = true;
    var about = true;

    // jeżeli wpisany nick to wyszukaj
    if (filters.nick != '')
        nick = user.nick.toLowerCase().includes(filters.nick.toLowerCase());

    // jeżeli wybrane regiony to sprawdź czy user w nich jest
    if ($.isArray(filters.region) && filters.region.length)
        region = _.indexOf(filters.region, user.region) != -1;

    // jeżeli wybrane cele to przeleć po celach usera i sprawdź czy któryś ma
    if ($.isArray(filters.interests) && filters.interests.length)
    {
        if ($.isArray(user.interests) && user.interests.length)
        {
            interests = false;
            $.each(user.interests, function (index, value) {
                var inarray = _.indexOf(filters.interests, value) != -1;
                if (inarray)
                    interests = true;
            });
        }
        // chyba że nie ma żadnych wybranych
        else
        {
            interests = false;
        }
    }

    // jeżeli domyślny wiek, to pokaż użytkowników bez określonego wieku
    if (filters.age_min == 14 && filters.age_max == 70)
    {
        age_min = true;
        age_max = true;
    }

    // jeżeli mężczyzna
    if (filters.male)
        male = user.gender == 0;
    else
        male = user.gender == 1;

    // jeżeli kobieta
    if (filters.female)
        female = user.gender == 1;
    else
        female = user.gender == 0;

    // jeżeli wybrany mężczyzna i kobieta to pokaż wszystkich
    if (filters.male && filters.female)
    {
        female = true;
        male = true;
    }

    // jeżeli ma zdjęcie
    if (filters.photo)
        photo = user.photo != '';

    //jeżeli ma opis
    if (filters.about)
        about = user.about != '';

    // zsumuj boole i zwróć końcowy wynik dla tego użytkownika, czy spełnia wszystkie warunki
    return (nick && region && interests && age_min && age_max && female && male && photo && about);
}

/**
 * jQuery UI slider - do kontrolki suwaka
 */
$(function()
{
    /**
     * Suwak w filtrach
     */
    $(".age-range").slider({
        range: true,
        min: 14,
        max: 70,
        values: [14, 70],
        slide: function(event, ui) {
            $(".age-min").text(ui.values[0]);
            $(".age-max").text(ui.values[1]);

            Vue.set(filtersApp, 'age_min', ui.values[0]);
            Vue.set(filtersApp, 'age_max', ui.values[1]);
            filtersApp.setFilters();
        }
    });

    /**
     * Suwak w profilu
     */
    var age;
    if ($(".age-input").val() > 0)
        age = $(".age-input").val();
    else
        age = null;

    $(".age-profile").slider({
        min: 14,
        max: 70,
        value: age,
        create: function() {
            if (age)
            {
                $(".age-handle").html(age+' <i class="fa fa-times"></i>');
                $(".age-profile .fa").click(function() {
                    $(".age-handle").text('Wiek');
                    $(".age-input").val('');
                    profileApp.change();
                });
            }
            else
            {
                $(".age-handle").text('Wiek');
                $(".age-input").val('');
            }
        },
        slide: function(event, ui) {
            $(".age-handle").html(ui.value+' <i class="fa fa-times"></i>');
            $(".age-input").val(ui.value);
            profileApp.change();

            $(".age-profile .fa").click(function() {
                $(".age-handle").text('Wiek');
                $(".age-input").val('');
                profileApp.change();
            });
        }
    });
});

/**
 * Snippet do checkboxów ukrytych w buttonach
 */
$(function()
{
    $('.button-checkbox').each(function () {
        var $widget = $(this),
            $button = $widget.find('button'),
            $checkbox = $widget.find('input:checkbox'),
            settings = {
                on: {
                    icon: 'fa fa-check-square-o fa-fw'
                },
                off: {
                    icon: 'fa fa-square-o fa-fw'
                }
            };
        $button.on('click', function () {
            $checkbox.prop('checked', !$checkbox.is(':checked'));
            $checkbox.triggerHandler('change');
            updateDisplay();
        });
        $checkbox.on('change', function () {
            updateDisplay();
        });

        function updateDisplay() {
            var isChecked = $checkbox.is(':checked');

            $button.data('state', (isChecked) ? "on" : "off");
            $button.find('.state-icon')
                .removeClass()
                .addClass('state-icon ' + settings[$button.data('state')].icon);
        }

        function init() {

            updateDisplay();

            if ($button.find('.state-icon').length == 0) {
                $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
            }
        }
        init();
    });
});

/**
 * Ukrycie po czasie aleru pokazanego przez Vue
 */
function showingAlert(hideAdditionalElements)
{
    window.setTimeout(function()
    {
        $('.alert').fadeTo(500, 0).slideUp(500);

        if (hideAdditionalElements)
            $('.delAfterAlert').fadeTo(500, 0).slideUp(500)

    }, 3000);
}