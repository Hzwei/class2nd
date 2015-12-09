<?php
/*
**	课程模型 
 */

class Course_model extends CI_Model{
	
	/* 获取所有类别 */ 
	public function getCategory(){
		return $this->db->query('select * from swap_category')->result_array();
	}

	/* 获取该课程下视频总数 */
	public function getVideoCount($cid){
		$sql = 'select count(*) from swap_video where cid = ?';
		$res = $this->db->query($sql,array($cid))->row_array();
		return $res['count(*)'];
	}

	/* 获取课程所属类别 */
	public function getCateInfo($cid){
		$sql = 'select * from swap_category where id = ?';
		return $this->db->query($sql,array($cid))->row_array();
	}

	/* 猜你喜欢 */
	public function getCourseLikeList($num,$new){
		if (isset($_SESSION['uid'])){

			$sql = 'select cid from swap_join where uid = ? order by time desc limit ?';

			// 最近参加的 $new 门课程
			$courseList = $this->db->query($sql,array($_SESSION['uid'],$new))->result_array();

			if ($courseList){
				// 构造分类ID数组
				$cateIdList = array();
				foreach ($courseList as $val){
					// 遍历获取课程分类ID , 构建数据
					$sql2 = 'select cid from swap_course where id = ? limit 1';
					$cateList = $this->db->query($sql2,array($val['cid']))->row_array();
					$cateIdList[] = $cateList['cid'];
				}

				// 加载扩展的数组处理函数
				$this->load->helper('my_array');

				// 获取最多出现的分类ID
				$cateId = myGetMoreVal($cateIdList);
				
				// 获取该分类ID下 $num 门最热课程
				return $this->getCourseList($cateId,'hot',0,$num);
				
			}
			else{
				// 未参与任何课程状态下获取 $num 门最热课程
				return $this->getCourseList(0,'hot',0,$num);
			}

		}
		else{
			// 未登陆状态下获取 $num 门最热课程
			return $this->getCourseList(0,'hot',0,$num);
		}

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


	/* 获取视频列表 */
	public function getVideoList($cid){
		$sql = 'select id,title,sort,link,time from swap_video where cid =? order by sort asc';
		return $this->db->query($sql,array($cid))->result_array();
	}

	/* 获取个人评论情况 */
	public function getMyComment($cid,$uid){
		$sql = 'select * from swap_comment where cid = ? and uid = ? limit 1';
		return $this->db->query($sql,array($cid,intval($uid)))->row_array();
	}

	/* 插入评论 */
	public function insertComment($cid,$uid,$uanme,$comment){
		$sql = 'insert into swap_comment values(null,?,?,?,?,?)';
		return $this->db->query($sql,array($cid,$uid,$uanme,$comment,time()));
	}

	// 搜索课程
	public function searchCourse($word,$num){
		$sql = "select * from swap_course where title like '%$word%' or `desc` like '%$word%' order by join_num desc limit ?";
		return $this->db->query($sql,array($num))->result_array();
	}

	// 搜索视频
	public function searchVideo($word,$num){
		$sql = "select id,title,sort,link,time from swap_video where title like '%$word%' order by time desc limit ?";
		return $this->db->query($sql,array($num))->result_array();
	}


}