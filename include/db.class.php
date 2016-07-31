<?php
/***
建立一个通用的数据库类
即是一个数据库抽象类
抽象类，就得用abstract
类名也得用abstract
***/
defined('ACC')||exit("sorry,you don't have permission access this page!");
abstract class Db{

	//发送一个查询
	public abstract function query($sql);

	//连接数据库
	public abstract function connect($h,$u,$p);

	//选择一个数据库
	public abstract function usedb($db);

	//返回一行结果
	public abstract function getRaw($sql);

	//返回全部的查询
	public abstract function getAll($sql);

	//返回单个值
	//自动拼接sql语句
	public abstract function autoExecute($table,$data);
}