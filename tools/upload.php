<?php
/*注意是$_FILES,而不是$_FIFLES*/
define('ACC',true);
require('./include/init.php');
require('./tools/upTool.class.php');
print_r($_FILES);
$file = new upTool('pic');
$file ->up();

//将临时文件移到服务器中
//还有就是临时文件的位置，不同操作系统不同，也可以自定义
/*$pic = $_FILES['pic'];

if(move_uploaded_file($pic['tmp_name'], mk_dir().'/'.getRandName($pic['name']))){
	echo 'ok';
}else{
	echo 'fail';
}*/

//那么如果想根据 时间来分目录，创建上传文件的随机名称，只修改后面的即可


//创建随机目录
/*function mk_dir(){
	$path = './uploads/'.date('ymd/i',time());
	if(is_dir($path)){
		return $path;
	}else{
		//级联创建目录
		mkdir($path,0777,true);
		return $path;
	}
}*/

//创建随机文件名，随机有好几种方法，关键是看应该如何利用
/*function getRandName($name){
	$str = 'adcdefghigklmnopqistuvwxyz0123456789';
	//随机打乱，截取从0开始，8个字符
	$rand = substr(str_shuffle($str),0,8);
	//将传进来的name截取后面的类型，在合成一个随机的名字
	//end取最后一个数组
	$end = explode('.',$name);
	$name = end($end);
	return $rand.'.'.$name;

}*/