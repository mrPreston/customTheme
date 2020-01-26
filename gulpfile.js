var gulp = require('gulp');
var sass = require('gulp-sass');
var concat = require('gulp-concat');

var paths = {
    styles: {
        src: "./assets/css/src/*.sass",
        dest: "./assets/css/"
    }
};

function style() {
    return gulp
        .src(paths.styles.src)
        .pipe(sass())
        .pipe(concat('all.css'))
        .on("error", sass.logError)
        .pipe(gulp.dest(paths.styles.dest));
}

function watch() {
    style();
    gulp.watch(paths.styles.src, style);
}


exports.watch = watch
// $ gulp style
exports.style = style;
