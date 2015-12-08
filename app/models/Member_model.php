<?php
/*
**	会员中心模型 
*/

class Member_model extends CI_Model{

	// 获取所属课程
	public function getBelongCourse($start,$num){
		// 获取课程id和参与时间数组
		$sql = 'select id,title,score,score_num,join_num,time from swap_course where uid = ? order by join_num desc limit ?,?';
		return $this->db->query($sql,array($_SESSION['uid'],$start,$num))->result_array();
	}
	
	// 获取用户最近学习课程信息
	public function getRecentCourse($start,$num){
		// 获取课程id和参与时间数组
		$sql = 'select cid,time from swap_join where uid = ? order by time desc limit ?,?';
		$courseArr = $this->db->query($sql,array($_SESSION['uid'],$start,$num))->result_array();

		$courseList = array();

		// 遍历数组查询课程表中相关信息
		foreach ($courseArr as $key => $value){
			$sql2 = 'select id,title,score/score_num,join_num  from swap_course where id = '.$value['cid'];
			$arr = $this->db->query($sql2)->row_array();

			$sql3 = 'select score from swap_score where uid ='.$_SESSION['uid'].' and cid = '.$value['cid'];
			$score = $this->db->query($sql3)->row_array();

			$arr['yourScore'] = $score['score'];

			// 添加参与时间字段
			$arr['time'] = $value['time'];
			$courseList[] = $arr;
		}

		return $courseList;
	}

	// 获取最近点评
	public function getRecentComment($start,$num){
		// 获取最近点评
		$sql = 'select cid,text,time from swap_comment where uid = ? limit ?,?';
		$commentList = $this->db->query($sql,array($_SESSION['uid'],$start,$num))->result_array();

		$this->load->model('course_model');

		// 遍历获取课程名
		foreach ($commentList as $k => $val){			
			$courseInfo = $this->course_model->getCourseInfo($val['cid']);
			$commentList[$k]['title'] = $courseInfo['title'];
		}

		return $commentList;
	}

	// 获取权限判断 是否为课程所有人
	public function getjudge($cid){
		$sql = 'select uid from swap_course where id = ? limit 1';
		$user = $this->db->query($sql,array($cid))->row_array();
		if ($user['uid'] != $_SESSION['uid']) {
			return 0;
		}
		else{
			return 1;
		}
	}



}