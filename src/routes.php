<?php

Route::get('user', function(){
	echo 'Hello from the user package!';
});





Route::post('/login' , 'Insyghts\Authendication\Controllers\UserController@login');
Route::post('/register' , 'Insyghts\Authendication\Controllers\UserController@register');
Route::get('/test' , 'Insyghts\Authendication\Controllers\UserController@test');

Route::middleware([myAuth::class])->group(function(){

    Route::post('/mymiddle' , 'Insyghts\Authendication\Controllers\ContactController@middle');

    Route::post('/create-contacts' , 'Insyghts\Authendication\Controllers\ContactController@store');
    Route::get('/contacts' , 'Insyghts\Authendication\Controllers\ContactController@contacts');
    Route::get('/single-contact/{id}' , 'Insyghts\Authendication\Controllers\ContactController@single');
    Route::put('/update-contact/{id}' , 'Insyghts\Authendication\Controllers\ContactController@update');
    Route::delete('/delete-contact/{id}' , 'Insyghts\Authendication\Controllers\ContactController@delete');


    Route::post('/refresh-token' , 'Insyghts\Authendication\Controllers\UserController@refresh');



 });
