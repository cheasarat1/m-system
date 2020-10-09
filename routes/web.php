<?php

Route::get('/', function () {
    return view('home');
})->middleware('auth');

Auth::routes([
	'register' => false,
	'reset' => false
]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/report/effectiveness', 'ReportController@effectiveness')->name('effectiveness');
Route::post('/report/detail', 'ReportController@detail')->name('detail');
Route::get('/report/total', 'ReportController@total')->name('total');

Route::post('/tab/effective', 'TabController@effective');
Route::post('/tab/report', 'TabController@report');

Route::resource('evaluation','EvaluationController');
Route::post('/evaluation/effective','EvaluationController@effective');

Route::resource('school','SchoolController');
Route::post('school/code','SchoolController@code');
Route::post('/school/select2', 'SchoolController@select2');
Route::post('/school/datatable','SchoolController@dataTable');

Route::resource('question','QuestionController');
Route::post('/question/select2', 'QuestionController@select2');
Route::post('/question/datatable','QuestionController@dataTable');

Route::resource('type','TypeController');
Route::post('/type/select2', 'TypeController@select2');
Route::post('/type/datatable','TypeController@dataTable');

Route::resource('village','VillageController');
Route::post('/village/select2', 'VillageController@select2');
Route::post('/village/datatable','VillageController@dataTable');

Route::resource('commune','CommuneController');
Route::post('/commune/select2', 'CommuneController@select2');
Route::post('/commune/datatable','CommuneController@dataTable');

Route::resource('district','DistrictController');
Route::post('/district/select2', 'DistrictController@select2');
Route::post('/district/datatable','DistrictController@dataTable');

Route::resource('province','ProvinceController');
Route::post('/province/select2', 'ProvinceController@select2');
Route::post('/province/datatable','ProvinceController@dataTable');

Route::resource('zone','ZoneController');
Route::post('/zone/select2', 'ZoneController@select2');
Route::post('/zone/datatable','ZoneController@dataTable');

Route::resource('level','LevelController');
Route::post('/level/select2', 'LevelController@select2');

Route::resource('user','UserController');
Route::match(['get', 'post'], '/user/change-password/{id}', 'UserController@changePassword')->name('user.change-password');

Route::resource('role','RoleController');
Route::post('/role/datatable','RoleController@dataTable');

Route::resource('permission','PermissionController');
Route::post('/permission/datatable','PermissionController@dataTable');
