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

	// 评论视频
	public function commentVideo($vid,$text,$uid){
		$sql = 'insert into swap_forum values(null,?,?,?,?)';
		return $this->db->query($sql,array($vid,$uid,$text,time()));
	}

	// 获取评论列表
	public function getCommentList($vid,$start=0,$num=5){
		$sql = 'select uid,message,time from swap_forum where vid = ? order by time desc limit ?,?';
		$arr  = $this->db->query($sql,array(intval($vid),intval($start),intval($num)))->result_array();

		$this->load->model('user_model');
		foreach ($arr as $key => $value){
			$userInfo = $this->user_model->getrUserInfo($value['uid'])->row_array();
			$arr[$key]['name'] = $userInfo['username'];
		}

		return $arr;

	}




}