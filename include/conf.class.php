<?php
//要写成一个单例模式
//只读一次的config.inc.php
defined('ACC')||exit("sorry,you don't have permission access this page!");
class Conf{
	//注意，属性都是私有的
	private $data=array();
	private static $con=null;
	//final 修饰，禁止继承
	final protected function __construct(){
		//将config.inc.php的$_CFG赋值给$data	
		require(ROOT.'include/config.inc.php');	
		$this->data=$_CFG;
	}

	//单例模式开始
	//设置成公共，类外要进行调用的
	public static function getIns(){
		//此处Conf可以用self代替
		if(self::$con instanceof self){
			return self::$con;
		}else{
			self::$con=new self();
			return self::$con;
		}
		
	}

	//在类外要获取$data的数据
	//使用魔术方法__get($key)
	public function __get($key){
		//判断数组中是否有这个值
		if(array_key_exists($key,$this->data)){
			return $this->data[$key];
		}else{
			return false;
		}
	}


	//动态的追加配置选项
	public function __set($key,$value){
		return $this->data[$key]=$value;
	}


}







