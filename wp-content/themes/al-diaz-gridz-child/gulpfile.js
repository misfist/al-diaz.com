// npm install --save-dev gulp gulp-plumber gulp-watch gulp-livereload gulp-minify-css gulp-jshint jshint-stylish gulp-uglify gulp-rename gulp-notify gulp-include gulp-sass

var gulp = require('gulp'),
    plumber = require( 'gulp-plumber' ),
    watch = require( 'gulp-watch' ),
    livereload = require( 'gulp-livereload' ),
    minifycss = require( 'gulp-minify-css' ),
    jshint = require( 'gulp-jshint' ),
    stylish = require( 'jshint-stylish' ),
    uglify = require( 'gulp-uglify' ),
    rename = require( 'gulp-rename' ),
    notify = require( 'gulp-notify' ),
    include = require( 'gulp-include' ),
    sass = require( 'gulp-sass' ),
    imagemin = require( 'gulp-imagemin' ),
    pngquant = require( 'imagemin-pngquant' );

var onError = function( err ) {
    console.log( 'An error occurred:', err.message );
    this.emit( 'end' );
}

var paths = {
    /* Source paths */
    styles: ['./src/styles/style.scss'],
    scripts: [
        './src/scripts/*',
        './src/vendor/js/*'
    ],
    images: ['./src/images/**/*'],
    fonts: [
        './src/fonts/*',
        './src/vendor/fonts/*'
    ],

    /* Output paths */
    stylesOutput: './assets/styles',
    scriptsOutput: './assets/scripts',
    imagesOutput: './assets/images',
    fontsOutput: './assets/fonts'
};

gulp.task( 'sass', function() {
    return gulp.src( paths.styles, {
        style: 'expanded'
    } )
    .pipe( plumber( { errorHandler: onError } ) )
    .pipe( sass() )
    .pipe( gulp.dest( paths.stylesOutput ) )
    .pipe( minifycss() )
    .pipe( rename( { suffix: '.min' } ) )
    .pipe( gulp.dest( paths.stylesOutput ) )
    .pipe( notify( { message: 'Styles task complete' } ) )
    .pipe( livereload() );
} );

gulp.task('scripts', function() {
  return gulp.src( './src/scripts/**/*.js' )
    .pipe( gulp.dest( './assets/scripts' ) )
    .pipe( rename( { suffix: '.min' } ) )
    .pipe( uglify() )
    .pipe( gulp.dest('./assets/scripts') )
    .pipe( notify( { message: 'Scripts task complete' } ) )
    .pipe( livereload() );
});

gulp.task( 'images', function () {
    return gulp.src( paths.images )
        .pipe(imagemin({
            progressive: true,
            svgoPlugins: [{removeViewBox: false}],
            use: [pngquant()]
        }))
        .pipe( gulp.dest( paths.imagesOutput ) );
});

gulp.task( 'watch', function() {
    livereload.listen();
    gulp.watch( './src/styles/**/*.scss', [ 'sass' ] );
    gulp.watch( './src/images/**/*.jpg', [ 'images' ] );
    //gulp.watch( './src/scripts/**/*.js', [ 'scripts' ] );
    gulp.watch( './**/*.php' ).on( 'change', function( file ) {
        livereload.changed( file );
    } );
} );

gulp.task( 'default', [ 'sass', 'images', 'watch' ], function() {

} )