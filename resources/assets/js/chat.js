/**
 * Komponent boksa użytkownika
 */
Vue.component('user', require('./components/user.vue'));

/**
 * Komponent okna rozmowy
 */
Vue.component('talk', require('./components/talk.vue'));

/**
 * Główna aplikacja Czatu
 */
new Vue({
    el: '#chat',
    data: {
        user_id: null,
        users: [],
        talks: {}
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
};

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
};

/**
 * Isotope - plugin do płynnych gridów
 */
$('.grid').isotope({
    itemSelector: '.user',
    layoutMode: 'fitRows'
});

/**
 * Snippet do dropdownów filtrujacych
 */
$(function() {
    $('.dropdown-menu').click(function(e) {
        e.stopPropagation();
        setLabel();
    });

    function setLabel() {
        $('.dropdown-menu').each(function() {

            var chosen = $(this).find(':checked').length;

            if ($(this).hasClass('region'))
            {
                var labelChosen = 'Województwa: ';
                var labelEmpty = ' - województwo -';
            }

            if ($(this).hasClass('interest'))
            {
                var labelChosen = 'Cele: ';
                var labelEmpty = ' - poszukujący -';
            }

            if (chosen)
                $(this).prev('button').find('.chosen').text(labelChosen+chosen);
            else
                $(this).prev('button').find('.chosen').text(labelEmpty);
        });
    }

    setLabel();
});

/**
 * jQuery UI slider - do kontrolki suwaka
 */
$(function() {
    $(".age-range").slider({
        range: true,
        min: 14,
        max: 80,
        values: [14, 80],
        slide: function(event, ui) {
            $(".age-min").text(ui.values[0]);
            $(".age-max").text(ui.values[1]);
        }
    });
});

/**
 * Snippet do checkboxów ukrytych w buttonach
 */
$(function () {
    $('.button-checkbox').each(function () {

        // Settings
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

        // Event Handlers
        $button.on('click', function () {
            $checkbox.prop('checked', !$checkbox.is(':checked'));
            $checkbox.triggerHandler('change');
            updateDisplay();
        });
        $checkbox.on('change', function () {
            updateDisplay();
        });

        // Actions
        function updateDisplay() {
            var isChecked = $checkbox.is(':checked');

            // Set the button's state
            $button.data('state', (isChecked) ? "on" : "off");

            // Set the button's icon
            $button.find('.state-icon')
                .removeClass()
                .addClass('state-icon ' + settings[$button.data('state')].icon);
        }

        // Initialization
        function init() {

            updateDisplay();

            // Inject the icon if applicable
            if ($button.find('.state-icon').length == 0) {
                $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
            }
        }
        init();
    });

    $('.button-radio').each(function () {

        // Settings
        var $widget = $(this),
            $button = $widget.find('button'),
            $radio = $widget.find('input:radio'),
            settings = {
                on: {
                    icon: 'fa fa-check-circle-o fa-fw'
                },
                off: {
                    icon: 'fa fa-circle-o fa-fw'
                }
            };

        // Event Handlers
        $button.on('click', function () {
            $radio.prop('checked', !$radio.is(':checked'));
            $radio.triggerHandler('change');
            updateDisplay();
        });
        $radio.on('change', function () {
            updateDisplay();
        });

        // Actions
        function updateDisplay() {
            var isChecked = $radio.is(':checked');
            
            // Set the button's state
            $button.data('state', (isChecked) ? "on" : "off");

            // Set the button's icon
            $button.find('.state-icon')
                .removeClass()
                .addClass('state-icon ' + settings[$button.data('state')].icon);
        }

        // Initialization
        function init() {

            updateDisplay();

            // Inject the icon if applicable
            if ($button.find('.state-icon').length == 0) {
                $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
            }
        }
        init();
    });
});