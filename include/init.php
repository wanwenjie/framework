<?php
//初始化框架使用，即引用各种类
//获取根目录
// echo __FILE__,"<br/>";
// echo dirname(__FILE__),"<br/>";
// 增加一个访问权限，其他人不可以直接访问类文件和配置文件
//通过检验一个常量名是否存在
defined('ACC')||exit("sorry,you don't have permission access this page!");

//非法访问，则不可以往下继续执行

define('ROOT',str_replace('\\','/',dirname(dirname(__FILE__)).'/'));
define('DEBUG',true);
session_start();
//在这里面你可以进行加载类
// require(ROOT.'Model/regModel.class.php');
// require(ROOT.'include/db.class.php');
// require(ROOT.'include/log.class.php');
 require(ROOT.'include/lib.class.php');
// require(ROOT.'include/mysql.class.php');
// require(ROOT.'include/conf.class.php');


//实现类的自动加载
//通过使用php提供的一个函数__autoload()
//注意，这里有include和Model两个不同地方的class，要进行一个判别
//所以为了区分Model还是include，我们特意的在规定model类的时候，如testModel.class.php,判别是否有model这个字符

function __autoload($class){
	if(strtolower(substr($class,-5))=='model'){

		require(ROOT.'Model/'.$class.'.class.php');

	}else{

		require(ROOT.'include/'.$class.'.class.php');

	}
}

//递归转义，过滤一下$_GET,$_POST,$_COOKIE
$_GET = _addslashes($_GET);
$_POST = _addslashes($_POST);
$_COOKIE = _addslashes($_COOKIE);

/***
设置报错级别
在调试阶段，尽可能多报错
在产品上线之后，不报错，或者是报相应的错误
几个问题
报错级别要大写
注意引用次数
在index.php中已经引用了一次
conf.class.php
如果再在mysql.class.php中引用
在index.php中出现了两次
所以会报出redeclare的错误
***/
if(DEBUG){
	error_reporting(E_ALL);
}else{
	error_reporting(0);
}

