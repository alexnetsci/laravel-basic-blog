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

Route::get('/', 'PagesController@index')->name('home_page');

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/permission-denied', 'PermissionsController@permissionDenied')->name('permission_denied');

    Route::get('/myprofile', 'PagesController@myProfile')->name('myprofile');
    Route::resource('/articles', 'ArticlesController');

    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('dashboard', 'Admin\AdminController@dashboard')->name('dashboard');
        Route::get('settings', 'Admin\SettingsController@settings')->name('settings');
        Route::post('settings/update', 'Admin\SettingsController@update')->name('settings.update');

        Route::get('give-admin/{userId}', 'Admin\AdminController@giveAdmin')->name('give_admin');
        Route::get('remove-admin/{userId}', 'Admin\AdminController@removeAdmin')->name('remove_admin');
        Route::get('manage_users', 'Admin\AdminController@manageUsers')->name('manage_users');

        Route::get('get/users', 'Admin\UsersController@getUsers')->name('getUsers');

        Route::resource('categories', 'Admin\CategoriesController')->except('show');
        Route::get('get/categories', 'Admin\CategoriesController@getCategories')->name('getCategories');

        Route::resource('/tags', 'Admin\TagsController')->except('show');
        Route::get('get/tags', 'Admin\TagsController@getTags')->name('getTags');

    });
});
