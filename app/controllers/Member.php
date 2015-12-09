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


	// 新增课程
	public function addCourse(){
		$title = $this->input->post('title');
		$this->load->model('member_model');
		
		echo $this->member_model->addCourse($title);

	}

	// 删除课程
	public function delCourse(){
		
		$cid = $this->input->post('cid');

		// 获取权限判断 是否为课程所有人
		$this->load->model('member_model');
		$judge = $this->member_model->getjudge($cid);
		if (!$judge){
			redirect(base_url());
			echo "0";
			exit;
		}

		echo $this->member_model->delCourse($cid);

	}

	// 编辑提交
	public function editCommit(){
		$cid = $this->uri->segment(3);

		// 获取权限判断 是否为课程所有人
		$this->load->model('member_model');
		$judge = $this->member_model->getjudge($cid);
		if (!$judge){
			redirect(base_url());
			exit;
		}

		// 图片上传处理
		if (!empty($_FILES['img']['name'])){

			// 按日期 创建目录
			$date = date("Ymd");
			$dir = 'upload/img/'.$date;

			if (!is_dir($dir)){
				// 创建目录
				mkdir($dir);
			}

			if (is_dir($dir)){
				// 参数配置
				$config['upload_path']      = $dir;
				$config['allowed_types']    = 'gif|jpg|png|jpeg';
				// 单位 KB 
				$config['max_size']     = 2000;
				$config['max_width']        = 1500;
				$config['max_height']       = 1200;
				// 文件名
				$config['file_name'] = rand(1000000000,9999999999);
				// 如果设置为 TRUE ，上传的文件如果和已有的文件同名，将会覆盖已存在文件 如果设置为 FALSE ，将会在文件名后加上一个数字
				$config['overwrite'] =	FALSE;

				// 导入上传类
				$this->load->library('upload', $config);

				// 上传
				if ($this->upload->do_upload('img')){
					$info = $this->upload->data();
					$img = $date.'/'.$info['file_name'];
					$this->member_model->updateCourseImg($cid,$img);
				}

			}

		}

		// 修改数据
		$category = $this->input->post('category');
		$title = $this->input->post('title');
		$desc = $this->input->post('desc');

		// 为空返回
		if ($desc == '' ||$category == '' ||$desc == ''){
			redirect(getenv("HTTP_REFERER"));
		}
		else{
			// 更新数据
			$this->member_model->updateCourse($cid,$category,$title,$desc);
		}

		//重载页面展示结果
		redirect(base_url('member/edit/'.$cid));

	}

	// 添加&修改 视频
	public function methodVideo(){
		
		$sort = $this->input->post('sort');
		$title = $this->input->post('title');
		$link = $this->input->post('link');
		$vid = $this->input->post('vid');
		$cid = $this->input->post('cid');

		// 获取权限判断 是否为课程所有人
		$this->load->model('member_model');
		$judge = $this->member_model->getjudge($cid);
		if (!$judge){
			redirect(base_url());
			echo 0;
			exit;
		}

		if($vid == 0){
			// 新增视频
			echo $this->member_model->addVideo($cid,$title,$link,$sort);
		}
		else{
			// 检查视频权限
			if ($this->member_model->checkVideo($vid,$cid)) {
				echo $this->member_model->updateVideo($vid,$title,$link,$sort);
			}
			else{
				echo 0;
			}

		}
	}

	// 删除视频
	public function delVideo(){
		$vid = $this->input->post('vid');
		$cid = $this->input->post('cid');

		// 获取权限判断 是否为课程所有人
		$this->load->model('member_model');
		$judge = $this->member_model->getjudge($cid);
		if (!$judge){
			redirect(base_url());
			echo 0;
			exit;
		}

		// 检查视频权限
		if ($this->member_model->checkVideo($vid,$cid)) {
			echo $this->member_model->delVideo($vid);
		}
		else{
			echo 0;
		}


	}

	// 评论视频
	public function commentVideo(){
		$vid = $this->input->post('vid');
		$text = $this->input->post('text');

		$this->load->model('video_model');
		
		echo $this->video_model->commentVideo($vid,$text,$_SESSION['uid']);
	}



}