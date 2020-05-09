<?php  
namespace app\admin\controller;
use think\Session;
/**
* 
*/
header("Content-Type:text/html; charset=utf-8");
class Login extends \think\Controller
{
	
	public function login(){
		if (session('?admin_name')) {
			$this->error('您已经登录，请退出后再重新登录','goods/goodslist');
		}
		return view();
	}

	public function checklogin(){
		$post = request()->post();
		if (empty($post)) {
			$this->redirect('login/login');
		}
		if(!captcha_check($post['captcha'])){
			$this->error('验证码错误！','login/login');
		};

		$admin_find = db('user')->where('user_account','eq',$post['admin_name'])->find();
		//dump($admin_find);die;
		if (empty($admin_find)) {
			$this->error('该管理员不存在，请重新登录','login/login');
		}
		else{
			$admin_password = $admin_find['user_password'];
			if (md5($post['admin_password'])==$admin_password) {
				session('admin_id',$admin_find['user_account']);
				session('admin_name',$admin_find['user_name']);
				session('Authority',$admin_find['user_manager']);
				$this->success('登陆成功','index/index');
			}
			else{
				$this->error('管理员密码错误，请重新登录','login/login');
			}
		}
		
	}
	public function logout(){
		session('admin_name',null);
		session('admin_id',null);
		$this->redirect('login/login');
	}
}
?>