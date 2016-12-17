<template>
    <div class="panel panel-primary">
        <div class="panel-heading">{{ user.nick }} ({{ user.age }})</div>
        <div class="panel-body">
            <div>{{ user.photo }}</div>
            <div>Region: {{ user.region }}</div>
            <div>Cele: {{ user.interests }}</div>
            <div>{{ user.about }}</div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user']
    }
</script>
