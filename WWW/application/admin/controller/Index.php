<?php
namespace app\admin\controller;
use think\Session;
session_start();
header("Content-Type:text/html; charset=utf-8");
class Index extends Common
{

    public function index()
    {
    	//dump(Session::get('Authority'));die;
        return view();
    }
    public function chart(){
    	$user = db('user')->select();
    	$people = count($user);
    	$xueli = db('user')->where('user_education','<>',1)->select();
    	$xueli1 = count($xueli);
    	$gongling = db('user')->where('user_seniority','>',4)->select();
    	$gongling1 = count($gongling);
    	$gongzi = db('user')->where('user_wages','>',10000)->select();
    	$gongzi1 = count($gongzi);
		$str=json_encode($user);
		$this->assign('xueli',$xueli1);
		$this->assign('gongzi',$gongzi1);
		$this->assign('gongling',$gongling1);
		$this->assign('people',$people);
		$this->assign('str',$str);
    	return view();
    }

}
