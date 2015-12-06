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
		$this->load->model('user_model');
		$userInfo = $this->user_model->login($email,$pwd);
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

	// forget
	public function forget(){
		$email = $this->input->post('email');

		/* 引入扩展函数文件 */
		$this->load->helper('my_check');

		// 后端正则
		if (!myCheckEmail($email)){
			return '邮箱格式不正确!';
		}
		else{

			// 生成验证码
			$code = rand(10000000,99999999);

			$this->load->library('email');            //加载CI的email类  
	        $this->email->from('hpf@betahouse.us', '转课网');	//	发件人
	        $this->email->to($email);							// 目的邮箱
	        $this->email->subject('转课网验证码');			// 邮件标题
	        $this->email->message('您好，您的转课网新密码为'.$code.",请登录后及时修改！");	// 邮件内容
	  
	        if ($this->email->send(FALSE)){

	        	// 插入记录
	        	$this->load->model('user_model');
	        	if ($this->user_model->saveEmailCode($email,$code)){
	        		// 更新密码
	        		if ($this->user_model->resetPwd($email,$code)){
	        			echo 'success';	
	        		}
	        		else{
	        			echo '密码修改失败';
	        		}
	        	}
	        	else{	        		
	        		echo '邮件记录失败，请重试';
	        	}
	        }
	        else{
	        	echo '邮件发送失败，请重试';
	        }

	  		//返回包含邮件内容的字符串，包括EMAIL头和EMAIL正文。用于调试。 
	        // echo $this->email->print_debugger();
		}

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
		$data = array();

		/* 引入扩展函数文件 */
		$this->load->helper('my_check');

		// 后端正则
		if (!myCheckEmail($email)){
			$data['status'] = 'false';
			$data['message'] = '邮箱格式不正确!';
		}
		else{

			// 生成验证码
			$code = rand(100000,999999);

			$this->load->library('email');            //加载CI的email类  
	        $this->email->from('hpf@betahouse.us', '转课网');	//	发件人
	        $this->email->to($email);							// 目的邮箱
	        $this->email->subject('转课网验证码');			// 邮件标题
	        $this->email->message('您好，您的转课网验证码为'.$code);	// 邮件内容
	  
	        if ($this->email->send(FALSE)){

	        	// 插入记录
	        	$this->load->model('user_model');
	        	if ($this->user_model->saveEmailCode($email,$code)){
	        		$data['status'] = 'success';
	        	}
	        	else{
	        		$data['status'] = 'false';
	        		$data['message'] = '邮件记录失败，请重试';
	        	}
	        }
	        else{
	        	$data['status'] = 'false';
	        	$data['message'] = '邮件发送失败，请重试';
	        }

	  		//返回包含邮件内容的字符串，包括EMAIL头和EMAIL正文。用于调试。 
	        // echo $this->email->print_debugger();
		}

		echo json_encode($data);
	}

	// ajax 注册函数
	public function register(){
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$code = $this->input->post('code');

		$data = array();

		$this->load->model('user_model');

		$return = $this->user_model->reg($email,$password,$code);
		if ($return == 1){
			$data['status'] = 'success';
		}
		else{
			$data['status'] = 'false' ;
			$data['message'] = $return ;
		}

		echo json_encode($data);

	}



}