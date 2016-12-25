<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reply extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('reply_model');
		$this->load->helper('url');
		$this->load->helper('cobi_helper');
	}

	public function write($board_id){
		//insert data
		$this->db->trans_start();
		$reply_data = $this->input->post();
		$reply_data ['board_id'] = $board_id;
		$reply_id = $this->reply_model->write($reply_data);
		$this->db->trans_complete();
		//insert data

		//set data
		$reply_data = $this->reply_model->get($reply_id);
		//set data

		//json response
		$this->output->set_content_type('application/json')
								->set_output(json_encode($reply_data));
	}

	public function delete($reply_id){
		//delete data
		$this->reply_model->delete($reply_id);
		//delete data

		//json response
		$this->output->set_content_type('application/json')
								->set_output(json_encode(true));
	}
}
