<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'WelcomeController@index');
Route::any('{catchall}', function() {
    return redirect('/');
})->where('catchall', '.*');

//Route::get('/{any}', 'WelcomeController@index')->where('any', '.*');
//Route::get('/', 'WelcomeController@index');
/*
Route::get('email', function() {
    Mail::send('auth.verify', [], function ($message) {
        $message->to('carlos34343434@gmail.com', 'HisName')
                ->subject('Welcome!');
    });
});*/
//Auth::routes(['verify' => false]);


//Route::get('/home', 'HomeController@index')->name('home');
