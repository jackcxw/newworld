<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\facade\Request;
use think\Validate;
class Index extends Controller
{
    public function index()
    {
     return $this->fetch();
    }
    //关于小编
    public function aboutme()
    {
        $user = Db::table('tp_user')->where('id',1)->find();
        $this->assign('user',$user);
        return $this->fetch();
    }

    public function aboutmeup()
    {
        $validate = new Validate([
            'truename' => 'require|max:25',
            'age' => 'require',
            'email' => 'require|email',
            'say' => 'require|max:500',
        ]);
        $data = input('post.');
        if (!$validate->check($data)) {
            echo $validate->getError();
        }else{
            $arr =[];
            $arr['truename'] = $data['truename'];
            $arr['age'] = $data['age'];
            $arr['email'] = $data['email'];
            $arr['say'] = $data['say'];
            $user = Db::table('tp_user')->where('id',1) ->data($arr)->update();
            if(!$user){
                return $this->error('服务器内部错误');
            }else{
              return $this->success('成功','/admin/aboutme');
            }


        }

    }

    //公告
    public function notice(){
        $notice = Db::table('tp_notice')->order('create_time','desc')->find();
        $this->assign('notice',$notice);
        return $this->fetch();
    }

    public function noticeup(){
       $validate =  new Validate([
           'title'=>'require',
           'content'=>'require'
       ]);
        $data = input('post.');
        if(!$validate->check($data)){
            echo $validate->getError();
        }else{
            $arr = [
              'title'=>$data['title'],
                'content'=>$data['content'],
                'create_time'=>time()
            ];
           $notice =  Db::table('tp_notice')->data($arr)->insert();
            if(!$notice){
                return $this->error('插入公告出错！');
            }else{
                return $this->success('添加公告成功','/admin/notice');
            }
        }

    }

    //文章列表
    public function articlelist(){
        $article = Db::table('tp_article')->where('delete_time',0)->order('create_time','desc')->paginate(10);
        $this->assign('article',$article);
      return  $this->fetch();
    }
    //文章添加
    public function articleadd(){
        return $this->fetch();
    }

    public function articleaddup(){
       $validate = new Validate([
           'title'=>'require',
           'keywords'=>'require',
           'author'=>'require',
           'editorValue'=>'require'
       ]);
        $data = input('post.');
        if($validate->check($data)){
            $arr = [
                'title'=>$data['title'],
                'keywords'=>$data['keywords'],
                'author'=>$data['author'],
                'content'=>$data['editorValue'],
                'create_time'=>time()
            ];
            $article = Db::table('tp_article')->data($arr)->insert();
            if($article)
            {
                return $this->success('新增文章成功','/admin/articlelist');
            }else{
                return $this->error('插入数据库出错');
            }
        }else{
            dump($validate->getError());
        }
    }

    //文章删除

    public function articledelete($id)
    {
      $article =  Db::table('tp_article')->where('id',$id)->data('delete_time',time())->update();
        if($article){
            return $this->success('删除成功','/admin/articlelist');
        }else{
            return $this->error('删除失败');
        }
    }

    //文章修改
   public function articleupdate($id)
   {
       $article = Db::table('tp_article')->where('id',$id)->find();
       $this->assign('article',$article);
       return $this->fetch();
   }
    public function articleupdateup($id)
    {
        $thisarticle = Db::table('tp_article')->where('id',$id)->find();
        if(!$thisarticle){
            return $this->error('该文章不存在');
        }
        $data = input('post.');
        $arr = [];
        $arr['title'] = $data['title']?$data['title']:$thisarticle['title'];
        $arr['keywords'] = $data['keywords']?$data['keywords']:$thisarticle['keywords'];
        $arr['author'] = $data['author']?$data['author']:$thisarticle['author'];
        $arr['content'] = $data['editorValue']?$data['editorValue']:$thisarticle['content'];
        $arr['update_time'] = time();
        $article = Db::table('tp_article')->where('id',$id)->data($arr)->update();
        if($article){
            return $this->success('修改成功','/admin/articlelist');
        }else{
            return $this->error('修改失败');
        }
    }

}
