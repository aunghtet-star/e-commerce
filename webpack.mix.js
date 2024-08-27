const mix=require('laravel-mix');


mix.js('resources/js/test.js', 'public/js').react();
mix.js('resources/js/home.js', 'public/js').react();
mix.js("resources/js/productDetail.js", "public/js").react();
mix.js("resources/js/profile.js", "public/js").react();

