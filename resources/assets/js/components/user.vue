<template>
    <div class="panel panel-primary">
        <div class="panel-heading">{{ user.nick }} <span v-if="user.age">({{ user.age }})</span></div>
        <div class="panel-body">
            <div>{{ user.photo }}</div>
            <div>{{ user.region }}</div>
            <span v-for="(text, index) in user.interests">#{{ text }} </span>
            <p>{{ user.about }}</p>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user']
    }
</script>
