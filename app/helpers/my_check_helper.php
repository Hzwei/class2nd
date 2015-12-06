<?php
/*
**	扩展数据验证函数
**	文件名前加my_，以区分ci原生帮助函数文件
 */ 

defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('myCheckEmail')){

	/* 验证email，函数名加my，以区分ci原生帮助函数 */
	function myCheckEmail($email){
		$patt = '/^(\w)+(\.\w+)*@(\w)+((\.\w+)+)$/';
		return preg_match($patt,$email);
	}

}


		
?>