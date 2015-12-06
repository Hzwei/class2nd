<?php
/*
**	扩展数组处理函数
**	文件名前加my_，以区分ci原生帮助函数文件
 */ 

defined('BASEPATH') OR exit('No direct script access allowed');

// 获取数组中出现的最多值之一
if ( ! function_exists('myGetMoreVal')){
	
	function myGetMoreVal($arr){
		
		// 数组长度
		$len = count($arr);

		// 构造结果数组 长度与测试数组一致，键名对应，存储该值在之后元素中出现的次数(含自身)
		$res = array();

		// 从头遍历
		for($i=0; $i < $len; $i++){
			// 赋初值1
			$res[$i] = 1;
			// 从该元素下一个开始遍历,减少遍历次数
			for ($j=$i+1; $j < $len; $j++){
				if ($arr[$i] == $arr[$j]){
					$res[$i]++;
				}
			}
		}

		// 返回最大值对应的键名
		$key = array_search(max($res),$res);

		// 在测试数组中找到对应的元素
		return $arr[$key];

	}


}




		
?>