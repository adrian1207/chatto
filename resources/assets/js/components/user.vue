<template>
    <div class="col-lg-2 pull-left" style="padding: 8px;">
        <div class="panel panel-primary">
            <div class="panel-heading">{{ user.nick }}</div>
            <div class="panel-body">{{ user.id }}</div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user']
    }
</script>
