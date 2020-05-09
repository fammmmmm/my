<?php  
namespace app\admin\controller;
/**
* 用户控制器
*/
header("Content-Type:text/html; charset=utf-8");
class Manager extends Common
{
	public function adminlist(){
		$user = db('user')->where('user_manager',0)->select();
		$this->assign('user',$user);
		return view();
	}
	public function add(){
		return view();
	}
	public function addhanddle(){
		//添加用户提交的方法      
		$post = request()->post();
		//dump($post);die;
		unset($post['user_password1']);
		$post['user_password'] = md5($post['user_password']);
		$post['user_thumb']=session('admin_thumb')?:"";
		$post['user_reg']=date("Y-m-d");
		//dump($manger);die;
		$ad = db('user')->data(['user_account'=>$post['user_name'],
								'user_password'=>$post['user_password'],
								'user_name'=>$post['user_rname'],
								'user_sex'=>$post['user_sex'],
								'user_brith'=>$post['user_brith'],
								'user_education'=>$post['user_education'],
								'user_native'=>$post['user_native'],
								'user_address'=>$post['user_address'],
								'user_phone'=>$post['user_phone'],
								'user_seniority'=>$post['user_seniority'],
								'user_wages'=>$post['user_wage']])
    		->insert();
		if ($ad) {
			session('admin_thumb',null);
			$this->success('用户添加成功');
		}
		else{
			session('admin_thumb',null);
			$this->error('用户添加失败');
		}
	}
	public function checkadminname1(){ 
		//验证用户名称是否可用
		if (request()->isAjax()) {
			$post = request()->post();
			$admin_name = $post['param'];
			$admin_name_find_result = db('admin')->where('admin_name','eq',$admin_name)->find();
			if (!$admin_name_find_result) {
				return array(
					'status' => 'y',
					'info'	=>	'用户'.$admin_name.'可以使用',
				);
			}
			else{
				return array(
					'status' => 'n',
					'info'	=>	'用户'.$admin_name.'已经存在',
				);
			}
		}
	}

	public function checkadminname(){
		//添加用户时的Ajax验证用户名称
		if (request()->isAjax()) {
			$post = request()->post();
			$admin_name['admin_name'] = $post['param'];
			
			$validate = validate('admin');
			if ($validate->scene('admin_name')->check($admin_name['admin_name'])) {
				return array('status'=>'y','info'=>'用户名称可以使用');
			}
			else{
				return array('status'=>'n','info'=>$validate->getError());
			}
		}
	}

	public function checkupdadminname(){
		//修改用户时的Ajax验证用户名称
		if (request()->isAjax()) {
			$post = request()->post();
			$admin['admin_id'] = $post['name'];
			$admin['admin_name'] = $post['param'];
			$validate = validate('admin');
			if ($validate->scene('admin_name')->check($admin)) {
				return array('status'=>'y','info'=>'用户名称可以使用');
			}
			else{
				return array('status'=>'n','info'=>$validate->getError());
			}
		}
	}


	public function upd($admin_id=''){
		//显示用户修改界面的方法
		$admin_find = db('admin')->find($admin_id);

		if ($admin_find=='') {
			$this->redirect('admin/adminlist');
		}
		$this->assign('admin_find',$admin_find);
		// dump($admin_find);die;
		return view();
	}

	public function updhanddle(){
		//用户修改提交的方法
		$post = request()->post();
		$validate = validate('admin');
		$a=db('admin')->find($post['admin_id']);
		$img1=$a['admin_thumb'];
		if (session('admin_thumb')!=null) {
			//图片进行过替换的情况
			$post['admin_thumb'] = session('admin_thumb');
			$url_pre = DS.'public';
			$url = str_replace($url_pre,'.',$img1);
			if (file_exists($url)) {
				unlink($url);
			}

		}
		else{
			$post['admin_thumb'] = $img1;
		}
		if ($validate->check($post)) {
			unset($post['admin_password1']);
			if($post['admin_password']!="xxxxxxxx")
			$post['admin_password'] = md5($post['admin_password']);
		else
			unset($post['admin_password']);
			$admin_update_result = db('admin')->update($post);
			if ($admin_update_result!==false) {
				session('admin_thumb',null);
				if(session('admin_id')==15)
				$this->success('用户账户更新成功','admin/adminlist');
			else
				$this->success('用户账户更新成功','index/index');
			}
			else{
				if(session('admin_id')==15)
				$this->error('用户账户更新失败','admin/adminlist');
			else
				$this->error('用户账户更新失败','index/index');
			}
		}
		else{
			$this->error($validate->getError());
		}
	}
	public function del($admin_id=''){
		//删除用户的方法
		$admin_find = db('admin')->find($admin_id);
		if (empty($admin_find)) {
			$this->redirect('admin/adminlist');
		}
		if ($admin_find['admin_thumb']){
				$url_pre = DS.'public';
				$url = str_replace($url_pre,'.',$admin_find['admin_thumb']);
				if (file_exists($url)) {
					unlink($url);
				}
			}
		$ad = db('admin')->delete($admin_id);
		if ($ad) {
			$this->success('用户删除成功','admin/adminlist');
		}
		else{
			$this->error('用户删除失败','admin/adminlist');
		}
	}
}
?>