<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
class Index extends Controller
{
    public function index()
    {
       $user =  Db::table('tp_user')->where('id',1)->find();
        $this->assign(['user'=>$user]);
        return $this->fetch();
    }

}
