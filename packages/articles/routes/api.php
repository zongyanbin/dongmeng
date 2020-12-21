<?php
$api = app(\Dingo\Api\Routing\Router::class);
$api->version('v1', function ($api) {
    //$api->post('/backend/article', '\Addons\Articles\Http\Api\Controllers\CategoryController@store');
$api->post('/backend/category',[ 'uses'=> '\Addons\Articles\Http\Api\Controllers\CategoryController@store']);
$api->delete('/backend/category/{category}',[ 'uses'=> '\Addons\Articles\Http\Api\Controllers\CategoryController@destroy']);
$api->put('/backend/category/{category}',['uses'=>'\Addons\Articles\Http\Api\Controllers\CategoryController@update']);
$api->get('/backend/category',['uses'=>'\Addons\Articles\Http\Api\Controllers\CategoryController@index']);
$api->get('/backend/category/{category}',[ 'uses'=> '\Addons\Articles\Http\Api\Controllers\CategoryController@show']);

$api->post('/backend/article',[ 'uses'=> '\Addons\Articles\Http\Api\Controllers\ArticleController@store']);
$api->delete('/backend/article/{article}',[ 'uses'=> '\Addons\Articles\Http\Api\Controllers\ArticleController@destroy']);
$api->put('/backend/article/{article}',['uses'=>'\Addons\Articles\Http\Api\Controllers\ArticleController@update']);
$api->get('/backend/article',['uses'=>'\Addons\Articles\Http\Api\Controllers\ArticleController@index']);
$api->get('/backend/article/{article}',[ 'uses'=> '\Addons\Articles\Http\Api\Controllers\ArticleController@show']);
});
          
      
    

?>