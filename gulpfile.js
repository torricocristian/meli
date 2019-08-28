/* eslint-disable */
'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');
var imagemin = require('gulp-imagemin');
var cleanCSS = require('gulp-clean-css');
var rename = require('gulp-rename');

var paths = {
    dest: './assets/dist/js',
    styles: {
        src: [
            './scss/**/*.scss'
        ]
    },
    scripts: {
        src: [
            './node_modules/jquery/dist/jquery.min.js',
            './js/**/*.js'
        ]
    },
};


// Uglify and concat JS files
function scripts() {

    // Rename NPM's ".css" to ".scss"
    gulp.src("./node_modules/normalize.css/normalize.css")
        .pipe(rename(function (path) {
            path.basename = "_normalize";
            path.extname = ".scss";
        }))
        .pipe(gulp.dest("./node_modules/normalize.css"));

    return gulp
        .src(paths.scripts.src)
        .pipe(uglify())
        .pipe(concat('app.min.js'))
        //.pipe(sourcemaps.write('../sourcemaps'))
        .pipe(gulp.dest(paths.dest))
}


function styles() {
    return gulp
        .src(paths.styles.src)
        .pipe(sourcemaps.init())
        .pipe(sass({
            outputStyle: 'compressed'
        }).on('error', sass.logError))
        .pipe(
            autoprefixer({
                browsers: ['last 4 versions'],
                cascade: false,
            }),
        )
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest('./assets/dist/css'));
}

/*
 * task to minify the css files
 * SCSS files are converted to CSS and than minified by the following task
 */

function minifyCSS() {
    return gulp
        .src('css/*.css')
        .pipe(
            cleanCSS({
                debug: true
            }, function (details) {
                console.log('=========================================');
                console.log(details.name + ': ' + details.stats.originalSize);
                console.log(details.name + ': ' + details.stats.minifiedSize);
                console.log('=========================================');
            }),
        )
        .pipe(
            rename({
                suffix: '.min',
            }),
        )
        .pipe(gulp.dest('css/min'));
}

// Optimizing Images
function optimiseImages() {
    return (
        gulp
        .src('./img/**/*.+(png|jpg|jpeg|gif|svg)')
        // Caching images that ran through imagemin
        .pipe(
            imagemin({
                interlaced: true,
            }),
        )
        .pipe(gulp.dest('./img'))
    );
}

function watch() {
    gulp.watch(paths.styles.src, styles);
    gulp.watch(paths.scripts.src, scripts);
}

/*
 * Specify if tasks run in series or parallel using `gulp.series` and `gulp.parallel`
 */
var build = gulp.series(gulp.parallel(styles, scripts));

/*
 * You can use CommonJS `exports` module notation to declare tasks
 */

exports.styles = styles;
exports.watch = watch;
exports.build = build;
/*
 * Define default task that can be called by just running `gulp` from cli
 */
exports.default = build;