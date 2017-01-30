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
                        <input v-model="message" type="text" name="message" class="form-control" placeholder="Wiadomość..." :disabled="!members.partnerOnline" required autocomplete="off">
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
        props: ['channel', 'messages', 'members'],
        data: function() {
            return {
                message: '',
                title: this.members.guest.nick,
                minimized: false
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
                $('#'+this.channel+' .messagebox').stop().animate({
                  scrollTop: $('#'+this.channel+' .messagebox')[0].scrollHeight
                }, 800);
            }
        },
        mounted: function()
        {
            var $vue = this;

            $('#'+$vue.channel)
                .dialog({
                    "height": 500,
                    "width": 500,
                    "close": function(event, ui)
                    {
                        $vue.$parent.privateExit($vue.channel);
                    }
                })
                .dialogExtend({
                    "closable": true,
                    "maximizable": true,
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
              });

              // Godzina wyświetlana co 5min w oknie rozmowy
              setInterval(function() {
                var date = new Date();
                var dateFormatted =  "Godzina: "+date.getHours()+":"+date.getFullMinutes();
                if (typeof $vue.$parent.talks[$vue.channel] !== "undefined")
                {
                    $vue.$parent.talks[$vue.channel].messages.push({content: dateFormatted, type: 'info'})
                }
              }, 300000);

              // Minuty
              Date.prototype.getFullMinutes = function () {
                   if (this.getMinutes() < 10) {
                       return '0' + this.getMinutes();
                   }
                   return this.getMinutes();
                };
        }
    }
</script>
