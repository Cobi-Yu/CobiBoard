<?php
class Board_model extends CI_Model {
	
	function __construct(){       
		parent::__construct();
	}
	
	function get_lists($page,$per_page){	
		//최상위 게시물들의  전체 list 리턴
		//최상위 게시물의 list만 select한 뒤 select한 id와 get_child를 이용해서 전체 게시물 리스트 구성
		$sql = "SELECT board_id,title,writer,hit,0 AS depth  
				FROM board 
				WHERE parent_id=1
				AND board_id!=1
				AND parent_id!=board_id
				ORDER BY board_id DESC LIMIT ?,?";
		$parent_board = $this->db->query($sql, array( ($page-1)*$per_page ,$per_page))->result();
		$list_data = array();
		foreach ($parent_board as $key => $item){
			array_push($list_data,$item);
			$list_data = array_merge($list_data,$this->get_child($item->board_id,1));
		}
		return $list_data;
	}
	
	function get_child($id, $depth=0){	
		//$id의 모든 자식들 리턴 , $id=1을 받으면 전체 게시물 리턴
		//$depth는 재귀 호출시에 필요한 파라미터, 직접 호출하는 쪽에서는 전달하지 않음
		$sql = "SELECT board_id,title,writer,hit,? AS depth 
				FROM board 
				WHERE parent_id=?
				AND board_id != parent_id
				ORDER BY board_id";
		$result = $this->db->query($sql,array($depth++,$id))->result();
		$list_data=array();
		foreach ($result as $item){
			array_push($list_data,$item);
			$list_data = array_merge($list_data,$this->get_child($item->board_id,$depth));
		}
		return $list_data;
	}
	
	function get_total_count(){
		//최상위 게시물들의 수 리턴
		$sql = "SELECT count(board_id) AS cnt 
				FROM board 
				WHERE parent_id=1 
				AND board_id!=1";
		return $this->db->query($sql)->row()->cnt;
	}

	
	function write($board_data){
		//게시물 입력, $board_data['parent_id'] 가 1이면 최상위 게시물
		$password = password_hash($board_data['password'],PASSWORD_DEFAULT);
		$sql = "INSERT INTO board
				(parent_id,title,content,writer,password)
				VALUES
				( ?, ?, ?, ?, ? )";
		$this->db->query($sql,array(
									$board_data['parent_id'], $board_data['title'],
									$board_data['content'], $board_data['writer'],
									$password
									)
				);
		return $this->db->insert_id();
	}
	
	function get_board($board_id){
		//게시물 상세정보 리턴
		$sql = "UPDATE board set hit = hit +1 WHERE board_id=?";
		$this->db->query($sql,array($board_id));
		$sql = "SELECT 
				board_id,parent_id,title,content,writer,reg_date,hit
				FROM board
				WHERE board_id=?";
		return $this->db->query($sql,array($board_id))->row();
	}
	
	function update($board_data){
		//게시물 수정
		var_dump($board_data);
		$sql = "UPDATE board
				SET title = ?,
				writer = ?,
				content = ?
				WHERE board_id=?";
		$this->db->query($sql,array(
									$board_data['title'], $board_data['writer'],
									$board_data['content'], $board_data['board_id'],
									)
						);
	}

	function delete($board_id){
		$sql = "DELETE 
				FROM board
				WHERE board_id=?";
		$this->db->query($sql,array($board_id));
	}
	
	function get_reply_list($board_id){
		$sql = "SELECT 
				reply_id,content,reg_date,writer,board_id
				FROM reply 
				WHERE board_id=?";
		return $this->db->query($sql,array($board_id))->result();
	}
	
	function check_password($board_data){
		$sql = "SELECT password 
				FROM board 
				WHERE board_id=?";
		$hashed_pw = $this->db->query($sql,array($board_data['board_id']))
							->result()[0]->password;
		return password_verify($board_data['password'], $hashed_pw);
	}
}
