<?php
class Profile extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('level') == NUll){
			redirect('auth');
		} else if($this->session->userdata('level') == 'MEMBER'){
			redirect('auth');
		}
		$this->load->model('User_model');
	}
	public function index(){

		$data['profile'] = $this->User_model->perpus();

		$data['title'] = 'page of profile';

		$this->load->view('admin/profile',$data);
	}
	public function update(){
		$this->User_model->update_perpus();
		$alert = '<div class="alert alert-success alert-dismissible" role="alert">
                        Data berhasil diupdate
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
		$this->session->set_flashdata('alert',$alert);
		redirect('admin/profile');
	}
}
?>
