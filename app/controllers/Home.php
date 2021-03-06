<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// 默认控制器
class Home extends CI_Controller{

	//首页方法 wirte by hu 2015.11.4	
	public function index(){
		// 获取热门课程列表
		$this->load->model('course_model');
		$courseList = $this->course_model->getCourseList(0,'hot',0,4);

		// 猜你喜欢 4门课程 由最近5篇分析
		$courseLikeList = $this->course_model->getCourseLikeList(4,5);
		
		$data = array(
			'courseList' => $courseList,
			'courseLikeList'=>$courseLikeList
		);

		$this->load->view('home/index',$data);
	}

	// 搜索功能
	public function search(){
		$word = $this->input->get('word');

		$this->load->model('course_model');

		// 搜索课程
		$courseList = $this->course_model->searchCourse($word,4);

		// 搜索视频
		$videoList = $this->course_model->searchVideo($word,4);

		$data = array(
			'word'=>$word,
			'courseList'=>$courseList,
			'videoList'=>$videoList

		);

		$this->load->view('home/search',$data);

	}



}

