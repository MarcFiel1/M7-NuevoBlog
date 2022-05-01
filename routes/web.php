
  
<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Post;

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

//Rutes principals

Route::get('/','HomeController@index')->name('home'); 

Route::resources([
    'posts'=>'PostController',
    'users'=>'UserController'
]);

Route::get('/admin','ProfileController@index')->name('admin')->middleware(['auth','role:admin']);
 
//***PERFIL****
//PERFIL
Route::get('/profile','ProfileController@index')->name('profile');
//VISTA EDITAR PERFIL
//Route::get('/profile/{id}/edit','ProfileController@edit')->name('profile.edit');
//ACTUALITZAR PERFIL
Route::put('/profile/{user}/update','ProfileController@update')->name('profile.update');



//***POSTS****
//CREAR ELS POSTS
Route::get('/store','PostController@store')->name('posts.store');

//VISTA EDITAR POSTS
Route::get('post/edit/{post}','PostController@edit')->name('posts.edit');

//ACTUALITZAR EL POST
Route::put('post/{post}/update','PostController@update')->name('posts.update');

//ELIMINAR ELS POSTS
Route::delete('/destroy/{post}', 'PostController@destroy')->name('posts.destroy');

//***COMMENTS****
Route::get('comment/{post}','CommentController@index')->name('comment');

Route::post('comment/store','CommentController@store')->name('comment.store');

Route::delete('/comment/{id}', 'CommentController@destroy')->name('comment.destroy');

//***ADMIN****
//PANEL DE CONTROL
Route::get('/controlpanel','ControlPanelController@index')->name('controlpanel');

Route::delete('/destroy/{user}','ControlPanelController@destroy')->name('controlpanel.destroy');

/***TAGS****/
Route::post('tags/store','TagController@store')->name('tags.store');

/***BARRA BUSQUEDA****/
Route::get('/search', 'PostController@search')->name('search');

Auth::routes();