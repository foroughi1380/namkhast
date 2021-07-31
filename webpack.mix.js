const dir_route = "routes";
const mix = require('laravel-mix');
const path = require('path');
const { execSync } = require('child_process');
const fs = require("fs");

mix.alias({
    ziggy: path.resolve('vendor/tightenco/ziggy/dist/vue'), // or 'vendor/tightenco/ziggy/dist/vue' if you're using the Vue plugin
});

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.js('resources/js/app.js', 'public/js')
    .vue()
    .before(Mix => { // for normal building
        execSync("php artisan route:cache");
        execSync("php artisan ziggy:generate");
        fs.readdir("routes" , (err  , files)=>{
            if (err) console.log("error in listern to routes.");
            for (let file of files) {
                console.log("watch to file " + file);
                fs.watch("routes/" + file , (curr , prev) =>{
                    console.log(file + " changed.");
                    execSync("php artisan route:cache");
                    execSync("php artisan ziggy:generate");
                })
            }
        });
    })
    .after(Mix => { // for watch bilding
        /*exec("php artisan route:cache");
        exec("php artisan ziggy:generate");*/
    })
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);
