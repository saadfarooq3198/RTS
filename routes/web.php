<?php

use Illuminate\Support\Facades\Route;
use App\Post;
use App\User;
use App\Role;

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

Route::get('/', function () {
    return view('welcome');
});
 
// Route::get('/post/{id}','PostController@post');
// Route::resource('/post','PostController2');
// Route::get('/contact','PostController2@contact_view');
// Route::get('/post/{id}','PostController2@post');


                // Elequent //
// 1. Reading data from database
// Route::get('/findwhere',function(){
// $post=Post::where('id',2)->orderBy('id','desc')->take(1)->get();
// return $post;
// });

// 2. Inserting data in database
Route::get('/insert',function(){
    $post = new post;
    $post->title = "New Elequent Title inserted by saad";
    $post->body = "New Elequent Body of the post inserted by saad";
    $post->is_admin=1;
    $post->save(); 
});

// 3. Updating data in database
Route::get('/update',function(){
    $post = Post::find(2);
    $post->title = "Title is updated";
    $post->body = "Body is updated";
    $post->save();
});

// Insertion using create method
Route::get('/create',function(){
    Post::create(['title'=>"Title using create",'body'=>"Body using create",'is_admin'=>0]);
});

// Updation using update method
Route::get('/updateelq',function(){
    Post::where('id','3')->where('is_admin',1)->update(['title'=>'elq update','body'=>'elq body','is_admin'=>0]);
});

// 3. Deleting data from database
Route::get('/delete',function(){
    $post=Post::find(1);
    $post->delete();
});

// Delete using Destroy method
Route::get('/delete2',function(){
    Post::destroy(3);
});

// Soft Delete
Route::get('/softdelete',function(){
    Post::find(2)->delete();
});

// Reteriving Softdelete
Route::get('/readsoftdelete',function(){
    // $post = Post::withTrashed()->where('id',5)->get();
    $post = Post::onlyTrashed()->get();
    return $post;
});
// Restoring deleted items
Route::get('/restore',function(){
    $post = Post::onlyTrashed()->restore();
});
// Permanently delete a record
Route::get('/forcedelete',function(){
    $post = Post::withTrashed()->where('id',2)->forceDelete();
});

// Laravel Eloquent Relations one to one
Route::get('/user/{id}/post',function($id){
    return User::find($id)->post;
});

//One to One Inverse Relationship
Route::get('/post/{id}/user',function($id){
    return Post::find($id)->user->name;
});

// One to many Relationship
Route::get('/posts',function(){
    $user = User::find(1);
    foreach($user->posts as $post){
        echo $post->title ."<br>";
    }
});
    // Many to many Relationship
    Route::get('/user/{id}/roles',function($id){
        $user = User::find($id);
        foreach($user->roles as $role){
            return $role->name;
        }
});

//Many to many Inverse Relationship
Route::get('/roles/{id}/user',function($id){
    $role = Role::find($id);
    foreach($role->users as $user){
        return $user->name;
    }
});