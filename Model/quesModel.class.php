<?php
class QuesModel extends Model{


	//前台注册表
	private $table = 'x2_questions';

	private $table2 = 'tmp_question';
	//往 x2_questions 数据库里插入数据
	public function add($data){
		$this->db->autoExecute($this->table,$data);
	}

	//随机产生试题插入到数据库中
	public function insert($rand){
		$data = array();
		$sql = 'select questionid from '.$this->table2;
		$data = $this->db->getAll($sql);
		if(count($data) == 65){
			$sql = 'truncate table '.$this->table2;
			$this->db->query($sql);
		}
		if(!empty($rand)){
			$this->db->autoExecute($this->table2,$rand);
		}
		
	}

	//获取随机产生的试题
	public function getTmpAll(){
		$data = array();
		$sql = 'select * from '.$this->table2;
		$data = $this->db->getAll($sql);
		return $data;
	}



	//获取数据库表中的最后id
	public function getId(){
		$data = array();
		$sql = 'select questionid from '.$this->table;
		$data = $this->db->getAll($sql);
		return $data[count($data)-1]['id'];
	}
	//获取数据中数据总数
	public function getNum(){
		$data = array();
		$sql = 'select questionid from '.$this->table;
		$data = $this->db->getAll($sql);
		return count($data);
	}
	//获取全部的数据
	public function getAll($offset=0,$limit){
		$data=array();
		$sql = 'select questionid,questiontype,question,questionanswer,questionselect from '.$this->table.' limit '.$offset.','.$limit;
		$data = $this->db->getAll($sql);
		return $data;
	}
	//获取一条数据
	public function getOne($id){
		$data = array();
		$sql = 'select questionid,questiontype,question,questionanswer,questionselect from '.$this->table.' where questionid='.$id;
		$data = $this->db->getOne($sql);
		return $data;
	}
	//删除当前数据
	public function delData($id){
		$sql='delete from '.$this->table.' where questionid='.$id;
		$this->db->query($sql);
		return $this->db->_affactRow();
	}



}