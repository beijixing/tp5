<?php
namespace app\admin\controller;
use \think\Controller;
use app\admin\model\User;
use think\Request;
use think\Session;

class LoginController extends Controller
{
   public function index() {
       return $this->fetch();
   }

   public function login(Request $request) {
       $username = $request->param('username');
       $password = $request->param('password');
       $remember = $request->param('remember');
       $pos = strpos($username, '@');
       $user = "";
       if ($pos != 0 ){
           //邮箱登录用户
           $user = User::getByEmail($username);
       }else{
           //手机号登录用户
           $user = User::getByPhone($username);
       }

      if (empty($user) ){
          $this->error('用户不存在');
      }else if ($user->password == $password) {
          //登录成功
          if ($remember == 1) {
              //记住密码
          }

          Session::set('username', $username);
          $this->redirect(url('admin/index/index'));
      }else{
          //登录失败
          $this->error('用户名或密码错误');
      }
   }
}