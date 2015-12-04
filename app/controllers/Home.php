<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// 默认控制器
class Home extends CI_Controller{

	//首页方法 wirte by hu 2015.11.4	
	public function index(){
		// 获取热门课程列表
		$this->load->model('course_model');
		$courseList = $this->course_model->getCourseList(0,'hot',0,4);

		
		
		$data = array(
			'courseList' => $courseList
		);

		$this->load->view('home/index',$data);
	}




}
