<?php 
namespace app\admin\model;
/**
 * 房间分类模型
 */
 class Admin extends \think\Model
 {
 	public function base(){
 		//分类和房间的一对多关系
 		return $this->hasMany('Base');
 	}
 	public function evaluate(){
 		//分类和房间的一对多关系
 		return $this->hasMany('app\user\model\Evaluate')->where('eva_status',"2")->where('eva_reply',null)->order('eva_time desc');
 	}
 	public function evaluate1(){
 		//分类和房间的一对多关系
 		return $this->hasMany('app\user\model\Evaluate')->where('eva_status',"-1")->where('eva_reply',null)->order('eva_time desc');
 	}
 } 
?>