<?php  
namespace app\admin\model;
/**
* 
*/
class Project extends \think\Model
{
     public function getchild($pro,$proid){
        static $arr=array();
        foreach ($pro as $k => $v) {
            if($v['pro_pid'] == $proid){
                $arr[]=$v;
                $this->getchild($pro,$v['pro_id']);
            }
        }
        return $arr;
    }
}
?>