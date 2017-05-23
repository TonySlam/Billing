<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('auth.login');
});
//employee table
Route::get('employees',array(
    'uses'=>'UsersController@getEmployees',
    'as'=>'employees',
    'middleware'=>'auth',
));
//create employee
Route::get('create_employee',array(
    'uses'=>'UsersController@getCreateEmployee',
    'as'=>'create_employee',
    'middleware'=>'auth',
));
Route::post('post_employee',array(
    'uses'=>'UsersController@postEmployee',
    'as'=>'post_employee',
    'middleware'=>'auth',
));
//job card user profile
Route::get('jobcard/{id}',array(
    'uses'=>'UsersController@getEmployee',
    'as'=>'jobcard',
    'middleware'=>'auth',
));

Route::get('jobcard_dynamic/{id}',array(
    'uses'=>'UsersController@getEmployeeDyn',
    'as'=>'jobcard_dynamic',
    'middleware'=>'auth',
));
//view service/add service
Route::get('service',array(
    'uses'=>'ServiceController@getService',
    'as'=>'service',
    'middleware'=>'auth',
));
Route::post('post_service',array(
    'uses'=>'ServiceController@postService',
    'as'=>'post_service',
    'middleware'=>'auth',
));
//Post jobcard 
Route::post('post_tech',array(
    'uses'=>'JobcardController@postTech',
    'as'=>'post_tech',
    'middleware'=>'auth',
));
Route::post('post_techDyn',array(
    'uses'=>'JobcardController@postTechDyn',
    'as'=>'post_techDyn',
    'middleware'=>'auth',
));
//company
Route::get('company',array(
    'uses'=>'CompanyController@index',
    'as'=>'company',
    'middleware'=>'auth',
));
//post company
Route::post('post_company',array(
    'uses'=>'CompanyController@store',
    'as'=>'post_company',
    'middleware'=>'auth',
));
//company
Route::get('company_list',array(
    'uses'=>'CompanyController@getCompany',
    'as'=>'company_list',
    'middleware'=>'auth',
));
//get employees via company
Route::get('company_emp/{id}',array(
    'uses'=>'UsersController@getCompanyEmp',
    'as'=>'company_emp',
    'middleware'=>'auth',
));
//view employee calendar jobs
Route::get('view_jobs/{id}',array(
    'uses'=>'JobcardController@getShow',
    'as'=>'view_jobs',
    'middleware'=>'auth',
));

Route::get('findRate',array(
    'uses'=>'JobcardController@findRate',
    'as'=>'findRate',
    'middleware'=>'auth',
));
//get total by calendar date
Route::get('get_total/{id}',array(
    'uses'=>'JobcardController@getTotal',
    'as'=>'get_total',
    'middleware'=>'auth',
));



//comment
Route::post('profile',array(
    'uses'=>'CommentController@createPost',
    'as'=>'createPost',
    'middleware'=>'auth',
));

Route::post('profile/{id}',array(
    'uses'=>'CommentController@createComment',
    'as'=>'createComment'
));
Route::get('comment/new/{id}',array(
    'uses'=>'CommentController@newPost',
    'as'=>'newComment',
    'middleware'=>'auth',
));
//Update user
Route::post('/user_update/upd/{id}','UsersController@update');
Route::post('/user_status/status/{id}','UsersController@update_status');
//update rate

Route::post('/user_status/rate/{id}','UsersController@update_rate');
//get user
Route::get('user_profile/{id}',array(
    'uses'=>'UsersController@getUser',
    'as'=>'user_profile',
    'middleware'=>'auth',
));
//post rate
Route::post('createRate',array(
    'uses'=>'ServiceController@postRate',
    'as'=>'createRate',
    'middleware'=>'auth',
));

/*delete method for service*/
Route::get('/service/{id}','ServiceController@destroy');
/*rate delete method*/
Route::get('/rate/{id}','ServiceController@remove');

/*Update service and rate*/
Route::get('service_edit/{id}',array(
    'uses'=>'ServiceController@getEdit_Service',
    'as'=>'service_edit',
    'middleware'=>'auth',
));

Route::get('rate_edit/{id}',array(
    'uses'=>'ServiceController@getEdit_Rate',
    'as'=>'rate_edit',
    'middleware'=>'auth',
));
Route::post('/service/service/{id}','ServiceController@update');
Route::post('/rate/rate/{id}','ServiceController@update_rate');
Route::auth();

Route::get('/home', 'HomeController@index');
