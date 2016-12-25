<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Angular extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('board_model');
		$this->load->helper('url');
		$this->load->helper('cobi_helper');
	}

	public function index(){
		echo "test";
		// $this->load->view('dialog');
	}

	public function test(){

    }

	public function get_lists(){
		$data['list'] = $this->board_model->get_lists(1,5);
	
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function lists(){ //게시판 목록 조회
    //view
		$this->load->view('board/ng-list');
		//view
	}

	public function get_board(){
		$param_data = $this->input->get();
		$data['list'] = $this->board_model->get_lists($param_data['page'],5);
		$data['count'] = $this->board_model->get_total_count();
		$this->output->set_content_type('application/json')
								->set_output(json_encode($data));
	}

	public function get_board_info(){
		$board_id = $this->input->get('board_id');
		$data['board_data'] = $this->board_model->get_board($board_id);
		$data['reply_data'] = $this->board_model->get_reply_list($board_id);
		$this->output->set_content_type('application/json')
								->set_output(json_encode($data));
	}

	public function view($board_id){ //글 조회 화면
		$this->load->view('board/ng-view');
	}

	public function write_view($parent_id=1){ //게시글 등록 화면
		//set data
		$board_data['parent_id']=$parent_id;
		//set data

    	//view
		$this->load->view('header',array('css'=>['write']));
		$this->load->view('board/write',array('board_data'=>$board_data));
		$this->load->view('footer');
    	//view
	}

	public function write(){ //게시글 등록 로직
		//insert data
		$this->db->trans_start();
		$board_data = $this->input->post();
		$board_id = $this->board_model->write($board_data);
		$this->db->trans_complete();
		//insert data

		//완료 시 get_board로 redirect
		redirect('/board/view/'.$board_id);
	}

	public function update_view($board_id){ //게시글 수정 화면
		//set data
		$board_data = $this->board_model->get_board($board_id);
		$board_data->board_id=$board_id;
		//set data

    	//view
		$this->load->view('header',array('css'=>['write']));
		$this->load->view('board/update',array('board_data'=>$board_data));
		$this->load->view('footer');
    	//view
	}

	public function update(){ //게시글 수정 로직
		//update data
		$this->db->trans_start();
		$board_data = $this->input->post();
		$this->board_model->update($board_data);
		$this->db->trans_complete();
		//update data

		//완료시 해당 view로 redirect
		redirect('/board/view/'.$board_data['board_id']);
	}

	public function delete($board_id){ //게시물 삭제 로직
		//delete data
		$this->board_model->delete($board_id);
		//delete data

		//완료시 lists로 redirect
		redirect('/board/lists');
	}

	public function check_password($board_id){	//비밀번호 체크 api
		//data
		$board_data['password'] = $this->input->get('password');
		$board_data['board_id']= $board_id;
		$result= $this->board_model->check_password($board_data);
		//data

		//json response
		$this->output->set_output(json_encode(array('result' => $result)));
	}
}
