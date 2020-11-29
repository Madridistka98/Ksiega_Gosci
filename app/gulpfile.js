var gulp = require("gulp"),
    sass = require("gulp-sass"),
    sourcemaps = require("gulp-sourcemaps"),
    autoprefixer = require("gulp-autoprefixer"),
    webpack = require("webpack-stream"),
    browserSync = require("browser-sync");

const server = browserSync.create();

const serve = done => {
    server.init({
      proxy: "http://guest-book.dev.com/",
      files: ["public/**/*.*"],
      browser: "chrome",
      port: 7000,
    });
    done();
};

const reload = done => {
    server.reload();
    done();
  };

gulp.task("scripts", () => {
  return gulp.src(['src/js/main.js'], {allowEmpty: true})
    .pipe(webpack({
      module: {
        rules: [
          {
            test: /\.(js)$/,
            use: {
              loader: 'babel-loader',
              options: {
                presets: [["@babel/preset-env", { "targets": "defaults" }]]
            }
          }
        }
      ]
    },
    mode: 'development',
    devtool: 'inline-source-map',
    output: {
      filename: '[name].js'
    },
  }))
  .pipe(gulp.dest('public/web/js'));
});

gulp.task('styles', () => {
    return gulp.src(['src/sass/main.scss'], {allowEmpty: true})
      .pipe(sourcemaps.init())
      .pipe(sass().on('error', sass.logError))
      .pipe(autoprefixer({overrideBrowserslist: ['last 2 versions','>5%']}))
      .pipe(sourcemaps.write())
      .pipe(gulp.dest('public/web/css'))
      .pipe(server.stream());
  });

gulp.task('watchForChanges', function() {
    gulp.watch(['src/sass/**/*.scss'], gulp.series('styles'));
    gulp.watch(['public/**/*.phtml', 'public/**/*.php'], gulp.series(reload));
    gulp.watch(['src/js/**/*.js'], gulp.series('scripts', reload));
})

gulp.task('start', gulp.series('styles', 'scripts', serve, 'watchForChanges'));