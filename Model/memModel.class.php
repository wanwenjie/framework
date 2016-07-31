<?php

class MemModel extends Model{

	//管理员表
	private $table = 'adminuser';


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
	public function getAll(){
		$data=array();
		$sql = 'select id,user,email from '.$this->table;
		$data = $this->db->getAll($sql);
		return $data;
	}


}