<template>
    <div :id="channel" :title="members.guest.nick">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12" style="height: 390px; overflow-y: scroll;">
                    <p v-for="message in messages">{{ message.type }}: {{ message.content }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form v-on:submit.prevent='send'>
                        <div class="input-group">
                            <input v-model="message" type="text" name="message" class="form-control" placeholder="Wiadomość...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit"></button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['channel', 'messages', 'members'],
        data: function() {
            return {message: ''}
        },
        methods: {
            send: function()
            {
                var message = this.message;
                this.$http.post('/chat/message', {channel: this.channel, message: message});
                this.$parent.talks[this.channel].messages.push({content: message, type: 'sent'});
                this.message = '';
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
                    "closable" : true,
                    "maximizable" : true,
                    "minimizable" : true,
                    "collapsable" : false,
                    "dblclick" : "minimize",
                    "titlebar" : false,
                    "minimizeLocation" : "left",
                    "icons" : {
                      "close" : "ui-icon-circle-close",
                      "maximize" : "ui-icon-circle-plus",
                      "minimize" : "ui-icon-circle-minus",
                      "restore" : "ui-icon-bullet"
                    }
              });
        }
    }
</script>
