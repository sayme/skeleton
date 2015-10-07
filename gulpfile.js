/**
 * gulpfile.js
 * 
 * Tasks: bower, scss, js, watch, default
 *
 * Expected file/folder structure to run this gulpfile properly:
 *  /assets
 *      /css
 *      /js
 *          manifest.js
 *          /src
 *      /fonts
 *      /scss
 *  gulpfile.js
 *  bower.json
 *  package.json
 *  .bowerrc       
 */
var gulp = require('gulp'),
    plumber = require('gulp-plumber'),
    watch = require('gulp-watch'),
    minifyCss = require('gulp-minify-css'),
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename'),
    include = require('gulp-include'),
    sass = require('gulp-sass'),
    concat = require('gulp-concat'),
    mainBowerFiles = require('main-bower-files'),
    filter = require('gulp-filter'),
    notify = require('gulp-notify');

// Error handling
var onError = function(error) {
    console.log('An error occured:', error.message);
    this.emit('end');
}

// Path to the root folder where everything should be saved
var root = './assets';

// -----------------------
// configuration
var CONFIG = {
    dest: {
        js: {
            all: root + '/js',
            dist: root + '/js/dist'
        },
        css: {
            src: root + '/css/src',
            all: root + '/css'
        },
        scss: {
            all: root + '/scss'
        },
        fonts: {
            all: root + '/fonts'
        }
    },
    files: {
        js: {
            manifest: root + '/js/manifest.js'
        }
    }
};

// -----------------------
// Bower
gulp.task('bower', ['bower-js', 'bower-css', 'bower-fonts']);

// Bower js
gulp.task('bower-js', function() {
    return gulp.src(mainBowerFiles())
        .pipe(filter('*.js'))
        .pipe(concat('vendor.js'))
        .pipe(uglify())
        .pipe(gulp.dest(CONFIG.dest.js.all));
});

// Bower css
gulp.task('bower-css', function() {
    return gulp.src(mainBowerFiles())
        .pipe(filter('*.css'))
        .pipe(concat('vendor.css'))
        .pipe(minifyCss({ processImport: false }))
        .pipe(gulp.dest(CONFIG.dest.css.all));
 });

// Bower fonts
gulp.task('bower-fonts', function() {
    return gulp.src(mainBowerFiles())
        .pipe(filter(['*.eot', '*.woff', '*.woff2', '*.svg', '*.ttf']))
        .pipe(gulp.dest(CONFIG.dest.fonts.all));
 });

// -----------------------
// SCSS
gulp.task('scss', function () {
    return gulp.src(CONFIG.dest.scss.all + '/**/*.scss')
        // plumber makes sure sass errors doesn't kill gulp
        .pipe(plumber({ errorHandler: onError }))
        .pipe(sass())
        .pipe(gulp.dest(CONFIG.dest.css.src))
        .pipe(concat('all.css'))
        .pipe(gulp.dest(CONFIG.dest.css.all))
        .pipe(minifyCss({ processImport: false }))
        .pipe(rename('all.min.css'))
        .pipe(gulp.dest(CONFIG.dest.css.all))
        .pipe(notify({ message: 'SCSS task complete' }));
});

// -----------------------
// JS
gulp.task( 'js', function() {
    return gulp.src(CONFIG.files.js.manifest)
        .pipe(plumber({ errorHandler: onError }))
        .pipe(include())
        .pipe(rename({ basename: 'all' }))
        .pipe(gulp.dest(CONFIG.dest.js.dist))
        // Create minified version
        .pipe(uglify())
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest(CONFIG.dest.js.dist))
        .pipe(notify({ message: 'Scripts task complete' }));
});

// -----------------------
// Watch
gulp.task('watch', function() {
    gulp.watch([CONFIG.dest.js.all + '/**/*.js', '!' + CONFIG.dest.js.dist + '/*.js'], ['js']);
    gulp.watch(CONFIG.dest.scss.all + '/**/*.scss', ['scss']);
});

// -----------------------
// Default task
gulp.task('default', ['bower', 'scss', 'js', 'watch']);