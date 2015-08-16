/**
 * Default gulpfile.js
 * 
 * Tasks: scss, scripts, watch, default
 */
var gulp = require('gulp'),
    plumber = require('gulp-plumber'),
    watch = require('gulp-watch'),
    minifycss = require('gulp-minify-css'),
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename'),
    include = require('gulp-include'),
    sass = require('gulp-sass'),
    concat = require('gulp-concat'),
    notify = require('gulp-notify');

// Path to the root folder where everything should be saved
var root = './assets/';

// Error handling
// Used for scss task
var onError = function(err) {
    console.log('An error occured:', err.message);
    this.emit('end');
}

// SCSS
gulp.task('scss', function () {
    gulp.src(root + 'scss/**/*.scss')
        // plumber makes sure sass errors doesn't kill gulp
        .pipe(plumber({ errorHandler: onError }))
        .pipe(sass())
        .pipe(gulp.dest(root + 'css/src'))
        .pipe(concat('all.css'))
        .pipe(gulp.dest(root + 'css'))
        .pipe(minifycss())
        .pipe(rename('all.min.css'))
        .pipe(gulp.dest(root + 'css'))
        .pipe(notify({ message: 'SCSS task complete' }));
});

// Scripts
gulp.task( 'scripts', function() {
  return gulp.src(root + 'js/manifest.js')
    .pipe(include())
    .pipe(rename({ basename: 'all' }))
    .pipe(gulp.dest(root + 'js/build'))
    // Create minified version
    .pipe(uglify())
    .pipe(rename({ suffix: '.min' }))
    .pipe(gulp.dest(root + 'js/build'))
    .pipe(notify({ message: 'Scripts task complete' }));
});

// Watch
gulp.task('watch', function() {
    gulp.watch([root + 'js/**/*.js', '!./js/build/*.js'], ['scripts']);
    gulp.watch(root + 'scss/**/*.scss', ['scss']);
});

// Default task
gulp.task('default', ['scss', 'scripts', 'watch']);