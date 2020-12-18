<?php
use Illuminate\Contracts\Validation\ValidatesWhenResolved;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Redirector;

class AdminUserSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->boot();
        $roles = $this->createRoles($this->createPermissions());
        $this->createUsers($roles);
        $this->createMenus($roles);
    }

    protected function createPermissions()
    {
        //1.拿到请求数据
        $requestPayloads = $this->getPermissionRequestPayloads();

        //2.对请求数据进行处理
        return array_map(function ($item) {
            $this->prepareWith($item);
            //3.拿到权限服务进行保存
            $service = app()->make(\Rbac\Permission\Http\Api\Services\AdminPermission\AdminPermissionStoreService::class);
            $permission = $service->save();
            //4.拿到权限ID
            return $permission->id;
        }, $requestPayloads);

    }

    protected function createRoles($permissions = [])
    {
        $requestPayloads = $this->getRoleRequestPayloads();
        return array_map(function ($item) use ($permissions) {
            $item['permissions'] = $permissions;
            //解决reuqest
            $this->prepareWith($item);
            $service = app()->make(\Rbac\Permission\Http\Api\Services\AdminRole\AdminRoleStoreService::class);
            $role = $service->save();
            return $role->id;
        }, $requestPayloads);
    }

    protected function createUsers($roles = [])
    {
        $requestPayloads = $this->getUserRequestPayloads();
        array_map(function ($item) use ($roles) {
            $item['roleIds'] = $roles;
            $this->prepareWith($item);
            $service = app()->make(\Rbac\Permission\Http\Api\Services\AdminUser\AdminUserStoreService::class);
            $service->save();
        }, $requestPayloads);
    }

    protected function createMenus($roles = [], $parent_id = null, $requestPayloads = null)
    {
        $requestPayloads = $requestPayloads ?? $this->getMenuRequestPayloads();
        array_map(function ($item) use ($roles, $parent_id) {
            $item['roles'] = $roles;
            if ($parent_id) {
                $item['parent_id'] = $parent_id;
            }
            $children = null;
            if (isset($item['children'])) {
                $children = $item['children'];
                unset($item['children']);
            }
            $this->prepareWith($item);
            $service = app()->make(\Rbac\Permission\Http\Api\Services\AdminMenu\AdminMenuStoreService::class);
            $menu = $service->save();
            if ($children) {
                $this->createMenus($roles, $menu->id, $children);
            }
        }, $requestPayloads);
    }

    protected function boot()
    {
        app()->afterResolving(ValidatesWhenResolved::class, function ($resolved) {
            $resolved->validateResolved();
        });
    }

    protected function prepareWith($item)
    {
        app()->resolving(FormRequest::class, function ($request, $app) use ($item) {
            $request = FormRequest::createFrom($app['request'], $request);
            $request->initialize($item);
            $request->setContainer($app)->setRedirector($app->make(Redirector::class));
        });
    }

    protected function getUserRequestPayloads()
    {
        return $requestPayloads = [
            [
                'username' => 'admin',
                'password' => '123456',
                'name' => 'admin',
                'mobile' => '13800138000',
                'remark' => 'system init'
            ]
        ];
    }

    protected function getRoleRequestPayloads()
    {
        return $requestPayloads = [
            [
                'name' => '初始化管理员',
                'slug' => 'admin',
                'description' => 'system init'
            ]
        ];
    }

    //请求体
    protected function getPermissionRequestPayloads()
    {
        return $requestPayloads = [
            [
                'name' => '用户添加',
                'slug' => 'user.store',
                'description' => 'system init'
            ],
            [
                'name' => '用户删除',
                'slug' => 'user.destroy',
                'description' => 'system init'
            ],
            [
                'name' => '用户修改',
                'slug' => 'user.update',
                'description' => 'system init'
            ],
            [
                'name' => '用户详情',
                'slug' => 'user.show',
                'description' => 'system init'
            ],
            [
                'name' => '用户列表',
                'slug' => 'user.index',
                'description' => 'system init'
            ],


            [
                'name' => '角色添加',
                'slug' => 'role.store',
                'description' => 'system init'
            ],
            [
                'name' => '角色删除',
                'slug' => 'role.destroy',
                'description' => 'system init'
            ],
            [
                'name' => '角色修改',
                'slug' => 'role.update',
                'description' => 'system init'
            ],
            [
                'name' => '角色详情',
                'slug' => 'role.show',
                'description' => 'system init'
            ],
            [
                'name' => '角色列表',
                'slug' => 'role.index',
                'description' => 'system init'
            ],

            [
                'name' => '权限添加',
                'slug' => 'permission.store',
                'description' => 'system init'
            ],
            [
                'name' => '权限删除',
                'slug' => 'permission.destroy',
                'description' => 'system init'
            ],
            [
                'name' => '权限修改',
                'slug' => 'permission.update',
                'description' => 'system init'
            ],
            [
                'name' => '权限详情',
                'slug' => 'permission.show',
                'description' => 'system init'
            ],
            [
                'name' => '权限列表',
                'slug' => 'permission.index',
                'description' => 'system init'
            ],


            [
                'name' => '菜单添加',
                'slug' => 'menu.store',
                'description' => 'system init'
            ],
            [
                'name' => '菜单删除',
                'slug' => 'menu.destroy',
                'description' => 'system init'
            ],
            [
                'name' => '菜单修改',
                'slug' => 'menu.update',
                'description' => 'system init'
            ],
            [
                'name' => '菜单详情',
                'slug' => 'menu.show',
                'description' => 'system init'
            ],
            [
                'name' => '菜单列表',
                'slug' => 'menu.index',
                'description' => 'system init'
            ]
        ];
    }

    protected function getMenuRequestPayloads()
    {
        return $requestPayloads = [
            [
                'title' => '权限管理',
                'path' => '/permission',
                'children' => [
                    [
                        'title' => '用户管理',
                        'path' => 'users',
                    ],
                    [
                        'title' => '权限管理',
                        'path' => 'permission',
                    ],
                    [
                        'title' => '角色管理',
                        'path' => 'role',
                    ],
                    [
                        'title' => '菜单管理',
                        'path' => 'menus',
                    ]
                ]
            ]
        ];
    }
}
