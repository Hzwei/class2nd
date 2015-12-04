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
		

	}




}
