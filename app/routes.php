<?php

$route[] = ['/', 'HomeController@index'];
$route[] = ['/posts', 'PostsController@index'];
$route[] = ['/post/{id}/show', 'PostsController@show'];

$route[] = ['/components', 'ComponentController@index'];
$route[] = ['/component/create', 'ComponentController@create'];
$route[] = ['/component/store', 'ComponentController@store'];
$route[] = ['/component/{id}/show', 'ComponentController@show'];
$route[] = ['/component/{id}/edit', 'ComponentController@edit'];
$route[] = ['/component/{id}/update', 'ComponentController@update'];
$route[] = ['/component/{id}/delete', 'ComponentController@delete'];

return $route;
