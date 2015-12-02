<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// 默认控制器
class Home extends CI_Controller{

	//首页方法 wirte by hu 2015.11.4	
	public function index(){
		$this->load->view('home/index');
	}




}
