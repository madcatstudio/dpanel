<?php

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


use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('domains.index');
//});
Route::get('/', 'DomainsController@index')->name('homepage');

Route::get('/domains', 'DomainsController@index')->name('domains');
Route::post('/domains', 'DomainsController@store');
Route::get('/domains/create', 'DomainsController@create');
Route::get('/domains/{domain}/edit', 'DomainsController@edit');
Route::get('/domains/{domain}', 'DomainsController@show');
Route::patch('/domains/{domain}', 'DomainsController@update');
Route::delete('/domains/{domain}', 'DomainsController@destroy');

Route::get('/domains/{domain}/emails/create', 'EmailsController@create');
Route::get('/domains/{domain}/databases/create', 'DatabasesController@create');
Route::get('/domains/{domain}/subdomains/create', 'SubdomainsController@create');
Route::get('/domains/{domain}/webapps/create', 'WebAppsController@create');

Route::post('/emails', 'EmailsController@store');
Route::get('/emails/{email}/edit', 'EmailsController@edit');
Route::patch('/emails/{email}', 'EmailsController@update');
Route::delete('/emails/{email}', 'EmailsController@destroy');

Route::post('/databases', 'DatabasesController@store');
Route::get('/databases/{database}/edit', 'DatabasesController@edit');
Route::patch('/databases/{database}', 'DatabasesController@update');
Route::delete('/databases/{database}', 'DatabasesController@destroy');

Route::post('/subdomains', 'SubdomainsController@store');
Route::get('/subdomains/{subdomain}/edit', 'SubdomainsController@edit');
Route::patch('/subdomains/{subdomain}', 'SubdomainsController@update');
Route::delete('/subdomains/{subdomain}', 'SubdomainsController@destroy');

Route::post('/webapps', 'WebAppsController@store');
Route::get('/webapps/{webapp}/edit', 'WebAppsController@edit');
Route::patch('/webapps/{webapp}', 'WebAppsController@update');
Route::delete('/webapps/{webapp}', 'WebAppsController@destroy');

Route::get('/hostings', 'HostingsController@index');
Route::get('/hostings/create', 'HostingsController@create');
Route::post('/hostings', 'HostingsController@store');
Route::get('/hostings/{hosting}/edit', 'HostingsController@edit');
Route::get('/hostings/{hosting}', 'HostingsController@show');
Route::patch('/hostings/{hosting}', 'HostingsController@update');
Route::delete('/hostings/{hosting}', 'HostingsController@destroy');

Route::get('/maintainers', 'MaintainersController@index');
Route::get('/maintainers/create', 'MaintainersController@create');
Route::post('/maintainers', 'MaintainersController@store');
Route::get('/maintainers/{maintainer}/edit', 'MaintainersController@edit');
Route::get('/maintainers/{maintainer}', 'MaintainersController@show');
Route::patch('/maintainers/{maintainer}', 'MaintainersController@update');
Route::delete('/maintainers/{maintainer}', 'MaintainersController@destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
