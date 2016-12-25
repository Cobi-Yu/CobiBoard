<?php
class Reply_model extends CI_Model {

	function __construct()
	{       
		parent::__construct();
		$this->load->helper('cobi_helper');
	}
	
	function get_total_count(){
		$sql = "SELECT 
				count(reply_id) as cnt 
				FROM reply";
		return $this->db->query($sql)->row()->cnt;
	}
	
	function get_lists($board_id){
		$sql = "SELECT 
				reply_id,content,reg_date,writer,board_id
				FROM reply 
				WHERE board_id=?";
		return $this->db->query($sql,array($board_id))->result();
	}
	
	function write($reply_data){
		$sql = "INSERT 
				INTO reply
				(content,writer,board_id)
				VALUES 
				(?,?,?)";
		$this->db->query($sql, array(	$reply_data['content'],
										$reply_data['writer'],
										$reply_data['board_id']
									)
						);
		return $this->db->insert_id();
	}
	
	function get($reply_id){
		$sql = "SELECT
				reply_id,content,reg_date,writer,board_id
				FROM reply
				WHERE reply_id=?";
		return $this->db->query($sql,array($reply_id))->row();
	}
	
	function delete($reply_id){
		$sql = "DELETE 
				FROM reply 
				WHERE reply_id=?";
		$this->db->query($sql,array($reply_id));
	}
}