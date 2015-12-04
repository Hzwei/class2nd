<?php
/*
**	课程模型 
 */

class Course_model extends CI_Model{
	
	/* 获取所以类别 */ 
	public function getCategory(){
		return $this->db->query('select * from swap_category')->result_array();
	}

	/* 获取课程列表 */
	public function getCourseList($cateId,$order,$start=0,$num=4){
		// 构造查询语句
		$sql = 'select * from swap_course where ';
		
		// 类别
		if ($cateId == 0){
			$sql .= ' cid>0 ';
		}
		else{
			$sql .= ' cid = ? ';
		}

		// 排序
		switch ($order){
			case 'hot':
				$sql.=' order by join_num desc ';
				break;
			case 'top':
				$sql.=' order by score/score_num desc ';
				break;
			case 'new':
				$sql.=' order by time desc ';
				break;
			default:
				break;
		}

		$sql.=' limit '.$start.','.$num;

		return $this->db->query($sql,array($cateId))->result_array();

	}


}