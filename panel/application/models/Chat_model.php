<?php 

class Chat_model extends CI_Model {

	public $tableName = "chats";

	public function __construct() {
		parent::__construct();

	}

	public function get($where = array()) {
		return $this->db->where($where)->get($this->tableName)->row();
	}


	/* Veritabanından tüm kayıtları bana getir */
	public function get_all($where = array(), $order = "id ASC") {
		return $this->db->where($where)->order_by($order)->get($this->tableName)->result();
	}

	public function add($data=array()) {
		return $this->db->insert($this->tableName , $data);
	}

	public function update($where=array() , $data=array()) {
		return $this->db->where($where)->update($this->tableName , $data);
	}

	public function delete($where=array()) {
		return $this->db->where($where)->delete($this->tableName);
	}

	public function get_user_message($rowName , $where = array() , $or_rowName , $or_where = array(), $order = "createdAt DESC") {
		return $this->db->where_in($rowName , $where)->where_in($or_rowName , $or_where)->order_by($order)->get($this->tableName)->result();
	}
	
}






