<?php
//对$_GET,$_POST,$_COOKIE进行转义
//对一维数组，多维数组进行转义
//一般不使用引用，在php5中取消了地址传参
//所以需要将值重新返回给数组
//简单的一个递归的使用
//明确foreach的使用以及   两种循环方式的区别
defined('ACC')||exit("sorry,you don't have permission access this page!");
function _addslashes($arr){
	foreach($arr as $k=>$v){
		if(is_string($v)){
			$arr[$k]=addslashes($v);
		}else if(is_array($arr[$k])){
			$arr[$k]=_addslashes($arr[$k]);
		}
	}
	return $arr;
	// 	foreach($arr as $v){
	// 	if(is_string($v)){
	// 		$v=addslashes($v);
	// 	}else if(is_array($v)){
	// 		$v=_addslashes($v);
	// 	}
	// }
	// return $arr;
}

