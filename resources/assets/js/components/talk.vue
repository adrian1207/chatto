<template>
    <div class="modal" tabindex="-1" role="dialog" :id="channel" aria-labelledby="xxx">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                {{ channel }}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['channel'],
        mounted() {
            $('#'+this.channel).modal();
        }
    }
</script>
