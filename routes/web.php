<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    global $users;
    return $users;
});
Route::get('/user', function () {
    global $users;
    return "The users are : ". $users[0]['name'].", ".$users[1]['name'].',';
});

Route::get('api/user', function () {
    global $users;
    return $users;
});

// Route::get('/api/user/{userIndex}', function ($userIndex) {
//     global $users;
//     if($userIndex < count($users)){
//         return $users[$userIndex];
//     }else{
//         return "Cannot find the user whith index ".$userIndex;
//     }
// });

Route::get('/api/user/{userName}', function ($userName) {
    global $users;
    for($i = 0; $i < count($users);$i++){
        if($userName == $users[$i]['name']){
          return $users[$i];
        }
    }
    return "Cannot find the user whith name ".$userName;
});

Route::group(['prefix'=>'/api/user'],function(){

    Route::get('/', function () {
        global $users;
        return $users;
    });
    
    Route::get('{userIndex}', function ($userIndex) {
        global $users;
        if($userIndex < count($users)){
            return $users[$userIndex];
        }else{
            return "Cannot find the user whith index ".$userIndex;
        }
    });

    Route::get('{userName}', function ($userName) {
        global $users;
        for($i = 0; $i < count($users);$i++){
            if($userName == $users[$i]['name']){
              return $users[$i];
            }
        }
        return "Cannot find the user whith name ".$userName;
    });

    Route::get('{userName}/post/{postIndex}', function ($postIndex, $userIndex) {
        global $users;
        if($userIndex < count($users)){
            if($postIndex < count($users[$userIndex]['post'])){
                return $users[$userIndex]['post'][$postIndex];
            }
        }else{
            return "Cannot find the post whith id ".$postIndex." for user ". $userIndex;
        }
    });
});
