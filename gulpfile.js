var gulp = require('gulp');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var sourcemaps = require('gulp-sourcemaps');
var templateCache = require('gulp-angular-templatecache');

var documentRoot = 'public';
var jsSourceRoot = documentRoot + '/src';
var destinationDir = documentRoot + '/www';
var jsDestination = destinationDir + '/js';
var scssSourceRoot = documentRoot + 'scss';
var cssDestination = destinationDir + '/css';

var jsSources = [
    jsSourceRoot + '/**/*Service.js',
    jsSourceRoot + '/**/*Module.js',
    jsSourceRoot + '/**/*!(Module).js',
    jsSourceRoot + '/app.js'
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

gulp.task('compile-angular-templates', function () {
    return gulp.src(jsSourceRoot + '/**/*.tpl.html')
        .pipe(templateCache({
            module: 'jugendstadtplan.templates',
            standalone: true
        }))
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

gulp.task('default', ['compile-javascripts', 'compile-angular-templates', 'compile-scss']);

gulp.task('watch', function() {
    gulp.watch([jsSources, scssSources], ['compile-javascripts', 'compile-angular-templates', 'compile-scss']);
});
