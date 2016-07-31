<?php

/*
	打印一些gd库的信息
*/
/*var_dump(gd_info());*/

/*
	创建画布
	可以是一个空白画布，最后填充颜色
	也可以是一张图片
 */


//1、创建画布
$im = imagecreatetruecolor(80, 25);


//2、画笔弄上颜料

//随机深的底色
$randBacg = imagecolorallocate($im,mt_rand(0,128),mt_rand(0,128),mt_rand(0,128));

//随机三条线
$randLine_1 = imagecolorallocate($im,mt_rand(128,255),mt_rand(128,255),mt_rand(128,255));
$randLine_2 = imagecolorallocate($im,mt_rand(128,255),mt_rand(128,255),mt_rand(128,255));
$randLine_3 = imagecolorallocate($im,mt_rand(128,255),mt_rand(128,255),mt_rand(128,255));
$red = imagecolorallocate($im,250,0,0);
$blue = imagecolorallocate($im,0,0,255);
$write = imagecolorallocate($im,255,255,255);

//3、填充颜色
imagefill($im,0,0,$randBacg);

/*
	4、开始写字
	imagestring 只能是写英文
	如果想写汉字的话，必须引入字体
	使用imagettftext
*/

/*
	由于汉字数量较多，而且还有很多的生僻字
	使用Unicode的方式随机出汉字不太好
	所以，应该挑选一些较长使用的汉字，形成一个数组

 */

$arr = array('远','上','寒','山','石','径','斜','白','云','深','处','有','人','家');
shuffle($arr);
$randStr = implode('',array_slice($arr,0,4));
imagettftext($im, 15, 0, 2, 18, $write, 'duan.ttf', $randStr);
/*$str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxzy0123456789';
$qu = substr(str_shuffle($str),0,4);
imagestring($im,5,5,5,$qu,$write);*/

//划线
imageline($im,0,mt_rand(0,25),80,mt_rand(0,25),$randLine_1);
imageline($im,0,mt_rand(0,25),80,mt_rand(0,25),$randLine_2);
imageline($im,0,mt_rand(0,25),80,mt_rand(0,25),$randLine_3);

//5、输出图像
header("content-type:image/png");
imagepng($im);

//6、销毁图像
imagedestroy($im);

