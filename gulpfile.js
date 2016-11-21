const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

elixir(mix => {
    mix.sass('app.scss')
        .webpack('app.js')
        .webpack('chat.js')
        .styles([
            '../bower/jquery-ui/themes/base/jquery-ui.min.css'
        ])
        .scripts([
            '../bower/jquery-ui/ui/widgets/dialog.js',
            '../bower/dialogextend/dialogextend.min.js'
        ])
        .copy('resources/assets/bower/jquery-ui/themes/base/images', 'public/css/images');
});
