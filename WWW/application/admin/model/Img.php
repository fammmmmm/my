<?php  
namespace app\admin\model;
/**
* 房间细节图的模型
*/
class Img extends \think\Model
{
	protected $resultSetType = 'collection';
	public function goods(){
		return $this->belongsTo('Goods');
	}
}
?>