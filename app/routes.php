<?php
/*
  |--------------------------------------------------------------------------
  | Application Routes
  |----------------------------------------------------------------
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */
Route::get('/databases', 'HomeController@databases');

Route::get('/', 'HomeController@index');

Route::controller('home', 'HomeController');

/*
  |--------------------------------------------------------------------------
  | Application 404 & 500 Error Handlers
  |--------------------------------------------------------------------------
  |
  | To centralize and simplify 404 handling, Laravel uses an awesome event
  | system to retrieve the response. Feel free to modify this function to
  | your tastes and the needs of your application.
  |
  | Similarly, we use an event to handle the display of 500 level errors
  | within the application. These errors are fired when there is an
  | uncaught exception thrown in the application.
  |
 */

  Event::listen('404', function()
  {
    return Response::error('404');
  });

  Event::listen('500', function()
  {
    return Response::error('500');
  });
