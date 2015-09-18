var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    var bootstrapPath = 'node_modules/bootstrap-sass/assets';
    var jqueryPath = 'bower_components/jquery';
    var d3Path = 'bower_components/d3';
    var c3Path = 'bower_components/c3';
    mix.sass('app.scss')
        .copy(bootstrapPath + '/fonts', 'public/fonts')
        .copy(bootstrapPath + '/javascripts/bootstrap.min.js', 'public/js')
        .copy(jqueryPath + '/dist/jquery.min.js', 'public/js')
        .copy(d3Path + '/d3.min.js', 'public/js')
        .copy(c3Path + '/c3.min.js', 'public/js')
        .copy(c3Path + '/c3.min.css', 'public/css');
});
