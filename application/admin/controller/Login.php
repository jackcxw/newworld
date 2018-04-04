<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Validate;
use think\U;
class Login extends Controller
{
    public function _initialize(){
        $uid = session('uid');
        if($uid != null){
            $this->rediect('admin','已登录');
        }
    }
    public function index()
    {
        return $this->fetch();
    }

    public function loginup()
    {
        $validate =  new Validate([
            'username'=>'require',
            'password'=>'require'
        ]);//验证是否为空

        $data = input('post.');//获取数据
        if ($validate->check($data)) {
           $user =  Db::table('tp_user')->where('username',$data['username'])->find();
           if(!$user) {
              return $this->error('用户不存在');
           }
            if($data['password']==$user['password']){
                 $this->success('登陆成功','/admin');
            }else{
              return $this->error('密码错误');
            }
        }else{
            dump($validate->getError());
        }





    }
}
