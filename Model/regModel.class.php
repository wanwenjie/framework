<?php
class RegModel extends Model{


	//前台注册表
	private $table = 'memuser';


	//注册的方法
	public function reg($arr){
		$this->db->autoExecute($this->table,$arr);
	}

	//往数据库里插入数据
	public function add($data){
		$this->db->autoExecute($this->table,$data);
	}

	//获取数据库adminuser表中的最后id
	public function getId(){
		$data = array();
		$sql = 'select id from '.$this->table;
		$data = $this->db->getAll($sql);
		return $data[count($data)-1]['id'];
	}
	//获取数据中数据总数
	public function getNum(){
		$data = array();
		$sql = 'select id from '.$this->table;
		$data = $this->db->getAll($sql);
		return count($data);
	}
	//获取全部的数据
	public function getAll(){
		$data=array();
		$sql = 'select * from '.$this->table;
		$data = $this->db->getAll($sql);
		return $data;
	}
	//删除当前数据
	public function delData($id){
		$sql='delete from '.$this->table.' where id='.$id;
		$this->db->query($sql);
		return $this->db->_affactRow();
	}

	//认证数据库中此用户，密码是否正确
	public function confirm($user,$pwd){

		$sql = 'select user,pwd from '.$this->table.' where user = "'.$user.'" and pwd= "'.$pwd.'"';
		$this->db->query($sql);
		if($this->db->_affactRow() != 0){
			//验证正确，登录
			$sql = 'update '.$this->table.' set flag = 1 where user = "'.$user.'"';
			$this->db->query($sql);
			//并且跳转到index.php页面
			return 'success';
		}else return 'faile';
	}

	//用户退出
	public function logout($user){
		$sql = 'update '.$this->table.' set flag = 0 where user = "'.$user.'"';
		$this->db->query($sql);
		if($this->db->_affactRow() != 0){
			return 'success';
		}
		
	}

}