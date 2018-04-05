<?php

$route[] = ['/', 'HomeController@index'];

$route[] = ['/components', 'ComponentsController@index'];
$route[] = ['/component/create', 'ComponentsController@create','auth'];
$route[] = ['/component/store', 'ComponentsController@store','auth'];
$route[] = ['/component/{id}/show', 'ComponentsController@show'];
$route[] = ['/component/{id}/edit', 'ComponentsController@edit','auth'];
$route[] = ['/component/{id}/update', 'ComponentsController@update','auth'];
$route[] = ['/component/{id}/delete', 'ComponentsController@delete','auth'];

$route[] = ['/exams', 'ExamsController@index'];
$route[] = ['/exam/create', 'ExamsController@create','create'];
$route[] = ['/exam/store', 'ExamsController@store','create'];
$route[] = ['/exam/{id}/show', 'ExamsController@show'];
$route[] = ['/exam/{id}/edit', 'ExamsController@edit'];
$route[] = ['/exam/{id}/update', 'ExamsController@update'];
$route[] = ['/exam/{id}/delete', 'ExamsController@delete','auth'];

$route[] = ['/courses', 'CoursesController@index'];
$route[] = ['/course/create', 'CoursesController@create','auth'];
$route[] = ['/course/store', 'CoursesController@store','auth'];
$route[] = ['/course/{id}/show', 'CoursesController@show'];
$route[] = ['/course/{id}/edit', 'CoursesController@edit','auth'];
$route[] = ['/course/{id}/update', 'CoursesController@update','auth'];
$route[] = ['/course/{id}/delete', 'CoursesController@delete','auth'];

$route[] = ['/areas', 'AreasController@index'];
$route[] = ['/area/create', 'AreasController@create','auth'];
$route[] = ['/area/store', 'AreasController@store','auth'];
$route[] = ['/area/{id}/show', 'AreasController@show'];
$route[] = ['/area/{id}/edit', 'AreasController@edit','auth'];
$route[] = ['/area/{id}/update', 'AreasController@update','auth'];
$route[] = ['/area/{id}/delete', 'AreasController@delete','auth'];

$route[] = ['/users', 'UsersController@index'];
$route[] = ['/user/{id}/show', 'UsersController@show'];
$route[] = ['/user/create', 'UsersController@create',];
$route[] = ['/user/store', 'UsersController@store'];
$route[] = ['/user/{id}/edit', 'UsersController@edit'];
$route[] = ['/user/{id}/update', 'UsersController@update'];
$route[] = ['/user/{id}/delete', 'UsersController@delete'];

$route[] = ['/auth', 'UsersController@auth'];
$route[] = ['/logout', 'UsersController@logout'];

$route[] = ['/validation/{token}', 'UsersController@validate'];


return $route;
