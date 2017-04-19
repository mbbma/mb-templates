// Include gulp
var gulp = require('gulp');

// Include Our Plugins
var sass = require('gulp-sass');
var autoprefix = require('gulp-autoprefixer');
var minify = require('gulp-clean-css');
 
// Compile Our Sass
gulp.task('sass', function() {
    return gulp.src('scss/*.scss')
        .pipe(sass())
        .pipe(autoprefix({
            browsers: ['last 2 ie versions'],
            cascade: false
        })) 
        .pipe(minify())
        .pipe(gulp.dest('css'));
});

/* Watch scss, js and html files, doing different things with each. */
gulp.task('default', ['sass'], function () {
    /* Watch scss, run the sass task on change. */
    gulp.watch('scss/**/*.scss', ['sass'])
});