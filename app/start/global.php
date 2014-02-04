<?php

/*
|--------------------------------------------------------------------------
| Register The Laravel Class Loader
|--------------------------------------------------------------------------
|
| In addition to using Composer, you may use the Laravel class loader to
| load your controllers and models. This is useful for keeping all of
| your classes in the "global" namespace without Composer updating.
|
*/

ClassLoader::addDirectories(array(

	app_path().'/commands',
	app_path().'/controllers',
	app_path().'/models',
	app_path().'/database/seeds',

));

/*
|--------------------------------------------------------------------------
| Application Error Logger
|--------------------------------------------------------------------------
|
| Here we will configure the error logger setup for the application which
| is built on top of the wonderful Monolog library. By default we will
| build a rotating log file setup which creates a new file each day.
|
*/

$logFile = 'log-'.php_sapi_name().'.txt';

Log::useDailyFiles(storage_path().'/logs/'.$logFile);

/*
|--------------------------------------------------------------------------
| Application Error Handler
|--------------------------------------------------------------------------
|
| Here you may handle any errors that occur in your application, including
| logging them or displaying custom views for specific errors. You may
| even register several error handlers to handle different types of
| exceptions. If nothing is returned, the default error view is
| shown, which includes a detailed stack trace during debug.
|
*/

App::error(function(Exception $exception, $code)
{
	// switch ($code) {
	// 	case 404:	
	// 		return Response::view('errors.404', array(), 404);
	// 		break;
	// 	default:
	// 		return Response::view('errors.404', array(), 404);
	// 		break;
	// }
});

/*
|--------------------------------------------------------------------------
| Maintenance Mode Handler
|--------------------------------------------------------------------------
|
| The "down" Artisan command gives you the ability to put an application
| into maintenance mode. Here, you will define what is displayed back
| to the user if maintenace mode is in effect for this application.
|
*/

App::down(function()
{
	return Response::make("Be right back!", 503);
});

/*
|--------------------------------------------------------------------------
| Require The Filters File
|--------------------------------------------------------------------------
|
| Next we will load the filters file for the application. This gives us
| a nice separate location to store our route and application filter
| definitions instead of putting them all in the main routes file.
|
*/

require app_path().'/filters.php';

/*
|--------------------------------------------------------------------------
| Constanta Aplikasi
|--------------------------------------------------------------------------
|
| Definisi-definisi constanta dalam aplikasi retane
|
*/
define("DS", DIRECTORY_SEPARATOR);
define("RETANE_UPLOAD_FOLDER", base_path().'/public/assets/uploads/' );
define("DOT_SEPARATOR", '.' );
define("PREFIX_FOTO", 'retane_user_' );
define("PREFIX_LAMPIRAN", 'retane_attach_' );
define("MAXSIZE_FOTO", 5000000); // 1 MB
define('DOWNLOAD_PATH', public_path() . DS . 'assets' . DS . 'downloads');
define('UPLOAD_PATH', public_path() . DS . 'assets' . DS . 'uploads');
define('PUN_ROOT', public_path() . DS . 'forum' . DS);
require PUN_ROOT.'include/common.php';