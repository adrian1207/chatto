const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

elixir(mix => {
    mix.sass('app.scss')
        .webpack('app.js')
        .webpack('chat.js')
        .webpack('login.js')
        .styles([
            '../bower/jquery-ui/themes/base/jquery-ui.min.css',
            '../bower/font-awesome/css/font-awesome.min.css',
            '../bower/bootstrap-select/dist/css/bootstrap-select.min.css',
            '../bower/jasny-bootstrap/dist/css/jasny-bootstrap.min.css'
        ])
        .scripts([
            '../bower/jquery-ui/ui/widgets/dialog.js',
            '../bower/jquery-ui/ui/widgets/slider.js',
            '../bower/jquery-ui/ui/effect.js',
            '../bower/jquery-ui/ui/effects/effect-highlight.js',
            '../bower/dialogextend/dialogextend.min.js',
            '../bower/bootstrap-filestyle/src/bootstrap-filestyle.min.js',
            '../bower/bootstrap-select/dist/js/bootstrap-select.min.js',
            '../bower/jasny-bootstrap/dist/js/jasny-bootstrap.min.js',
            '../bower/jquery-validation/dist/jquery.validate.min.js',
            '../bower/jquery-validation/dist/additional-methods.min.js',
            '../bower/jquery-validation-unobtrusive/jquery.validate.unobtrusive.min.js',
            '../bower/jqueryui-touch-punch/jquery.ui.touch-punch.min.js'
        ])
        .copy('resources/assets/bower/jquery-ui/themes/base/images', 'public/css/images')
        .copy('resources/assets/images', 'public/images')
        .copy('node_modules/bootstrap-sass/assets/fonts/bootstrap/', 'public/fonts/bootstrap')
        .copy('resources/assets/bower/font-awesome/fonts', 'public/fonts');
});
