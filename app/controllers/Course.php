<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// 课程控制器
class Course extends CI_Controller{
	
	// 类别 0为全部
	private $cateId;

	// 排序方式 hot top new
	private $order;


	public function __construct(){
		parent::__construct();

		// 分类ID
		if ($this->uri->segment(3)){
			$this->cateId = $this->uri->segment(3);
		}
		else{
			$this->cateId = 0;
		}

		// 排序规则
		if ($this->uri->segment(4)){
			$this->order = $this->uri->segment(4);
		}
		else{
			$this->order = 'hot';	
		}
	}

	// 课程主页
	public function index(){

		// 获取类别
		$this->load->model('course_model');
		$category = $this->course_model->getCategory();

		// 获取课程列表
		$courseList = $this->course_model->getCourseList($this->cateId,$this->order,0,12);

		// 前端数据
		$data = array(
			'category' => $category,
			'cateId'=>$this->cateId,
			'order'=>$this->order,
			'courseList'=>$courseList,
		);

		$this->load->view('course/index',$data);
		
	}


	// ajax 加载更多课程
	public function loadMore(){

		// 开始位置
		$start = $this->input->get('start');

		// 分类和排序
		$cateId = $this->input->get('cateId');
		$order = $this->input->get('order');

		// 课程数
		$num = 8;

		$this->load->model('course_model');
		
		// 获取课程列表
		$courseList = $this->course_model->getCourseList($cateId,$order,$start,$num);

		echo json_encode($courseList);

	}

	// 课程详细信息页
	public function info(){
		$courseId = intval($this->uri->segment(3));

		$this->load->model('course_model');

		// 获取课程数据
		$courseInfo = $this->course_model->getCourseInfo($courseId);

		// 获取相关课程列表
		$courseList = $this->course_model->getCourseList($courseInfo['cid'],'hot',0,4);

		// 获取最新评论3条
		$comment = $this->course_model->getCourseComment($courseId,0,3);

		// 获取视频列表
		$videoList = $this->course_model->getVideoList($courseId);

		// 获取所属分类信息
		$cateInfo = $this->course_model->getCateInfo($courseInfo['cid']);

		$data = array(
			'courseInfo' => $courseInfo,
			'courseList'=>$courseList,
			'comment'=>$comment,
			'videoList'=>$videoList,
			'myComment'=>0,
			'score'=>0,
			'joinStatus'=>0,
			'cateInfo'=>$cateInfo
		);

		if (isset($_SESSION['uid'])){

			// 获取是否参加状态
			$data['joinStatus'] = $this->course_model->getJoinStatus($courseId,$_SESSION['uid']);

			// 已加入状态下查询评分情况
			if($data['joinStatus'] == 1){
				// -1未评价 1-10为评分
				$data['score'] = $this->course_model->getScore($courseId,$_SESSION['uid']);
			}

			// 获取个人评论情况
			$data['myComment'] = $this->course_model->getMyComment($courseId,$_SESSION['uid']);

		}


		$this->load->view('course/info',$data);


	}

	/* 加载更多点评 */
	public function loadComment(){

		$cid = $this->input->post('cid');
		$start = $this->input->post('start');

		$this->load->model('course_model');

		// 获取评论3条
		$comment = $this->course_model->getCourseComment($cid,$start,3);

		echo json_encode($comment);

	}

	/* 加入课程 */
	public function joinCourse(){
		if (!isset($_SESSION['uid'])) {
			echo 0;
		}
		else{
			$cid = $this->input->post('cid');

			$this->load->model('course_model');
			
			if ($this->course_model->joinCourse($cid,$_SESSION['uid'])){
				echo 1;
			}
			else{
				echo 0;
			}

		}

	}

	// 评分
	public function giveScore(){
		if (!isset($_SESSION['uid'])){
			echo 0;
		}
		else{
			// 课程ID
			$cid = $this->input->post('cid');
			$score = $this->input->post('score');

			$this->load->model('course_model');

			// 检测是否已参加
			$status = $this->course_model->getJoinStatus($cid,$_SESSION['uid']);

			if ($status){
				// 未评分情况下
				if ($this->course_model->getScore($cid,$_SESSION['uid']) == -1){
					echo $this->course_model->giveScore($cid,$_SESSION['uid'],$score);
				}
				else{
					echo 0;
				}
			}
			else{
				echo 0;
			}

		}
	}

	/* 评价 */
	public function giveComment(){

		if (!isset($_SESSION['uid'])){
			echo 0;
		}
		else{
			// 课程ID
			$cid = $this->input->post('cid');
			$this->load->model('course_model');

			// 检测是否已参加
			$status = $this->course_model->getJoinStatus($cid,$_SESSION['uid']);

			if($status){
				// 如果已有记录
				if ($this->course_model->getMyComment($cid,$_SESSION['uid'])){
					echo 0;
				}
				else{
					$comment = $this->input->post('comment');
					echo $this->course_model->insertComment($cid,$_SESSION['uid'],$_SESSION['username'],$comment);
				}
			}
			else{
				echo 0;
			}

		}

	}


	// 视频显示
	public function video(){
		$vid = $this->uri->segment(3);
		
		$this->load->model('video_model');
		$this->load->model('course_model');

		// 视频信息
		$videoInfo = $this->video_model->getVideoInfo($vid);

		// 得到上节和下节视频 array(pre,next)  0则无
		$nearVideo = $this->video_model->getNearVideo($videoInfo['cid'],$videoInfo['sort']);

		// 获取该课程下视频总数
		// $videoCount = $this->course_model->getVideoCount($videoInfo['cid']);

		// 所属课程信息
		$courseInfo = $this->course_model->getCourseInfo($videoInfo['cid']);

		// 获取所属分类信息
		$cateInfo = $this->course_model->getCateInfo($courseInfo['cid']);

		$data = array(
			'videoInfo' => $videoInfo,
			'courseInfo'=>$courseInfo,
			'cateInfo' => $cateInfo,
			'nearVideo'=>$nearVideo
		);

		$this->load->view('course/video',$data);

	}


	




}
