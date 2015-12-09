<?php
/*
**	用户模型 
 */

class User_model extends CI_Model{
	
	// 登录验证
	public function login($email,$pwd){
		$sql = 'select id,username,email from swap_users where email=? and password=? limit 1' ;
		return $this->db->query($sql,array($email,md5($pwd)))->result_array();
	}

	// 保存邮件验证码
	public function saveEmailCode($email,$code){
		$select = 'select id from swap_checkcode where email=? limit 1';
		$res = $this->db->query($select,array($email))->row_array();

		// 为空插入
		if (empty($res)){
			$sql = 'insert into swap_checkcode values(null,?,?)';
			return $this->db->query($sql,array($email,$code));
		}
		// 不为空更新
		else{
			$sql = 'update swap_checkcode set code=? where id =?';
			return $this->db->query($sql,array($code,$res['id']));
		}

	}

	// 注册函数
	public function reg($email,$password,$code){

		// 检测账号存在情况
		$sql = 'select count(*) from swap_users where email=? limit 1';
		$res = $this->db->query($sql,array($email))->row_array();

		if ($res['count(*)']){
			return '账号已存在';
		}
		else{
			// 验证验证码
			$sqlCode = 'select count(*) from swap_checkcode where email=? and code=? limit 1';
			$resCode = $this->db->query($sqlCode,array($email,$code))->row_array();
			if ($resCode['count(*)']){
				// 插入数据库
				$sqlInsert = 'insert into swap_users values(null,?,?,?)';
				if($this->db->query($sqlInsert,array('zkw'.$code,$email,md5($password)))){
					return 1;
				}
				else{
					return '用户新增失败';
				}
			}
			else{
				return '验证码错误';
			}

		}

	}

	// 重置密码 (邮箱)
	public function resetPwd($email,$pwd){
		$sql = 'update swap_users set password = ? where email = ?';
		return $this->db->query($sql,array(md5($pwd),$email));
	}

	// 重置密码 (id)
	public function changePwd($pwd){
		$sql = 'update swap_users set password = ? where id = ?';
		return $this->db->query($sql,array(md5($pwd),$_SESSION['uid']));
	}

	// 获取用户信息
	public function getrUserInfo($uid){
		$sql = 'select id,username,email from swap_users where id =? limit 1';
		return $this->db->query($sql,array($uid));
	}
	
}