'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var browserSync = require('browser-sync').create();
var autoprefixer = require('gulp-autoprefixer');
var imagemin = require('gulp-imagemin');
var uglify = require('gulp-uglify');

var project_url = "http://projekt.loc";
var theme_name = 'genesis-child' + '/';
var theme_path = 'wp-content/themes/' + theme_name;

gulp.task('default', ['sass', 'scripts', 'images', 'fonts'], function (){

});

gulp.task('sass', function(){
  return gulp.src(theme_path + 'app/sass/styles.scss')
  	.pipe(sourcemaps.init())
    .pipe(sass({outputStyle: 'compressed'})) // Converts Sass to CSS with gulp-sass
    .pipe(sourcemaps.write())
    .pipe(autoprefixer('last 2 versions', 'safari 9' , 'safari 5', 'ie6', 'ie7', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
    .pipe(gulp.dest(theme_path + 'dist/css'))
});

gulp.task('browserSync', function() {
  browserSync.init({
    proxy: project_url,
    files: theme_path + 'dist',
    reloadDelay: 800
  })
})

gulp.task('watch', ['sass', 'scripts', 'browserSync'], function(){
  gulp.watch(theme_path + 'app/sass/**/*.scss', ['sass']);
  gulp.watch(theme_path + 'app/js/*.js', ['scripts'], browserSync.reload);
  // Other watchers
})

gulp.task('images', function(){
  return gulp.src(theme_path + 'app/images/**/*.+(png|jpg|jpeg|gif|svg)')
  .pipe(imagemin({
      progressive: true,
      optimizationLevel: 7,
      interlaced: true
    })
  )
  .pipe(gulp.dest(theme_path + 'dist/img'))
});

gulp.task('fonts', function() {
  return gulp.src(theme_path + 'app/fonts/**/*')
  .pipe(gulp.dest(theme_path + 'dist/fonts'))
})

gulp.task('scripts', function() {
  return gulp.src(theme_path + 'app/js/*.js')
  .pipe(uglify())
  .pipe(gulp.dest(theme_path + 'dist/js'));
});
