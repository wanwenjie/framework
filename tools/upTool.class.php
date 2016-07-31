<?php

/*
	一个单文件上传类
	一个好的类，应该包括报错设置
	有利于测试
 */

class upTool{

	//设置上传文件最大大小,单位是m
	protected $maxSize = 1;

	//设置上传文件支持的文件类型
	protected $allowType = 'jpg,jpeg,png,gif,bmp';

	//设置上传文件的错误代码
	//protected $errno  = array();

	//设置上传文件数组
	protected $file = null;



	public function __construct($key){

		//设置http上传变量数组
		$this->file = $_FILES[$key];

	}


	//上传文件
	public function up(){

		if(!$this->isAllowType($this->getSuffix($this->file['name']))){
			echo "不是允许的类型";
			return false;
		}

		if(!$this->isAllowSize($this->file['size'])){
			echo "不是允许的大小";
			return false;
		}
		move_uploaded_file($this->file['tmp_name'],$this->getNewPath());
	}



	//获得后缀的文件类型
	public function getSuffix($name){

		//将文件名拆开，形成数组
		$tmpName = explode('.',$name);
		$suffixName = end($tmpName);
		return $suffixName;

	}

	//根据日期形成目录
	public function setDir(){

		//根据时间，每天形成一个目录
		$dir = date('Ymd',time());
		$path = ROOT.'/uploads/'.$dir;
		if(!is_dir($path)){
			//级联创建目录
			mkdir($path,0777,true);
		}
		return $path;
	}

	//生成随机名称
	public function getRandName(){
		$str = 'abcdefghigklmnopqrstuvwxyz0123456789';
		//将字符串打乱后重新截取
		$newName = substr(str_shuffle($str),0,8);
		return $newName;
	}

	//获取设置之后的文件名及路径
	public function getNewPath(){
		echo  $this->setDir().'/'.$this->getRandName().'.'.$this->getSuffix($this->file['name']);
		return $this->setDir().'/'.$this->getRandName().'.'.$this->getSuffix($this->file['name']);
	}




	/*
		判断文件上传是否符合规范
		包括文件大小是否符合
		文件类型是否允许

	 */
	
	//判断文件类型是否允许
	public function isAllowType($type){
		$arr = explode(',',strtolower($this->allowType));
		if(in_array(strtolower($type),$arr)){
			return true;
		}else return false;

	}

	//判断文件的大小是否符合
	public function isAllowSize($size){

		if($size > $this->maxSize*1024*1024){
			return false;
		}else return true;
		
	}



}