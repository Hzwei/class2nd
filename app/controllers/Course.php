<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// 课程控制器
class Course extends CI_Controller{

	// 课程首页
	public function index(){
		// 分类ID
		if ($this->uri->segment(3)){
			$cateId = $this->uri->segment(3);
		}
		else{
			$cateId = 0;
		}

		// 排序规则
		if ($this->uri->segment(4)){
			$order = $this->uri->segment(4);
		}
		else{
			$order = 'hot';
		}

		// 获取类别
		$this->load->model('Course_model');
		$category = $this->Course_model->getCategory();



		// 前端数据
		$data = array(
			'category' => $category,
			'cateId'=>$cateId,
			'order'=>$order
		);

		$this->load->view('course/index',$data);
	}




}
