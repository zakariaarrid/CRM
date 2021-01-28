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

Route::get('/', 'HomeController@home1');

Auth::routes();

Route::group(['middleware'=>'auth'], function(){
    Route::get('/chat',['as' => 'chat', 'uses' => 'HomeController@chat']);
    Route::get('/contacts', 'ContactsController@get');
    Route::get('/conversation/{id}', 'ContactsController@getMessagesFor');
    Route::post('/conversation/send', 'ContactsController@send');
});

Route::group(['middleware'=>'admin'], function(){
    Route::get('/home', 'HomeController@index');
    Route::resource('admin/commande' ,'CommandeController');
    Route::get('getdata/commande',['as' => 'admin.getdata', 'uses' => 'CommandeController@getdata']);
    Route::post('getdata_per_city',['as' => 'admin.getdata_per_city', 'uses' => 'CommandeController@getdata_per_city']);
    Route::resource('admin/user' ,'UserController');
    Route::post('edit_status/commande',['as' => 'admin.edit_statut', 'uses' => 'CommandeController@edit_statut']);
    Route::post('create/commande',['as' => 'admin.store_commande', 'uses' => 'CommandeController@store_commande']);
    Route::get('order_confirmed/commande',['as' => 'admin.confirmation_order', 'uses' => 'CommandeController@confirmation_order']);
    Route::get('all/orders',['as' => 'admin.list_orders', 'uses' => 'CommandeController@get_all_order']);
    Route::get('order_in_delivering/commande',['as' => 'admin.order_in_delivering', 'uses' => 'CommandeController@order_in_delivering']);
    Route::get('order_delivered',['as' => 'admin.order_delivered', 'uses' => 'CommandeController@order_delivered']);
    Route::get('/dash',['as' => 'dashboard', 'uses' => 'CommandeController@dashy']);
    Route::resource('admin/statistics-payment' ,'StatisticsPaymentController');
    Route::post('admin/statistics-payment',['as' => 'statistic.search', 'uses' => 'StatisticsPaymentController@search']);
    Route::post('admin/statistics/command',['as' => 'statistic.search_command', 'uses' => 'StatisticsPaymentController@search_command']);
    Route::post('admin/statistics/delivery_man',['as' => 'statistic.delivery_man', 'uses' => 'StatisticsPaymentController@search_command_livred']);
    Route::get('admin/calcule_statistics',['as' => 'statistic.calcule_statistics', 'uses' => 'StatisticsPaymentController@calcule_statistics']);
    Route::get('admin/calcule_delivring',['as' => 'statistic.calcule_delivring', 'uses' => 'StatisticsPaymentController@calcule_delivery']);
    Route::get('admin/calcule',['as' => 'statistic.calcule', 'uses' => 'StatisticsPaymentController@calculation_table']);

});
Route::group(['middleware'=>'sec'], function(){
    Route::get('/home', 'HomeController@index');
    Route::resource('sec' ,'secController');
    Route::post('sec/edit_status',['as' => 'sec.edit_statut', 'uses' => 'secController@edit_statut']);
    Route::get('order_confirmed',['as' => 'sec.confirmation_order', 'uses' => 'secController@confirmation_order']);
    Route::get('mycommandlivred',['as' => 'sec.calcule_delivery', 'uses' => 'secController@calcule_delivery']);
    Route::post('sec/calcule',['as' => 'sec.calcule', 'uses' => 'secController@search_command_livred']);
});
Route::group(['middleware'=>'Livreur'], function(){
    Route::resource('Liv' ,'LivController');
    Route::post('liv/edit_status',['as' => 'liv.edit_statut', 'uses' => 'LivController@edit_statut']);
    Route::get('none_joingnable',['as' => 'liv.none_joingnable', 'uses' => 'LivController@none_joingnable']);
    Route::get('livreur_livred',['as' => 'liv.livreur_livred', 'uses' => 'LivController@livreur_livred']);
    Route::post('livreur_livred/con',['as' => 'liv.livreur_livred_search', 'uses' => 'LivController@search_command_livred']);
});
Route::group(['middleware'=>'validator'], function(){
    Route::resource('validateur' ,'ValidatorController');
    Route::post('edit_status',['as' => 'validateur.edit_statut', 'uses' => 'ValidatorController@edit_statut']);
    Route::get('order_in_delivering/order',['as' => 'validator.order_in_delivering', 'uses' => 'ValidatorController@order_in_delivering']);
});
Route::get('logout', 'Auth\LoginController@logout', function () {
    return abort(404);
});

Route::namespace('Api')->group(function() {
    Route::apiResource('data', 'dataController');
});
