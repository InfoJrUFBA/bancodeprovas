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

return $route;
