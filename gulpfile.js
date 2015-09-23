var gulp = require('gulp'),
    concat = require('gulp-concat'),
    concatCss = require('gulp-concat-css'),
    uglify = require('gulp-uglify'),
    plumber = require('gulp-plumber'),
    notify = require('gulp-notify'),
    rename = require('gulp-rename'),
    minify = require('gulp-minify-css'),
    sass = require('gulp-sass'),
    paths = {
      js: {
        vendor: [
          'bower_components/jqvmap/jqvmap/jquery.vmap.js'
        ],
        site: []
      },
      css: {
        vendor: [
          'bower_components/jqvmap/jqvmap/jqvmap.css'
        ],
        site: {
          all: 'assets/scss/**/*.scss',
          main: 'assets/scss/style.scss'
        }
      }
    }

gulp.task('js', function () {
  gulp.src(paths.js.site);
});

gulp.task('sass', function () {
  gulp.src(paths.css.site.main)
  .pipe(plumber({
    errorHandler: notify.onError({
      title: 'Gulp',
      message: 'Failed to compile SASS'
    })
  }))
  .pipe(sass())
  .pipe(gulp.dest('dist/'));
});

gulp.task('js:vendor', function () {
  gulp.src(paths.js.vendor)
  .pipe(plumber({
    errorHandler: notify.onError({
      title: 'Gulp',
      message: 'Failed to build vendor JS'
    })
  }))
  .pipe(concat('vendor.js'))
  .pipe(gulp.dest('dist/'));
});

gulp.task('css:vendor', function () {
  gulp.src(paths.css.vendor)
  .pipe(plumber({
    errorHandler: notify.onError({
      title: 'Gulp',
      message: 'Failed to build vendor CSS'
    })
  }))
  .pipe(concatCss('vendor.css'))
  .pipe(gulp.dest('dist'));
});

gulp.task('build', ['js', 'sass', 'js:vendor', 'css:vendor']);
gulp.task('watch', ['build'], function () {
  gulp.watch(paths.css.site.all, ['sass']);
});
