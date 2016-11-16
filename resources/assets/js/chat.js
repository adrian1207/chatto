new Vue({
    el: '#chat',
    data: {
        users: []
    },
    methods: {
        connect: function() {
            Echo.join('presence_channel')
                .here((users) => {
                this.users = users;
        })
            .joining((user) => {
                this.users.push(user);
        })
            .leaving((user) => {
                var index = this.users.map(function(usr) { return usr.id; }).indexOf(user.id);
            this.users.splice(index, 1);
        });
        }
    },
    mounted: function()
    {
        this.connect();
    }
});