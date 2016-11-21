<template>
    <div :id="channel" :title="channel">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    test
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group">
                        <input type="text" name="message" class="form-control" placeholder="Wiadomość...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button"></button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['channel'],
        mounted() {
            $('#'+this.channel)
                .dialog({
                    "height": 550,
                    "width": 500
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
