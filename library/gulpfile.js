var gulp        = require('gulp'),
    sass        = require('gulp-sass'),
    cssmin      = require('gulp-cssnano'), // Minify CSS
    prefix      = require('gulp-autoprefixer'),
    plumber     = require('gulp-plumber'), // This 🐒-patch plugin is fixing issue with Node Streams piping
    notify      = require('gulp-notify'), // notification plugin for gulp
    sassLint    = require('gulp-sass-lint'),
    sourcemaps  = require('gulp-sourcemaps') // 2.X now supports node 0.10+ due to switching out a dependency
    runSequence = require('run-sequence'), // Runs a sequence of gulp tasks in the specified order.
    uglify     = require('uglify-js'),
    minify = require('gulp-minify'),
   concat = require('gulp-concat');

var displayError = function(error) {

  var errorString = '[' + error.plugin.error.bold + ']';
  errorString += ' ' + error.message.replace("\n",''); // Removes new line at the end

  if(error.fileName)
      errorString += ' in ' + error.fileName;

  if(error.lineNumber)
      errorString += ' on line ' + error.lineNumber.bold;

  // This will output an error like the following:
  // [gulp-sass] error message in file_name on line 1
  console.error(errorString);
};

var onError = function(err) {
  notify.onError({
    title:    "Gulp",
    subtitle: "MB!",
    message:  "Error: <%= error.message %>",
    sound:    "gulps"
  })(err);
  this.emit('end');
};

var sassOptions = {
  outputStyle: 'expanded'
};

var prefixerOptions = {
  Browserslist: ['last 2 versions']
};
gulp.task('styles', function() {
  return gulp.src('scss/*.scss')
    .pipe(plumber({errorHandler: onError}))
    .pipe(sourcemaps.init())
    .pipe(sass(sassOptions))
    .pipe(prefix(prefixerOptions))
    .pipe(gulp.dest('css'))
    .pipe(cssmin({zindex: false}))
    .pipe(gulp.dest('css'))
});

gulp.task('sass-lint', function() {
  gulp.src('scss/**/*.scss')
    .pipe(sassLint())
    .pipe(sassLint.format())
    .pipe(sassLint.failOnError());
});

gulp.task('compress', function() {
  gulp.src(['js/files/*.js'])
    .pipe(concat('all.js'))
    .pipe(minify({noSource: true}))
    .pipe(gulp.dest('js'));
});

gulp.task('watch', function() {
    gulp.watch('scss/**/*.scss', ['styles']);
    gulp.watch("js/files/*.js", ['compress']);
});


gulp.task('default', function(done) {
  runSequence('styles', 'watch','compress', done);
});

gulp.task('build', function(done) {
  runSequence('styles', done);
});

