<?php 
namespace app\admin\model;
/**
 * 房间分类模型
 */
 class Base extends \think\Model
 {
 	public function goods(){
 		//分类和房间的一对多关系
 		return $this->hasMany('Goods');
 	}
    public function admin()
    {
    	return $this->belongsTo('Admin','base_aid');
    }
 } 
?>