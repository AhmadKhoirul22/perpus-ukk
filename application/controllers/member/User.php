<?php
class User extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('level') == NULL){
			redirect('auth');
		}
		$this->load->model('Buku_model');
	}
	public function profile(){
		$data['title'] = 'Profile';
		$this->db->from('user')->where('id_user',$this->session->userdata('id_user'));
		$data['user'] = $this->db->get()->row();
		$this->load->view('member/profile',$data);
	}
	public function update_profile(){
		$data = array(
			'nama' => $this->input->post('nama'),
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email'),
		);
		$where = array('id_user' => $this->input->post('id_user'));

		$this->db->update('user',$data,$where);
		$alert = '<div class="alert alert-success">profile berhasil diganti</div>';
			$this->session->set_flashdata('alert',$alert);
			redirect($_SERVER['HTTP_REFERER']);
	}
	public function password(){
		$data['title'] = 'Change Password';
		$this->db->from('user')->where('id_user',$this->session->userdata('id_user'));
		$data['user'] = $this->db->get()->row();
		$this->load->view('member/password',$data);
	}
	public function update_password(){
		$password = $this->input->post('password');
		$new_password = md5($this->input->post('new_password'));
		$old_password = md5($this->input->post('old_password'));

		if($password != $old_password){
			$alert = '<div class="alert alert-danger">old password salah</div>';
			$this->session->set_flashdata('alert',$alert);
			redirect($_SERVER['HTTP_REFERER']);
		} else if($password == $old_password){
			$data = array(
				'password' => $new_password,
			);
			$where = array('id_user' => $this->input->post('id_user'));
			$this->db->update('user',$data,$where);
			$alert = '<div class="alert alert-success">password berhasil diganti</div>';
			$this->session->set_flashdata('alert',$alert);
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
}
?>
