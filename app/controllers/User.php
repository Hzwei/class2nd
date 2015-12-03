<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// 用户模块
class User extends CI_Controller{

	// ajax login
	public function login(){
		// 获取post
		$email = $this->input->post('email');
		$pwd = $this->input->post('password');
		$autoin = $this->input->post('autoin');

		$res = array();

		// 验证登录
		$this->load->model('User_model');
		$userInfo = $this->User_model->login($email,$pwd);
		if($userInfo){
			// 登录成功
			$res['status'] = "success";
			$res['info'] = $userInfo[0];

			$_SESSION['uid'] = $userInfo[0]['id'];
			$_SESSION['username'] = $userInfo[0]['username'];
			$_SESSION['uemail'] = $userInfo[0]['email'];

			if($autoin == 1){
				// 保存5天
				$lifeTime = 5 * 24 * 3600;
				setcookie(session_name(), session_id(), time() + $lifeTime,'/');
			}
		}
		else{
			$res['status'] = "false";
		}

		echo json_encode($res);

	}

	// ajax logout
	public function logout(){

		if (isset($_SESSION['uid'])){
			
			// 释放$_SESSION变量
			session_unset();
			
			// 清cookie
			setcookie(session_name(), session_id(), time()-3600,'/');

			// 删除服务器端session id对应的文件数据
			session_destroy();

			if (isset($_SESSION['username'])){
				echo 0;
			}
			else{
				echo 1;
			}
		}

	}

	// ajax 邮件发送函数
	public function sendEmail(){
		$email = $this->input->post('email');
		$patt = '/^(\w)+(\.\w+)*@(\w)+((\.\w+)+)$/';
		
		$data = array();

		// 后端正则
		if (!preg_match($patt,$email)){
			$data['status'] = 'false';
			$data['message'] = '邮箱格式不正确!';
		}
		else{
			// 发送email wait for edit
			$data['status'] = 'success';
			
		}

		echo json_encode($data);
	}

	// ajax 注册函数
	public function register(){
		echo 1;
	}


}