<?php
/*
**	课程模型 
 */

class Course_model extends CI_Model{
	
	/* 获取所以类别 */ 
	public function getCategory(){
		return $this->db->query('select * from swap_category')->result_array();
	}


}