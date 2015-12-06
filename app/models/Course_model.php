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

	/* 获取课程信息 */ 
	public function getCourseInfo($courseId){
		$sql = 'select * from swap_course where id = ? limit 1';
		return $this->db->query($sql,array($courseId))->row_array();
	}

	/* 获取最新评论 */
	public function getCourseComment($courseId,$start,$num){
		$sql = 'select * from swap_comment where cid=? order by time desc limit ?,? ';
		return $this->db->query($sql,array($courseId,intval($start),intval($num)))->result_array();
	}

	/* 获取是否参加状态 */
	public function getJoinStatus($cid,$uid){
		$sql = 'select id from swap_join where cid=? and uid=? limit 1';
		$status = $this->db->query($sql,array($cid,$uid))->row_array();

		if ($status){
			return 1;
		}
		else{
			return 0;
		}

	}


	/* 加入课程 */
	public function joinCourse($cid,$uid){
		
		// 如果已经存在
		if ($this->getJoinStatus($cid,$uid)){
			return 0;
		}
		else{
			$sql = 'insert into swap_join values(null,?,?,?)';
			// 插入join表记录
			if ($this->db->query($sql,array($uid,$cid,time()))){
				$sql2 = 'update swap_course set join_num = join_num+1';
				return $this->db->query($sql2);
			}
			else{
				return 0;
			}
		}

	}

	/* 获取评分情况 */
	public function getScore($cid,$uid){
		$sql = 'select score from swap_score where cid=? and uid=? limit 1';
		$score = $this->db->query($sql,array($cid,$uid))->row_array();
		if ($score){
			return $score['score'];
		}
		else{
			return -1;
		}
	}

	/* 评分 */
	public function giveScore($cid,$uid,$score){
		$sql = 'insert into swap_score values(null,?,?,?,?)';
			
		// 插入join表记录
		if ($this->db->query($sql,array($uid,$cid,$score,time()))){
			$sql2 = 'update swap_course set score_num = score_num+1 , score = score + ?';
			return $this->db->query($sql2,array($score));
		}
		else{
			return 0;
		}


	}



}