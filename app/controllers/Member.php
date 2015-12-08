<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// 会员中心模块
class Member extends CI_Controller{

	// 会员权限验证入口
	public function __construct(){
		parent::__construct();
		if(!isset($_SESSION['uid'])){
			redirect(base_url());
		}

	}

	// 会员中心首页
	public function index(){
		$this->load->model('member_model');

		// 获取最近参与课程
		$recentCourse = $this->member_model->getRecentCourse(0,4);

		// 获取最近点评
		$recentComment = $this->member_model->getRecentComment(0,3);

		// 获取所属课程
		$belongCourse = $this->member_model->getBelongCourse(0,3);

		$data = array(
			'recentCourse'=>$recentCourse,
			'recentComment'=>$recentComment,
			'belongCourse'=>$belongCourse
		);

		$this->load->view('member/index',$data);

	}

	// 加载更多课程
	public function loadMoreCouser(){
		$start = intval($this->input->get('start'));
		$this->load->model('member_model');
		$res = $this->member_model->getRecentCourse($start,4);
		echo json_encode($res);
	}

	// 加载更多课程
	public function loadMoreBelongCouser(){
		$start = intval($this->input->get('start'));
		$this->load->model('member_model');
		$res = $this->member_model->getBelongCourse($start,3);
		echo json_encode($res);
	}


	// 加载更多点评
	public function loadMoreComment(){
		$start = intval($this->input->get('start'));
		$this->load->model('member_model');
		$res = $this->member_model->getRecentComment($start,3);
		echo json_encode($res);
	}


	// 编辑课程
	public function edit(){
		// 课程号
		$cid = $this->uri->segment(3);
		$this->load->model('course_model');
		$this->load->model('member_model');

		// 获取权限判断 是否为课程所有人
		$judge = $this->member_model->getjudge($cid);

		if (!$judge){
			redirect(base_url());
			exit;
		}

		// 获取课程信息
		$course = $this->course_model->getCourseInfo($cid);

		// 获取视频列表
		$video = $this->course_model->getVideoList($cid);

		// 获取所有分类
		$category = $this->course_model->getCategory();

		$data = array(
			'course'=>$course,
			'video'=>$video,
			'category'=>$category
		);

		$this->load->view('member/edit',$data);

	}

	// 编辑提交
	public function editCommit(){
		
		

	}



	// 新增课程
	public function add(){


	}



}