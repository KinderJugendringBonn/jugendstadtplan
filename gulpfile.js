var gulp = require('gulp');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var sourcemaps = require('gulp-sourcemaps');

var documentRoot = 'web';
var jsSourceRoot = documentRoot + '/src';
var jsDestination = documentRoot + '/js';
var scssSourceRoot = 'scss';
var cssDestination = documentRoot + '/css';

var jsSources = [
    jsSourceRoot + '/**/*Module.js',
    jsSourceRoot + '/**/*!(Module).js',
    jsSourceRoot + '/app.js',
];

gulp.task('compile-javascripts', function() {
    gulp.src(jsSources)
        .pipe(sourcemaps.init())
            .pipe(concat('jugendstadtplan.js'))
            .pipe(gulp.dest(jsDestination))
            .pipe(rename({ suffix: '.min' }))
            .pipe(uglify())
        .pipe(sourcemaps.write())
        .pipe(gulp.dest(jsDestination));
});

var scssSources = [
    scssSourceRoot + '/**/*.scss'
];

gulp.task('compile-scss', function() {
    gulp.src(scssSources)
        .pipe(sourcemaps.init())
        .pipe(sass({
            includePaths: [ 
                documentRoot + '/vendor/foundation/scss',
                documentRoot + '/vendor/font-awesome/scss'
            ]
        }))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest(cssDestination));
});

gulp.task('default', ['compile-javascripts', 'compile-scss']);

gulp.task('watch', function() {
    gulp.watch([jsSources, scssSources], ['compile-javascripts', 'compile-scss']);
});
