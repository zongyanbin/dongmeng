<?php
//用户添加
$api = app(\Dingo\Api\Routing\Router::class);
$api->version('v1', function ($api) {
    $api->post('login', '\Rbac\Permission\Http\Api\Controllers\AuthController@login');
    $api->get('menus/node', '\Rbac\Permission\Http\Api\Controllers\AdminMenuController@nodes');
    $api->group(['middleware' => 'jwt.auth'], function ($api) {

        //权限相关
        $api->post('permissions', [
            'uses' => '\Rbac\Permission\Http\Api\Controllers\AdminPermissionController@store',
            'middleware' => ['rbac.auth:can,permission.store']
        ]);

        $api->delete('permissions/{permission}', [
            'uses' => '\Rbac\Permission\Http\Api\Controllers\AdminPermissionController@destroy',
            'middleware' => ['rbac.auth:can,permission.destroy']
        ]);
        $api->put('permissions/{permission}', [
            'uses' => '\Rbac\Permission\Http\Api\Controllers\AdminPermissionController@update',
            'middleware' => ['rbac.auth:can,permission.update']
        ]);

        $api->get('permissions', [
            'uses' => '\Rbac\Permission\Http\Api\Controllers\AdminPermissionController@index',
            'middleware' => ['rbac.auth:can,permission.index']
        ]);

        $api->get('permissions/{permission}', [
            'uses' => '\Rbac\Permission\Http\Api\Controllers\AdminPermissionController@show',
            'middleware' => ['rbac.auth:can,permission.show']
        ]);

        //用户相关
        $api->post('users', [
            'uses' => '\Rbac\Permission\Http\Api\Controllers\AdminUserController@store',
            'middleware' => ['rbac.auth:can,user.store']
        ]);

        $api->delete('users/{user}', [
            'uses' => '\Rbac\Permission\Http\Api\Controllers\AdminUserController@destroy',
            'middleware' => ['rbac.auth:can,user.destroy']
        ]);
        $api->put('users/{user}', [
            'uses' => '\Rbac\Permission\Http\Api\Controllers\AdminUserController@update',
            'middleware' => ['rbac.auth:can,user.update']
        ]);

        $api->get('users/{user}', [
            'uses' => '\Rbac\Permission\Http\Api\Controllers\AdminUserController@show',
            'middleware' => ['rbac.auth:can,user.show']
        ]);

        $api->get('users', [
            'uses' => '\Rbac\Permission\Http\Api\Controllers\AdminUserController@index',
            'middleware' => ['rbac.auth:can,user.index']
        ]);


        //菜单相关
        $api->post('menus', [
            'uses' => '\Rbac\Permission\Http\Api\Controllers\AdminMenuController@store',
            'middleware' => ['rbac.auth:can,menu.store']
        ]);

        $api->delete('menus/{menu}', [
            'uses' => '\Rbac\Permission\Http\Api\Controllers\AdminMenuController@destroy',
            'middleware' => ['rbac.auth:can,menu.destroy']
        ]);
        $api->put('menus/{menu}', [
            'uses' => '\Rbac\Permission\Http\Api\Controllers\AdminMenuController@update',
            'middleware' => ['rbac.auth:can,menu.update']
        ]);

        $api->get('menus', [
            'uses' => '\Rbac\Permission\Http\Api\Controllers\AdminMenuController@index',
            'middleware' => ['rbac.auth:can,menu.index']
        ]);

        $api->get('menus/{menu}', [
            'uses' => '\Rbac\Permission\Http\Api\Controllers\AdminMenuController@show',
            'middleware' => ['rbac.auth:can,menu.show']
        ]);

        //角色相关
        $api->post('roles', [
            'uses' => '\Rbac\Permission\Http\Api\Controllers\AdminRoleController@store',
            'middleware' => ['rbac.auth:can,role.store']
        ]);

        $api->delete('roles/{role}', [
            'uses' => '\Rbac\Permission\Http\Api\Controllers\AdminRoleController@destroy',
            'middleware' => ['rbac.auth:can,role.destroy']
        ]);
        $api->put('roles/{role}', [
            'uses' => '\Rbac\Permission\Http\Api\Controllers\AdminRoleController@update',
            'middleware' => ['rbac.auth:can,role.update']
        ]);

        $api->get('roles', [
            'uses' => '\Rbac\Permission\Http\Api\Controllers\AdminRoleController@index',
            'middleware' => ['rbac.auth:can,role.index']
        ]);

        $api->get('roles/{role}', [
            'uses' => '\Rbac\Permission\Http\Api\Controllers\AdminRoleController@show',
            'middleware' => ['rbac.auth:can,role.show']
        ]);

        $api->post('logout', '\Rbac\Permission\Http\Api\Controllers\AuthController@logout');
        $api->get('user-info', '\Rbac\Permission\Http\Api\Controllers\AuthController@getUserInfo');
    });
});

?>