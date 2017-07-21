<template>
    <div :id="channel" :title="title" style="position: relative">
        <div class="flexbox">
            <div class="flexrow content messagebox">
                <div v-for="message in messages">
                    <span class="message-received-photo" v-if="message.type == 'received'">
                        <img v-if="members.guest.photo" :src="'photos/mini/'+members.guest.photo" :alt="'Zdjęcie '+members.guest.nick" />
                        <img v-if="!members.guest.photo && members.guest.gender == 0" src="images/avatar_male_mini.png" :alt="'Zdjęcie '+members.guest.nick" />
                        <img v-if="!members.guest.photo && members.guest.gender == 1" src="images/avatar_female_mini.png" :alt="'Zdjęcie '+members.guest.nick" />
                    </span>

                    <span class="message-sent-photo" v-if="message.type == 'sent'">
                        <img v-if="members.me.photo" :src="'photos/mini/'+members.me.photo" :alt="'Zdjęcie '+members.me.nick" />
                        <img v-if="!members.me.photo && members.me.gender == 0" src="images/avatar_male_mini.png" :alt="'Zdjęcie '+members.me.nick" />
                        <img v-if="!members.me.photo && members.me.gender == 1" src="images/avatar_female_mini.png" :alt="'Zdjęcie '+members.me.nick" />
                    </span>

                    <span :class="'message-'+message.type">{{ message.content }}</span>
                </div>
            </div>
            <div class="flexrow footer">
                <form v-on:submit.prevent='send'>
                    <div class="input-group">
                        <input v-model="message" type="text" name="message" maxlength="1000" class="form-control" :disabled="!connected" placeholder="Wiadomość..." required autocomplete="off">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="sumbit"><i class="fa fa-send"></i></button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['channel', 'messages', 'members', 'connected'],
        data: function() {
            return {
                message: '',
                title: this.members.guest.nick,
                closable: false,
                hourIntervals: {},
                blinkIntervals: {}
            }
        },
        methods: {

            /**
             * Wysłanie wiadomości
             */
            send: function()
            {
                if (this.message == '')
                    return false;

                var message = this.message;
                this.$http.post('/chat/message', {channel: this.channel, message: message});
                this.$parent.talks[this.channel].messages.push({content: message, type: 'sent'});
                this.message = '';
            },

            /**
             * Kliknięcie na oknie rozmowy
             *
             * @param jqueryTalk
             */
            activate: function(jqueryTalk)
            {
                clearInterval(this.blinkIntervals[this.channel]);
                this.blinkIntervals[this.channel] = false;

                jqueryTalk.find('input').focus();
            },

            /**
             * Załadowanie okna - przetłumaczenie labeli przycisków rozmowy
             */
            load: function()
            {
                $('.ui-dialog-titlebar-minimize span').text('');
                $('.ui-dialog-titlebar-maximize span').text('');
                $('.ui-dialog-titlebar-restore span').text('');
                $('.ui-dialog-titlebar-minimize').attr('title', 'Minimalizuj');
                $('.ui-dialog-titlebar-maximize').attr('title', 'Maksymalizuj');
                $('.ui-dialog-titlebar-restore span').attr('title', 'Przywróć');
                $('.ui-dialog-titlebar-close').attr('title', 'Zamknij');
            },

            /**
             * Event przywrócenia okna
             */
            restore: function()
            {
                this.scroll();
            },

            /**
             * Event przed zamknięciem okna
             */
            beforeClose: function()
            {
                if (!this.closable)
                    return false;
            },

            /**
             * Event zamknięcia okna
             */
            close: function()
            {
                clearInterval(this.hourIntervals[this.channel]);
                this.$parent.privateExit(this.channel, this.members.guest.id);
            },

            /**
             * Zescrollowanie okna rozmowy do samego dołu
             */
            scroll: function()
            {
                $('#'+this.channel+' .messagebox').animate(
                {
                    scrollTop: $('#'+this.channel+' .messagebox')[0].scrollHeight
                }, 800);
            },

            /**
             * Miganie tytułu po odebraniu wiadomości
             */
            blinkTitle: function()
            {
                var verb = (this.members.guest.gender) ? 'napisała' : 'napisał';

                newMessageTitleAlert(this.members.guest.nick+' '+verb+'!');
            },

            /**
             * Miganie zminimalizowanego okna na belce
             *
             * @param msgs
             */
            blinkTalkBar: function()
            {
                var $vue = this;

                if (!$('.ui-dialog[aria-describedby="'+this.channel+'"] input').is(':focus') && !this.blinkIntervals[this.channel])
                {
                    this.blinkEffect();
                    this.blinkIntervals[this.channel] = setInterval(function() { $vue.blinkEffect() }, 3000);
                }
            },

            /**
             * Godzina wyświetlana co 5min w oknie rozmowy
             */
            hourDisplay: function()
            {
                var date = new Date();
                var dateFormatted =  "Godzina: "+date.getHours()+":"+date.getFullMinutes();

                if (typeof this.$parent.talks[this.channel] !== "undefined")
                {
                    this.$parent.talks[this.channel].messages.push({content: dateFormatted, type: 'info'});
                }
            },

            /**
             * Efekt migania paska rozmowy
             */
            blinkEffect: function()
            {
                $('.ui-dialog[aria-describedby="'+this.channel+'"] .ui-dialog-titlebar').effect("highlight", {}, 3000);
            }
        },
        watch:
        {
            /**
             * Obserwacja listy wiadomości
             */
            messages: function (msgs)
            {
                this.closable = true;
                this.scroll();

                if (_.last(msgs).type == 'received')
                {
                    this.blinkTitle();
                    this.blinkTalkBar();
                }
            }
        },
        mounted: function()
        {
            var $vue = this;
            var mobile = false;
            var width = 500;
            var height = 500;
            var position = {my: "center", at: "center", of: window};

            // Pełny ekran na mobilnych
            if (window.innerWidth < 993)
            {
                mobile = true;
                width = window.innerWidth;
                height = window.innerHeight;
                position = [0, 0];
            }

            $('#'+$vue.channel)
                .dialog({
                    "position": position,
                    "height": height,
                    "width": width,
                    "resizable": !mobile,
                    "draggable": !mobile,
                    "open": function()
                    {
                        $(this).parent().css('z-index', 1030);

                        if (!mobile)
                        {
                            var dialogs = $('.ui-dialog:visible').length - 1;
                            $(this).parent().css('left', $(this).offset().left + (dialogs * 40)+'px');
                            $(this).parent().css('top', $(this).offset().top + (dialogs * 40)+'px');
                        }
                        else
                        {
                            var dialog = $(this);

                            $(window).resize(function()
                            {
                                dialog.dialog("option", "height", document.documentElement.clientHeight);
                                dialog.dialog("option", "width", document.documentElement.clientWidth);

                                setTimeout(function(){
                                    window.scrollTo(0, 0);
                                }, 300);
                            });
                        }
                    },
                    "beforeClose": function() { return $vue.beforeClose() },
                    "close": function() { $vue.close() }
                })
                .dialogExtend({
                    "closable": true,
                    "maximizable": !mobile,
                    "minimizable": true,
                    "collapsable": false,
                    "dblclick": "minimize",
                    "titlebar": false,
                    "minimizeLocation": "left",
                    "icons": {
                      "close": "fa fa-window-close fa-fw",
                      "maximize": "fa fa-window-maximize fa-fw",
                      "minimize": "fa fa-window-minimize fa-fw",
                      "restore": "fa fa-window-restore fa-fw"
                    },
                    "restore": function() { $vue.restore() },
                    "load": function() { $vue.load() },
                }).prev(".ui-dialog-titlebar").css("background-color","#2780e3");


            // Godzina wyświetlana co 5min w oknie rozmowy
            this.hourIntervals[this.channel] = setInterval(function() { $vue.hourDisplay() }, 300000);

            // Aktywacja okna po kliknięciu
            $('.ui-dialog[aria-describedby="'+this.channel+'"]').not('.ui-dialog-titlebar-buttonpane').click(function(){ $vue.activate($(this)) });

            // Pierwsza wiadomość - powiadomienie osoby zaproszonej
            if (this.messages[0] && this.messages[0].type == 'received')
            {
                this.closable = true;
                this.blinkTitle();
                this.blinkTalkBar();
            }
        }
    }
</script>
