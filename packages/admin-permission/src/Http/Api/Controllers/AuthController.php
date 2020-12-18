<?php
namespace Rbac\Permission\Http\Api\Controllers;

use Illuminate\Http\Request;
use Rbac\Permission\Http\Api\Base\Controller;    
use Rbac\Permission\Transformers\AdminUserTransformer;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);
        $credentials = $request->only('username', 'password');
        $token = $this->guard()->attempt($credentials); //返回token 守卫者里的attempt方法
        if ($token) {
            return $this->respondWithToken($token);
        }
        return $this->response->error('unauthorized', 401);
    }


    protected function respondWithToken($token)
    {
        return $this->response->array([
            'token' => $token,
            'token_type' => 'bearer',
            'expire_in' => $this->guard()->factory()->getTTl() * 60
        ]);
    }

    public function getUserInfo()
    {
        return $this->response->item($this->guard()->user(), new AdminUserTransformer());
    }

    public function logout()
    {
        $this->guard()->logout();
    }


    protected function guard()
    {
        return \Auth::guard();
    }


}
?>