<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Board extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('board_model');
		$this->load->helper('url');
		$this->load->helper('cobi_helper');
	}

	public function index(){
		$this->lists();
	}

	public function lists($page=1){ //게시판 목록 조회
		//pagination config
		$this->load->library('pagination');
		$config['base_url'] = base_url().'board/lists';
		$config['total_rows'] = $this->board_model->get_total_count();
		$config['per_page'] = 5;	// 한 페이지에 보여줄 게시물의 수 (답글은 카운트하지 않고 최상위만 카운트)
		$config['use_page_numbers'] = TRUE;
		$config['num_links'] = 2;	// 페이징 숫자를 나눠줄 기준
		$config['first_link'] = 'First  ';
		$config['last_link'] = '  Last';
		$config['next_link'] = '  Next';
		$config['prev_link'] = 'Prev  ';
		$this->pagination->initialize($config);
		//pagination config

		//set data
		$board_list_data['list_data'] = $this->board_model->get_lists($page,$config['per_page']);
		$board_list_data['paging'] = $this->pagination->create_links();
		$board_list_data['count'] = $config['total_rows'];
		$board_list_data['page'] = $this->pagination->cur_page==0 ? 1 : $this->pagination->cur_page;
		$board_list_data['begin_no'] = ($board_list_data['page']*$config['per_page']) - ($config['per_page']-1);
		//set data

    	//view
		$this->load->view('header',array('css'=>['lists']));
		$this->load->view('board/list',array('board_list_data'=>$board_list_data));
		$this->load->view('footer');
		//view
	}

	public function view($board_id){ //글 조회 화면
		//set data
		$data['board_data'] = $this->board_model->get_board($board_id);
		$data['reply_data'] = $this->board_model->get_reply_list($board_id);
		//set data

    	//view
		$this->load->view('header',array('css'=>['view']));
		$this->load->view('board/view',array('data'=>$data));
		$this->load->view('footer',array('js'=>['view']));
    	//view
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
