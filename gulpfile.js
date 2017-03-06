// generated on 2017-02-27 using generator-webapp 2.4.1
const gulp = require('gulp');
const gulpLoadPlugins = require('gulp-load-plugins');
const browserSync = require('browser-sync').create();
const del = require('del');
const wiredep = require('wiredep').stream;
const runSequence = require('run-sequence');

const $ = gulpLoadPlugins();
const reload = browserSync.reload;

gulp.task('styles:app', () => {
  return gulp.src('app/resources/assets/styles/*.scss')
    .pipe($.plumber())
    .pipe($.sourcemaps.init())
    .pipe($.sass.sync({
      outputStyle: 'expanded',
      precision: 10,
      includePaths: ['.']
    }).on('error', $.sass.logError))
    .pipe($.autoprefixer({browsers: ['> 1%', 'last 2 versions', 'Firefox ESR']}))
    .pipe($.cssnano({
      safe: true,
      autoprefixer: false,
      discardComments: {removeAll: true}
    }))
    .pipe($.sourcemaps.write())
    .pipe(gulp.dest('app/public/css'))
    .pipe(reload({stream: true}));
});

gulp.task('styles:vendor', () => {
  const bowerDependencies = require('wiredep')();
  const src = bowerDependencies.hasOwnProperty('css') ? bowerDependencies.css : [];

  return gulp.src(src)
    .pipe($.if(!src.length, $.file('no.css', '')))
    .pipe($.concat('vendor.css'))
    .pipe(gulp.dest('app/public/css'))
    .pipe(reload({stream: true}));
});

gulp.task('styles', ['styles:app', 'styles:vendor']);

gulp.task('scripts:app', () => {
  return gulp.src('app/resources/assets/scripts/**/*.js')
    .pipe($.plumber())
    .pipe($.sourcemaps.init())
    .pipe($.babel())
    .pipe($.uglify({compress: {drop_console: true}}))
    .pipe($.sourcemaps.write('.'))
    .pipe(gulp.dest('app/public/js'))
    .pipe(reload({stream: true}));
});

gulp.task('scripts:vendor', () => {
  const bowerDependencies = require('wiredep')();
  const src = bowerDependencies.hasOwnProperty('js') ? bowerDependencies.js : [];

  return gulp.src(src)
    .pipe($.if(!src.length, $.file('no.js', '')))
    .pipe($.concat('vendor.js'))
    .pipe(gulp.dest('app/public/js'))
    .pipe(reload({stream: true}));
});

gulp.task('scripts', ['scripts:app', 'scripts:vendor']);

gulp.task('images', () => {
  return gulp.src('app/resources/assets/images/**/*')
    .pipe($.cache($.imagemin()))
    .pipe(gulp.dest('app/public/images'));
});

gulp.task('fonts', () => {
  return gulp.src(require('main-bower-files')('**/*.{eot,svg,ttf,woff,woff2}', function (err) {
  })
    .concat('app/resources/assets/fonts/**/*'))
    .pipe(gulp.dest('app/public/fonts'));
});

gulp.task('clean', del.bind(null, [
  'app/public/css',
  'app/public/js',
  'app/public/images',
  'app/public/fonts'
]));

gulp.task('serve', () => {
  // TODO: Configure proxy server for php
  runSequence(['clean', 'wiredep'], ['styles', 'scripts', 'images', 'fonts'], () => {
    browserSync.init({
      notify: false,
      port: 9000,
      server: {
        baseDir: ['app/public']
      }
    });

    gulp.watch(['app/resources/views/**/*']).on('change', reload);
    gulp.watch('app/resources/assets/styles/**/*.scss', ['styles:app']);
    gulp.watch('app/resources/assets/scripts/**/*.js', ['scripts:app']);
    gulp.watch('app/resources/assets/fonts/**/*', ['fonts']);
    gulp.watch('app/resources/assets/images/**/*', ['images']);
    gulp.watch('bower.json', ['wiredep', 'fonts', 'scripts:vendor', 'styles:vendor']);
  });
});

// inject bower components
gulp.task('wiredep', () => {
  return gulp.src('app/resources/assets/styles/*.scss')
    .pipe($.filter(file => file.stat && file.stat.size))
    .pipe(wiredep({
      ignorePath: /^(\.\.\/)+/
    }))
    .pipe(gulp.dest('app/resources/assets/styles'));
});

gulp.task('build', ['styles', 'scripts', 'images', 'fonts'], () => {
  return gulp.src([
    'app/public/css',
    'app/public/js',
    'app/public/images',
    'app/public/fonts'
  ])
    .pipe($.size({title: 'build', gzip: true}));
});

gulp.task('default', () => {
  return new Promise(resolve => {
    runSequence(['clean', 'wiredep'], 'build', resolve);
  });
});
