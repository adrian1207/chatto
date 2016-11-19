Vue.component('user', require('./components/user.vue'));
Vue.component('talk', require('./components/talk.vue'));

new Vue({
    el: '#chat',
    data: {
        user_id: null,
        users: [],
        talks: []
    },
    methods: {
        connect: function() {
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
                    this.start_private(participants)
                });
        },
        invite: function(sender, recipient) {
            $.post('/chat/invite', {sender: sender, recipient: recipient});
        },
        start_private: function(participants) {
            var channel = participants.sender+'-'+participants.recipient;

            if (participants.sender == this.user_id || participants.recipient == this.user_id)
            {
                this.talks.push(channel);

                Echo.private(channel)
                    .listen('MessageEvent', (data) => {
                        console.log(data);
                    });
            }
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