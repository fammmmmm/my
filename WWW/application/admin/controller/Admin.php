<?php  
namespace app\admin\controller;
/**
* 用户控制器
*/
header("Content-Type:text/html; charset=utf-8");
class Admin extends Common
{
	public function adminlist(){
		//显示用户列表
		$user = db('user')->select();
		//dump($user);die;
		$this->assign('user',$user);
		return view();
	}
	public function add(){
		//用户添加的方法		
		return view();
	}

	public function addhanddle(){
		//添加用户提交的方法      
		$post = request()->post();
		//dump($post);die;
		unset($post['admin_password1']);
		$post['admin_password'] = md5($post['admin_password']);
		$post['admin_thumb']=session('admin_thumb')?:"";
		$post['admin_reg']=date("Y-m-d");
		$ad = db('user')->data(['user_account'=>$post['admin_name'],
								'user_password'=>$post['admin_password'],
								'user_name'=>$post['admin_rname'],
								'user_sex'=>$post['admin_sex'],
								'user_brith'=>$post['admin_brith'],
								'user_education'=>$post['user_education'],
								'user_native'=>$post['admin_native'],
								'user_address'=>$post['admin_address'],
								'user_phone'=>$post['admin_phone'],
								'user_seniority'=>$post['admin_seniority'],
								'user_wages'=>$post['admin_wage'],
								'user_manager'=>1])
    		->insert();
		if ($ad) {
			session('admin_thumb',null);
			$this->success('管理添加成功');
		}
		else{
			session('admin_thumb',null);
			$this->error('管理添加失败');
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

	public function appoint($user_id=''){
		//任命管理员
		$admin_find = db('user')->find($user_id);
		if (empty($admin_find)) {
			$this->redirect('admin/adminlist');
		}
		$ad = db('user')->where('user_Id',$user_id)->update(['user_manager' => 1]);
		if ($ad) {
			$this->success('成功任命管理员','admin/adminlist');
		}
		else{
			$this->error('该用户已为管理员','admin/adminlist');
		}
	}
	public function leave($user_id=''){
		//任命管理员
		$admin_find = db('user')->find($user_id);
		if (empty($admin_find)) {
			$this->redirect('admin/adminlist');
		}
		$ad = db('user')->where('user_Id',$user_id)->update(['user_manager' => 0]);
		if ($ad) {
			$this->success('成功卸任管理员','admin/adminlist');
		}
		else{
			$this->error('该用户本不为管理员','admin/adminlist');
		}
	}
	public function del($user_id=''){
		//删除用户的方法
		$admin_find = db('user')->find($user_id);
		if (empty($admin_find)) {
			$this->redirect('admin/adminlist');
		}
		$ad = db('user')->delete($user_id);
		if ($ad) {
			$this->success('用户删除成功','admin/adminlist');
		}
		else{
			$this->error('用户删除失败','admin/adminlist');
		}
	}
}
?>