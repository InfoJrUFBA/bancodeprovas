<?php

$route[] = ['/', 'HomeController@index'];
$route[] = ['/posts', 'PostsController@index'];
$route[] = ['/post/{id}/show', 'PostsController@show'];

$route[] = ['/components', 'ComponentsController@index'];
$route[] = ['/component/create', 'ComponentsController@create'];
$route[] = ['/component/store', 'ComponentsController@store'];
$route[] = ['/component/{id}/show', 'ComponentsController@show'];
$route[] = ['/component/{id}/edit', 'ComponentsController@edit'];
$route[] = ['/component/{id}/update', 'ComponentsController@update'];
$route[] = ['/component/{id}/delete', 'ComponentsController@delete'];

$route[] = ['/exams', 'ExamsController@index'];
$route[] = ['/exam/create', 'ExamsController@create'];
$route[] = ['/exam/store', 'ExamsController@store'];
$route[] = ['/exam/{id}/show', 'ExamsController@show'];
$route[] = ['/exam/{id}/edit', 'ExamsController@edit'];
$route[] = ['/exam/{id}/update', 'ExamsController@update'];
$route[] = ['/exam/{id}/delete', 'ExamsController@delete'];

$route[] = ['/courses', 'CoursesController@index'];
$route[] = ['/course/create', 'CoursesController@create'];
$route[] = ['/course/store', 'CoursesController@store'];
$route[] = ['/course/{id}/show', 'CoursesController@show'];
$route[] = ['/course/{id}/edit', 'CoursesController@edit'];
$route[] = ['/course/{id}/update', 'CoursesController@update'];
$route[] = ['/course/{id}/delete', 'CoursesController@delete'];

$route[] = ['/areas', 'AreasController@index'];
$route[] = ['/area/create', 'AreasController@create'];
$route[] = ['/area/store', 'AreasController@store'];
$route[] = ['/area/{id}/show', 'AreasController@show'];
$route[] = ['/area/{id}/edit', 'AreasController@edit'];
$route[] = ['/area/{id}/update', 'AreasController@update'];
$route[] = ['/area/{id}/delete', 'AreasController@delete'];

return $route;
