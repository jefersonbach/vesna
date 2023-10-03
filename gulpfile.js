const gulp          = require('gulp'),
      concat        = require('gulp-concat'),
      sourcemaps    = require('gulp-sourcemaps'),
      sass          = require('gulp-sass')(require('sass')),
      prefix        = require('gulp-autoprefixer'),
      jshint        = require('gulp-jshint'),
      uglify        = require('gulp-uglify'),
      imagemin      = require('gulp-imagemin'),
      watch         = require('gulp-watch'),
      del           = require('del');

// CSS/SASS: Optimize, Minify and Copy to /build
gulp.task('styles', function() {
    return gulp.src('source/**/*.scss')
    .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
    .pipe(prefix('last 2 versions'))
    .pipe(gulp.dest('build/'));
});

// JS: Optimize, Minify and Copy to /build
gulp.task('scripts', function() {
    return gulp.src('source/assets/js/**/*.js')
        .pipe(jshint())
        .pipe(jshint.reporter('default'))
        .pipe(concat('scripts.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('build/assets/js/'));
});

// Images: Optimize and Copy to /build
gulp.task('images', function() {
    return gulp.src('source/assets/images/**/*.{png,jpg,jpeg,svg,gif}')
        .pipe(imagemin([
            imagemin.gifsicle({interlaced: true}),
            imagemin.mozjpeg({quality: 77, progressive: true}),
            imagemin.optipng({optimizationLevel: 5}),
            imagemin.svgo({
                plugins: [
                    {removeViewBox: true},
                    {cleanupIDs: false}
                ]
            })
        ]))
        .pipe(gulp.dest('build/'));
});

// Copy Files (PHP, .htaccess, .gitignore) to /build
gulp.task('copy-files', function () {
    return gulp.src('source/**/*.{php,htaccess,gitignore}', { dot: true, base: "source" })
        .pipe(gulp.dest('build/'));
});

// Watch: Tasks
gulp.task('watch', function() {
    gulp.watch('source/**/**/*.css', gulp.series('styles'));
    gulp.watch('source/**/*.scss', gulp.series('styles'));
    gulp.watch('source/**/*.js', gulp.series('scripts'));
    gulp.watch('source/**/assets/images/**/*.{png,jpg}', gulp.series('images'));
    gulp.watch('source/**/*.{php,htaccess,gitignore}', gulp.series('copy-files'));
});

gulp.task('default', gulp.series( 'styles','scripts', 'images', 'copy-files', 'watch'));