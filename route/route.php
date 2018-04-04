<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('admin/login','admin/login/index'); //登录页面
Route::post('admin/login','admin/login/loginup');//登陆提交

Route::get('admin/aboutme','admin/index/aboutme');//关于小编
Route::post('admin/aboutme','admin/index/aboutmeup');//关于小编

Route::get('admin/notice','admin/index/notice');//添加公告
Route::post('admin/notice','admin/index/noticeup');//添加公告提交

Route::get('admin/articlelist','admin/index/articlelist');//文章列表页
Route::get('admin/article/add','admin/index/articleadd');//添加文章
Route::post('admin/article/add','admin/index/articleaddup');//添加文章提交

Route::get('admin/article/update/:id','admin/index/articleupdate');//修改文章
Route::post('admin/article/update/:id','admin/index/articleupdateup');//修改文章提交

Route::get('admin/article/delete/:id','admin/index/articledelete');//删除文章

Route::get('admin','admin/index/index');//后台首页

Route::get('/','index/index/index');
return [

];
