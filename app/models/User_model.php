<?php
/*
**	用户模型 
 */

class User_model extends CI_Model{
	
	// 登录验证
	public function login($email,$pwd){
		$sql = 'select id,username,email from swap_users where email=? and password=? and checkcode = 1 limit 1' ;
		return $this->db->query($sql,array($email,md5($pwd)))->result_array();
	}


}