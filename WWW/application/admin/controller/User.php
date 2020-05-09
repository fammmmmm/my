<?php
namespace app\admin\controller;
use think\Session;
session_start();
header("Content-Type:text/html; charset=utf-8");
class User extends Common
{

    public function updhanddle(){
        //用户修改提交的方法
        $post = request()->post();
        //dump($post);die;  
        $a=db('user')->where('user_account',$post['user_account'])->find();
        if( $a == NULL){
        	$this->error('用户并不存在','login/login');
        }
        //dump($post);die;
        $admin_update_result = db('user')->where('user_account',$post['user_account'] )->update($post);
        if($admin_update_result == NULL)
            $this->error('用户账户更新失败','user/index');
        else 
            $this->success('用户账户更新成功','user/index');
        
    }
    public function index()
    {
    	$id = Session::get('admin_id');
    	$user = db('user')->where('user_account',$id)->find();
    	//dump($user);die;
    	$str=json_encode($user);
    	$this->assign('str',$str);
    	$this->assign('user',$user);
        return view();
    }
    public function wages()
    {
    	$id = Session::get('admin_id');
    	$user = db('user')->where('user_account',$id)->find();
    	//dump($user);die;
    	$str=json_encode($user);
    	$this->assign('str',$str);
    	$this->assign('user',$user);
        return view();
    }
}
