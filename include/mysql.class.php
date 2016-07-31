<?php

/***

引用conf.class.php

***/

defined('ACC')||exit("sorry,you don't have permission access this page!");
class Mysql extends Db{
	private $host="";
	private $user="";
	private $pwd="";
	private $dbName="";
	private $charset="";
	private $hash='';
	//对于资源型 初值为空
	private $link=null;
	private $conn=null;
	static private $mysql=null;
	private $log=null;

	//构造函数，给属性赋初值
	//固定构造函数，不让引用
	final private function __construct(){
		//如果有配置文件
		//此函数是读取配置文件，将文件的值赋给属性
		$this->conn=Conf::getIns();
		$this->log=new Log(); 
		$this->host=$this->conn->host;
		$this->user=$this->conn->username;
		$this->pwd=$this->conn->pwd;
		$this->dbName=$this->conn->dbName;
		$this->charset=$this->conn->charset;
		$this->connect($this->host,$this->user,$this->pwd);
		$this->usedb($this->dbName);
		//产生一个随机数，来证明声明多个对象，只调用一次
		

	}
	//单例模式，构造函数要封死
	public static function getInstence(){
		//多次调用，但是只生成一个
		//用self代替Mysql，有好处。。。
		if(self::$mysql!=null){
			return self::$mysql;
		}
		else{
			self::$mysql = new Mysql();
			return self::$mysql;
		}
		
	}
	//连接数据库
	public function connect($h,$u,$p){
		$this->link=mysql_connect($h,$u,$p);
	}

	//发送查询
	public function query($sql){
		$this->log->write($sql);
		return mysql_query($sql,$this->link);
	}

	//选择数据库名称
	public function usedb($db){
		$sql="use $db";
		$this->query($sql);
	}
	
	//设置编码
	public function charSet(){
		$this->query("use ",$this->charset);
	}

	//返回多行结果
	public function getAll($sql){
		$list=array();
		$rs=$this->query($sql);
		while($rw=mysql_fetch_assoc($rs)){
			array_push($list,$rw);
		}
		return $list;
	}

	//返回一行结果
	public function getOne($sql){
		$rs=$this->query($sql);
		$rw=mysql_fetch_assoc($rs);
		return $rw;
	}

	//返回单个的值
	public function getRaw($sql){
		$rs=$this->query($sql);
		return mysql_fetch_row($rs);
	}

	//返回受影响的记录行数
	public function _affactRow(){
		return mysql_affected_rows();
	}

	//自动执性insert或者是update操作
	public function autoExecute($table,$data){
		$key=array();
		$value=array();
		//获取数组键的个数
		$len=count($data);
		//获取数组的所有键
		$key=array_keys($data);
		//获取数组的所有值
		$value=array_values($data);
		$sql='insert into '.$table.'(';
		for($i=0;$i<$len;$i++){			
			if($i==$len-1){
				$sql.=$key[$i];
			}
			else $sql.=$key[$i].',';
		}
		$sql.=') values("';
		for($i=0;$i<$len;$i++){
			if($i==$len-1){
				$sql.=$value[$i].'")';
			}
			else $sql.=$value[$i].'","';
		}
		$this->query($sql);
	}

	

}
