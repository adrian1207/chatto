Vue.component('user', require('./components/user.vue'));
Vue.component('talk', require('./components/talk.vue'));

new Vue({
    el: '#chat',
    data: {
        user_id: null,
        users: [],
        talks: {}
    },
    methods: {
        connect: function()
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
                    this.privateInit(participants)
                });
        },
        invite: function(sender, recipient)
        {
            this.$http.post('/chat/invite', {sender: sender, recipient: recipient});
        },
        privateInit: function(participants)
        {
            var channel = 'priv-'+participants.sender+'-'+participants.recipient;

            if ((participants.sender == this.user_id || participants.recipient == this.user_id) && !this.talks[channel])
            {
                this.$set(this.talks, channel, {messages: []});

                Echo.join(channel)
                    .joining((user) => {
                        console.log(user);
                    })
                    .leaving((user) => {
                        console.log(user);
                    })
                    .listen('MessageEvent', (message) => {
                        this.talks[channel].messages.push(message);
                    });
            }
        },
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

        this.user_id = $('meta[name="user-id"]').attr('content');

        this.connect();
    }
});