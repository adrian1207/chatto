<template>
    <div class="user-panel">
        <i v-if="user.gender" class="fa fa-female gender" aria-hidden="true"></i>
        <i v-else class="fa fa-male gender" aria-hidden="true"></i>
        <div class="photo" v-if="user.photo">
            <img :src="'photos/thumbs/'+user.photo" :alt="'Zdjęcie użytkownika '+user.nick" />
        </div>
        <h3 class="nick">
            <strong>{{ user.nick }}</strong> <span v-if="user.age">({{ user.age }})</span>
        </h3>
        <div class="region" v-if="user.region">
            <i class="fa fa-map-marker fa-fw"></i> <span>{{ user.region }}</span>
        </div>
        <div class="interests" v-if="user.interests">
            <span v-for="(interest, index) in user.interests">{{ interest }}</span>
        </div>
        <div class="about" v-if="user.about">
            {{ user.about }}
        </div>
        <div v-if="self != user.id && !connected">
            <hr />
            <button class="invite btn btn-default btn-block" v-on:click="invite($event)">{{ buttonText }}</button>
        </div>

        <div v-if="self != user.id && connected">
            <hr />
            <button class="btn btn-default btn-block" disabled>Rozmowa połączona</button>
        </div>

        <div v-if="self == user.id">
            <hr />
            <button class="btn btn-default btn-block" disabled>Ty</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user', 'self', 'connected'],
        data: function() {
            return {
                buttonText: 'Rozmawiaj'
            }
        },
        methods: {
            invite: function (event) {
                $(event.target).attr('disabled', true);
                this.buttonText = 'Łączenie...';
                this.$emit('invite')
            }
        },
        watch: {
            connected: function ()
            {
                this.buttonText = 'Rozmawiaj';
            }
        }
    }
</script>
