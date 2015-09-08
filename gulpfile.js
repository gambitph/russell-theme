/**
 * Terminal usage:
 * - To build the project into an installable WordPress zip in the dist folder: $ gulp
 * - To start listening for changed files: $ gulp watch
 * - To perform a unit test: $ gulp unit-test
 * - To clear the unit test database: $ gulp unit-test-init
 */

// List of modules used.
var gulp = require('gulp'),
	phpcs = require('gulp-phpcs'), // WordPress Standards
	watch = require( 'gulp-watch' ), // Used for listening to changed files and executing tasks on them
    rename = require('gulp-rename'),
    concat = require('gulp-concat'),
    notify = require('gulp-notify'),
    shell = require('gulp-shell'), // Execute terminal commands
	zip = require('gulp-zip'), // Zip used for building
	debug = require('gulp-debug'),
	browserSync = require('browser-sync').create(),

	// SCSS compilation
    sass = require('gulp-ruby-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    minifycss = require('gulp-minify-css'),
	sourcemaps = require('gulp-sourcemaps'), // Creates sourcemap .map files for css
	cmq = require('gulp-combine-media-queries'), // Combines media queries together

	// Javascript compilation
    jshint = require('gulp-jshint'),
	stylish = require( 'jshint-stylish' ),
    uglify = require('gulp-uglify'),
    include = require('gulp-include'), // imports Javascript files

	// Translation
	wpPot = require('gulp-wp-pot'), // Create .pot file for WP project
	sort = require('gulp-sort'), // Used by wpPot

	// Unit testing
	run = require('gulp-run'),

	// Plugin creation
	prompt = require('gulp-prompt'),
	replace = require('gulp-replace'),
	merge = require('merge-stream'),
	gulpif = require('gulp-if'),
	gulpIgnore = require('gulp-ignore'),

	// Image compression (when building)
	imagemin = require('gulp-imagemin');


/**
 * Build parameters
 */
var url = 'local.wordpress.dev',
	themeName = 'Russell',
	unitTestDatabase = 'wordpress_unit_tests',
	performUnitTestEvery = 5, // every N calls
	buildInclude = [
		'./*.+(txt|php|css|md)', // All files in the root
		'screenshot.png',
		'css/**/*', // Our main plugin files
		'languages/*.+(po|mo|pot)', // Translation files
		'fonts/**/*', // Font icons
		'images/**/*.+(jpg|png|gif|jpeg)', // Include images
		'inc/**/*', // Include files if any
		'layouts/**/*'
	];


/**
 * Browser Sync init & reloader
 */
gulp.task( 'browser-sync', function() {
    browserSync.init({
        proxy: url
    });
});

gulp.task( 'browser-reload', function() {
	browserSync.reload();
});


/**
 * Build installable WordPress zip in the dist folder
 */
// Readies the dist folder for building
gulp.task( 'buildStart', [ 'unit-test-init' ], function () {
	return gulp.src( 'dist' )
		// Do shell command instead of rimraf
		.pipe( shell( [ 'rm -R <%= file.path %>' ], {
			// We only want PHPCS errors to notify
			ignoreErrors: true,
			// We don't want to see what was fixed
			quiet: true
		} ) )
		.pipe( notify( { message: 'Cleared dist folder complete', onLast: true } ) );
});
// Copy all project files into the build directory for packaging
gulp.task( 'buildFiles', [ 'buildStart', 'styles', 'scripts', 'standards', 'translations', 'unit-test-coverage' ], function () {
	return gulp.src( buildInclude, { base: './' } )
		.pipe( gulp.dest( 'dist/build' ) )
		.pipe( notify( { message: 'Copy build files complete', onLast: true } ) );
} );
// Minify images in the build folder
gulp.task( 'buildImages', [ 'buildFiles' ], function() {
  return gulp.src( 'dist/build/**/*.+(jpg|gif|png)', { base: './' } )
	.pipe( debug( { title: 'Minify image:' } ) )
    .pipe( imagemin( { optimizationLevel: 5, progressive: true, interlaced: true } ) )
    .pipe( gulp.dest( './' ) )
    .pipe( notify( { message: 'Images task complete', onLast: true } ) );
});
// Package the build folder into an installable WordPress plugin/theme
gulp.task( 'buildZip', ['buildImages'], function () {
	return gulp.src( [ 'dist/build/**/*', '!**/.*' ] )
		.pipe( zip( themeName.toLowerCase().replace( ' ', '-' ) + '.zip' ) )
		.pipe( gulp.dest( 'dist' ) )
		.pipe( notify( { message: 'Zipped build complete', onLast: true } ) );
} );
// Cleans the dist folder by deleting the temporary build folder
gulp.task('buildClean', ['buildZip'], function () {
    // rimraf('dist/build', cb);
	return gulp.src( 'dist/build' )
		// Do shell command instead of rimraf
		.pipe( shell( [ 'rm -R <%= file.path %>' ], {
			// We only want PHPCS errors to notify
			ignoreErrors: true,
			// We don't want to see what was fixed
			quiet: true
		} ) )
		.pipe( notify( { message: 'Build complete', onLast: true } ) );
});
// By default, run the whole build process
gulp.task( 'default', [ 'buildClean' ] );
gulp.task( 'build', [ 'buildClean' ] );


/**
 * SCSS Styles
 */
gulp.task('styles', function () {
	return sass( 'scss/style.scss', { 
		sourcemap: false,
		emitCompileError: true
	} )
	// Notice on error
	.on( 'error', function( err ) {
		notify.onError( { 
			title: 'Error!',
	        message: '<%= error.message %>',
	        sound: 'Basso'
		} ) ( err );
	    this.emit( 'end' );
	})
	.pipe( autoprefixer( 'last 2 version' ) )
	// .pipe( cmq() )
	// .pipe( minifycss() )
	// For file sourcemaps
		//     .pipe( sourcemaps.write( 'maps', {
		// includeContent: false,
		// sourceRoot: 'source'
		//     } ) )
    .pipe( gulp.dest( '.' ) )
	// Done
	.pipe( browserSync.stream() )
	.pipe( notify( { message: 'Styles task complete', onLast: true } ) );
});


/**
 * Javascript
 */
var hadJShintError = false;
gulp.task( 'scripts', function() {
  return gulp.src( 'js/[^_]*.js' )
	// Combine the included files
	.pipe( include() )
	// Check for WordPress syntax standards with JSHint
	.pipe( jshint( '.jshintrc' ) )
	.pipe( jshint.reporter( 'jshint-stylish' ) )
	// This is how we catch errors in JSHint: https://github.com/mikaelbr/gulp-notify#as-jshint-reporter
	.pipe( notify( function ( file ) {
		// Don't show something if success
		if ( typeof file.jshint === 'undefined' || file.jshint.success ) {
			hadJShintError = false;
			return false;
		}

		var errors = file.jshint.results.map( function ( data ) {
			if ( data.error ) {
				return "(" + data.error.line + ':' + data.error.character + ') ' + data.error.reason;
			}
		} ).join( "\n" );
		  
		hadJShintError = true;
		  
		  return false;
		// return {
		// 	title: 'JSHint Error',
		// 	message: file.relative + " (" + file.jshint.results.length + " errors)\n" + errors,
		// 	sound: 'Basso'
		// };
    } ) )
	// Debugging copy (combined but not minified)
	.pipe( gulp.dest( 'js/dev' ) )
	// Minify
	.pipe( uglify() )
	// myscript-min.js
    .pipe( rename( { suffix: '-min' } ) )
	// Save minified version
	.pipe( gulp.dest( 'js/min' ) )
	// Done
	// Notify success message only when there were no errors
    .pipe( notify( function() {
		return ! hadJShintError ? { message: 'Scripts task complete', onLast: true } : false;
    } ) );
});


/**
 * WordPress coding standards.
 */
gulp.task('standards', function() {
  return gulp.src( [ '**/*.php' ] )
	// Run PHP CBF to fix easy errors first on the file being processed
	.pipe( shell( [ 'phpcbf --standard=WordPress-Core,WordPress-Docs <%= file.path %>' ], {
		// We only want PHPCS errors to notify
		ignoreErrors: true,
		// We don't want to see what was fixed
		quiet: true
	} ) )
	// Run PHP Code Sniffer to check
    .pipe(phpcs({
      standard: 'WordPress-Core,WordPress-Docs',
    })) 
	// Show PHPCS logs (this is where we check on how to fix stuff)
    .pipe(phpcs.reporter('log'))
	// Make it report an error (doesn't report an error if there is none)
    .pipe(phpcs.reporter('fail'))
	// Notify desktop for errors
	.on( 'error', function( err ) {
		notify.onError( {
			title: 'Error!',
	        message: '<%= error.message %>',
	        sound: 'Basso'
		} ) ( err );
		// Don't continue
	    this.emit( 'end' );
	})
	// If all complete, notify
	.pipe( notify( { message: 'WordPress coding standards complete', onLast: true } ) );
});


/**
 * Translation files
 */
gulp.task( 'translations-pot', function () {
    return gulp.src( [ '**/*.php' ] )
		.pipe( sort() )
        .pipe( wpPot( {
            domain: 'russell',
            destFile: 'theme.pot',
            package: themeName,
            // bugReport: 'http://gambit.ph',
            lastTranslator: 'Benjamin Intal <bf.intal@gambit.ph>',
            team: 'Gambit Technologies Inc <info@gambit.ph>'
        } ))
		.pipe( gulp.dest( 'languages' ) )
		.pipe( notify( { message: '.pot file generated', onLast: true } ) );
});
gulp.task( 'translations', [ 'translations-pot' ], function () {
	return gulp.src( 'languages/theme.pot')
		// Do shell command instead of rimraf
		.pipe( shell( [ 
			'brew link gettext --force && ' + // Keg only, so we need to link before using
			'msginit --no-translator -l en_US -o languages/theme-en_US.po -i languages/theme.pot && ' +
			'msgfmt -o languages/theme-en_US.mo languages/theme-en_US.po && ' +
			'brew unlink gettext' // Keg only, so we need to unlink after using
		], {
			// We only want PHPCS errors to notify
			ignoreErrors: false,
			// We don't want to see what was fixed
			quiet: true
		} ) )
		.pipe( notify( { message: 'Translations complete', onLast: true } ) );
});


/**
 * Unit Testing
 */

// Initializes the unit test database
gulp.task( 'unit-test-init', function () {
	// return; // TODO
	shell( 'vassh bash bin/install-wp-tests.sh ' + unitTestDatabase + ' root root localhost latest' );
});
gulp.task( 'unit-test-coverage', function () {
	// return; // TODO
	run( 'vassh "xdebug_on && phpunit --coverage-text && xdebug_off"' ).exec()
		.on( 'error', function( err ) {
			notify.onError( {
				title: 'PHP Unit Test Error!',
		        message: 'See terminal for details',
		        sound: 'Basso'
			} ) ( err );
			// Don't continue
			run( 'vassh "xdebug_off"' ).exec();
		    this.emit( 'end' );
		})
		.pipe( notify( { title: 'PHP Unit Test Passed!', message: 'See terminal for details', onLast: true } ) );
});

// Performs a unit test inside Vagrant / VVV
function unitTest() {
	// return; // TODO
	run( 'vassh "phpunit"' ).exec()
		.on( 'error', function( err ) {
			notify.onError( {
				title: 'PHP Unit Test Error!',
		        message: 'See terminal for details',
		        sound: 'Basso'
			} ) ( err );
			// Don't continue
		    this.emit( 'end' );
		})
		.pipe( notify( { title: 'PHP Unit Test Passed!', message: 'See terminal for details', onLast: true } ) );
}

// Run a unit test
gulp.task( 'unit-test', function () {
	unitTest();
});

// Run a unit test every N calls (used in watch)
var unitTestCounter = 0;
gulp.task( 'unit-test-sometimes', function () {
	if ( unitTestCounter++ < performUnitTestEvery ) {
		return true;
	}
	unitTestCounter = 0;
	unitTest();
});


/**
 * Watch changed files
 */
gulp.task( 'watch', [ 'styles', 'scripts', 'translations', 'unit-test-init', 'standards', 'browser-sync', 'unit-test' ], function() {
  gulp.watch( 'scss/**/*.scss', [ 'styles' ] );
  gulp.watch( [ '**/*.php' ], [ 'standards', 'unit-test-sometimes', 'browser-reload' ] );
  gulp.watch( [ 'js/*.js' ], [ 'scripts', 'browser-reload' ] );
  gulp.watch( [ '**/*.+(png|jpg|gif)' ], [ 'browser-reload' ] );
} );
