const { src, dest, watch, series, parallel } = require('gulp');

// Importing all the Gulp-related packages we want to use
const sourcemaps      = require('gulp-sourcemaps');
const sass            = require('gulp-sass');
const concat          = require('gulp-concat');
const postcss         = require('gulp-postcss');
const autoprefixer    = require('autoprefixer');
const cssnano         = require('cssnano');
const plumber         = require('gulp-plumber'); 
const notify          = require("gulp-notify");
const minify          = require('gulp-minify');

// File paths
const files = { 
    scssPath: 'scss/**/*.scss',
    jsPath: 'js/files/*.js'
}


var onError = function(err) {
  notify.onError({
    title:    "Gulp Error",
    message:  "Error: <%= error.message %>",
    sound:    "Purr",
  })(err);
  this.emit('end');
};


// Sass task: compiles the style.scss file into style.css
function scssTask(){    
    return src(files.scssPath)
        .pipe(plumber({errorHandler: onError}))
        .pipe(sourcemaps.init()) // initialize sourcemaps first
        .pipe(sass()) // compile SCSS to CSS
        .pipe(postcss([ autoprefixer(), cssnano() ])) // PostCSS plugins
        .pipe(sourcemaps.write('.')) // write sourcemaps file in current directory
        .pipe(dest('css') // put final CSS in dist folder
    ); 
}

// JS task: concatenates and uglifies JS files to script.js
function jsTask(){
    return src([
        files.jsPath
        //,'!' + 'includes/js/jquery.min.js', // to exclude any specific files
        ])
        .pipe(plumber({errorHandler: onError}))
        .pipe(concat('all.js'))
        .pipe(minify({noSource: true}))
        .pipe(dest('js')
    );
}

function watchTask(){
    watch([files.scssPath, files.jsPath],
        series(
            parallel(scssTask, jsTask),
        )
    );    
}

exports.default = series(
    parallel(scssTask, jsTask), 
    watchTask
);