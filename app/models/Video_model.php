<?php
/*
**	视频模型 
*/

class Video_model extends CI_Model{
	// 获取视频信息
	public function getVideoInfo($vid){
		$sql = 'select * from swap_video where id =? limit 1';
		return $this->db->query($sql,array($vid))->row_array();
	}

	// 得到上节和下节视频
	public function getNearVideo($cid,$sort){
		$sort = intval($sort);

		$sql = "select id from swap_video where cid =? and sort = $sort-1";
		$pre = $this->db->query($sql,array($cid))->row_array();

		$pre = $pre ? $pre['id'] : 0 ;

		$sql = "select id from swap_video where cid =? and sort = $sort+1";
		$next = $this->db->query($sql,array($cid))->row_array();

		$next = $next ? $next['id'] : 0 ;

		return array($pre,$next);
	}



}