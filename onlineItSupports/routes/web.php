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
Route::group(['middleware'=>['web']],function(){
	Route::get('/', function () {
		if (Auth::check()) {
			 return redirect()->action('HomeController@index');
		}else{

	    return view('auth.login');
	}
	});
	Route::get('/activateAccount/{token}','Notifications@activate');
	Route::get('/password/reset/{token}',"Auth\ResetPasswordController@showResetForm");
	Route::post('/password/email',"Auth\ForgotPasswordController@sendResetLinkEmail");
	Route::post('/password/reset',"Auth\ResetPasswordController@reset");
	Auth::routes();
	//Auth::routes();
});

Route::group(['middleware'=>['web','auth']],function(){
			Route::get('/readNotification/{read}',['middleware'=>'markAsRead','as'=>'readNotification','uses'=>'Notifications@read']);
			Route::post('/approve',"director@approve");
			Route::post('/cancel',"director@cancel");
			Route::post('/request',"Requests@send");
			Route::post('/comment',"Requests@comment");
			Route::post('/feedback',"Requests@feedback");
			Route::post('/done',"Requests@done");
			Route::post('/assign',"Requests@assign");
			Route::post('/sender',"Requests@sender");
			Route::post('/count',"Requests@count");
			Route::post('/editProfile',"Profile@edit");
			Route::post('/passwordchg',"Profile@password");
			Route::post('/notification',"Notifications@notifications");
			Route::get('/passwordchange','Profile@changePassword');
			Route::get('/profile','Profile@viewProfile');
			Route::get('/login/employee',"loginEmployee@login");
			Route::get('/login/director',"loginDirector@login");
			Route::get('/login/administrator',"loginAdministrator@login");
			Route::get('/home', 'HomeController@index')->name('home');
			Route::get('/role','director@role');
			Route::get('/department','director@department');
			Route::get('/category','director@category');
			Route::get('/floor','director@floor');
			Route::get('/direction','director@direction');
			Route::get('/team','director@team');
			Route::post('/addDepartment','director@addDepartment');
			Route::post('/editDepartment','director@editDepartment');
			Route::post('/deleteDepartment','director@deleteDepartment');
			Route::post('/addFloor','director@addFloor');
			Route::post('/editFloor','director@editFloor');
			Route::post('/deleteFloor','director@deleteFloor');
			Route::post('/addDirection','director@addDirection');
			Route::post('/editDirection','director@editDirection');
			Route::post('/deleteDirection','director@deleteDirection');
			Route::post('/addRole','director@addRole');
			Route::post('/editRole','director@editRole');
			Route::post('/deleteRole','director@deleteRole');
			Route::post('/addCategory','director@addCategory');
			Route::post('/editCategory','director@editCategory');
			Route::post('/deleteCategory','director@deleteCategory');
			Route::post('/addTeam','director@addTeam');
			Route::post('/editTeam','director@editTeam');
			Route::post('/deleteTeam','director@deleteTeam');
			Route::get('/unResolved ','Requests@unResolved');
			Route::get('/administrators','director@administrators');
			Route::post('/searchEmployee','director@searchEmployee');
			Route::post('/searchRequest','director@searchRequest');
			Route::post('/searchAdministrator','director@searchAdministrator');
			Route::get('/employees','director@employee');
			Route::get('/requests','director@requests');
      Route::get('/spamUser','director@UnrealEmailAccount');
			Route::post('/deleteUser','director@deleteUser');
			Route::post('/deleteRequest','director@deleteRequest');
			Route::post('/deleteSpamUser','director@deleteSpamUser');
			Route::get('/home', 'HomeController@index')->name('home');
});
