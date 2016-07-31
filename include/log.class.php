<?php
defined('ACC')||exit("sorry,you don't have permission access this page!");
class Log{

	private $logPath='';
	public function __construct(){
		$this->logPath=ROOT.'data/log/curr.log';
	}
	//往data/log/current.log里写入日志
	public function write($log){
		$this->bak();
		$fh=fopen($this->logPath,'ab');
		fwrite($fh,$log."\r\n");

	}

	//如果文件>1mb,将current.log改名(备份)，然后再新建一个current.log
	public function bak(){
		date_default_timezone_set('PRC');
		$newName=ROOT.'data/log/'.date("ymd",time()).mt_rand(1,100).'.bak';
		if($this->is_bak()){
			rename($this->logPath,$newName);
			touch($this->logPath);
		}else{
			return false;
		}
	}

	//判断文件大小
	public function is_bak(){
		//如果不存在那个文件就建一个
		if(!file_exists($this->logPath)){
			touch($this->logPath);
		}	
		//判断那个文件的大小
		if(fileSize($this->logPath)>1024*1024*0.5*0.5){
			return true;
		}else{
			return false;
		}
		
	}
}



