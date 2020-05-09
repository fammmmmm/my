<?php  
namespace app\admin\model;
/**
* 
*/
class Goods extends \think\Model
{	
	protected $resultSetType = 'collection';
	public function keywords(){
		return $this->belongsToMany('Keywords','goods_keywords');
	}
	public function cate(){
		//房间和分类的多对一关系
		return $this->belongsTo('Cate','goods_pid');
	}
	public function base(){
		//房间和分类的多对一关系
		return $this->belongsTo('Base','goods_bid');
	}
	public function img(){
		//房间的细节图的一对多关系
		return $this->hasMany('Img');
	}

	public function goodsproperty(){
		//房间的细节图的一对多关系
		return $this->hasMany('Goodsproperty');
	}

	public function ordergoods()
	/*房间细节和订单房间的一对多关系*/
	{
		return $this->hasMany('app\user\model\Ordergoods');
	}

	public function evaluate()
	/*房间和房间评论的一对多关系*/
	{
		return $this->hasMany('app\user\model\Evaluate');
	}
    public function shopcart()
	/*房间和房间评论的一对多关系*/
	{
		return $this->hasOne('app\user\model\shopcart');
	}
	public function fuseer($user_id)
	{
		return $this->where('user_id',$user_id);
	}

	
}
?>