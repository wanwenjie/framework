<?php
//通用的Model类


class Model{
	private $table=null;//每个model都有自己不同的表
	protected $db=null;//在model里进行数据库的操作

	public function __construct(){

		$this->db=Mysql::getInstence();//在model里赋给db资源
	}
	
}