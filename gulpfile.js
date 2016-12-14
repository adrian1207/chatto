const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

elixir(mix => {
    mix.sass('app.scss')
        .webpack('app.js')
        .webpack('chat.js')
        .webpack('login.js')
        .styles([
            '../bower/jquery-ui/themes/base/jquery-ui.min.css',
            '../bower/font-awesome/css/font-awesome.min.css'
        ])
        .scripts([
            '../bower/jquery-ui/ui/widgets/dialog.js',
            '../bower/jquery-ui/ui/widgets/slider.js',
            '../bower/dialogextend/dialogextend.min.js',
            '../bower/isotope/dist/isotope.pkgd.min.js',
            '../bower/bootstrap-filestyle/src/bootstrap-filestyle.min.js'
        ])
        .copy('resources/assets/bower/jquery-ui/themes/base/images', 'public/css/images')
        .copy('resources/assets/images', 'public/images')
        .copy('node_modules/bootstrap-sass/assets/fonts/bootstrap/', 'public/fonts/bootstrap')
        .copy('resources/assets/bower/font-awesome/fonts', 'public/fonts');
});
