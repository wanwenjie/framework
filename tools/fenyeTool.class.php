<?php
// defined('ACC')||exit("sorry!you dont have permission access this page!");


/*
	数据总条数    $total
	每页显示条数  $perpage   默认为30条
	总页数        $cnt=ceil($total/$perpage);
	当前页数      $page  之前有 $page-1 页，显示从 ($page-1)*$perage+1 到 $page*$perpage 数据
*/

class FenyeModel{
	protected $total=0;
	protected $perpage = 30;
	protected $page = 2;

	//初始化页面数据
	public function __construct($t,$per,$page){
		$this->total = $t;
		$this->perpage = $per;
		$this->page = $page;
	}
	//初始化分页导航代码
	public function show(){
		$cnt = ceil($this->total/$this->perpage);
		//获得当前页面的URL，超全局变量
		$url = $_SERVER['REQUEST_URI'];
		//对URL进行解析
		$parse = parse_url($url);
		//如果存在 ?page=3
		if(!empty($parse['query'])){
			unset($parse['query']);
			//目的是向拼接一个URL自带query的  
			$url = $parse['path'].'?page=';
		}
		else{
			$url = $parse['path'].'?page=';
		}
		//当前页面page
		$nav = array();
		$nav[0] = '<span><a href="'.$url.$this->page.'">'.$this->page.'</a></span>';
		$strUp = '<a href="'.$url.($this->page-1).'">上一页</a>';
		$strDown = '<a href="'.$url.($this->page+1).'">下一页</a>';
		array_unshift($nav,$strUp);
		array_push($nav,$strDown);
		return $nav = implode('',$nav);
	

	}


}


