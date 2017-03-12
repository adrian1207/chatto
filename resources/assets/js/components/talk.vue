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
    var blinkIntervalId = {};

    export default {
        props: ['channel', 'messages', 'members', 'connected'],
        data: function() {
            return {
                message: '',
                title: this.members.guest.nick,
                minimized: false,
                closable: false
            }
        },
        methods: {
            send: function()
            {
                if (this.message == '')
                    return false;

                var message = this.message;
                this.$http.post('/chat/message', {channel: this.channel, message: message});
                this.$parent.talks[this.channel].messages.push({content: message, type: 'sent'});
                this.message = '';
            }
        },
        watch: {
            messages: function (msgs)
            {
                this.closable = true;

                $('#'+this.channel+' .messagebox').stop().animate({
                  scrollTop: $('#'+this.channel+' .messagebox')[0].scrollHeight
                }, 800);

                if (this.minimized)
                {
                    var $vue = this;

                    $('#dialog-extend-fixed-container .ui-dialog[aria-describedby="'+$vue.channel+'"] .ui-dialog-titlebar').effect("highlight", {}, 3000);
                    blinkIntervalId[$vue.channel] = setInterval(function() {
                        $('#dialog-extend-fixed-container .ui-dialog[aria-describedby="'+$vue.channel+'"] .ui-dialog-titlebar').effect("highlight", {}, 3000);
                    }, 3200);
                }
            }
        },
        mounted: function()
        {
            var $vue = this;

            var width = 500;
            var height = 500;
            var maximizable = true;

            if (window.innerWidth < 768)
            {
                width = window.innerWidth;
                height = window.innerHeight;
                maximizable = false;
            }

            $('#'+$vue.channel)
                .dialog({
                    "height": height,
                    "width": width,
                    "beforeClose": function(event, ui)
                    {
                        if (!$vue.closable)
                            return false;
                    },
                    "close": function(event, ui)
                    {
                        clearInterval(hourIntervalId);
                        $vue.$parent.privateExit($vue.channel, $vue.members.guest.id);
                    }
                })
                .dialogExtend({
                    "closable": true,
                    "maximizable": maximizable,
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
                    "beforeMinimize":  function (event) {
                        $vue.minimized = true;
                    },
                    "beforeRestore":  function (event) {
                        $vue.minimized = false;
                        clearInterval(blinkIntervalId[$vue.channel]);
                    },
                    "load": function(event, ui)
                    {
                        $('.ui-dialog-titlebar-minimize span').text('');
                        $('.ui-dialog-titlebar-maximize span').text('');
                        $('.ui-dialog-titlebar-restore span').text('');
                        $('.ui-dialog-titlebar-minimize').attr('title', 'Minimalizuj');
                        $('.ui-dialog-titlebar-maximize').attr('title', 'Maksymalizuj');
                        $('.ui-dialog-titlebar-restore span').attr('title', 'Przywróć');
                        $('.ui-dialog-titlebar-close').attr('title', 'Zamknij');
                    },
              }).prev(".ui-dialog-titlebar").css("background-color","#2780e3");

              // Godzina wyświetlana co 5min w oknie rozmowy
              var hourIntervalId = setInterval(function()
              {
                var date = new Date();
                var dateFormatted =  "Godzina: "+date.getHours()+":"+date.getFullMinutes();

                if (typeof $vue.$parent.talks[$vue.channel] !== "undefined" && !$vue.minimized)
                {
                    $vue.$parent.talks[$vue.channel].messages.push({content: dateFormatted, type: 'info'})
                }
              }, 300000);
        }
    }
</script>
