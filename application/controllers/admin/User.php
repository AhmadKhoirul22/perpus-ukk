<?php 
class User extends CI_Controller{
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
		$data['title'] = 'page of user';
		
		$data['user'] = $this->User_model->user();
		$this->load->view('admin/user',$data);
	}

	public function tambah(){
		// $username = $this->input->post('username');
		$level = $this->input->post('level');
		$this->db->from('user');
		$this->db->where('username',$this->input->post('username'));
		$cek = $this->db->get()->result_array();
		if($cek <> NULL){
			$alert = '<div class="alert alert-danger alert-dismissible" role="alert">
                        Username sudah digunakan
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
			$this->session->set_flashdata('alert',$alert);
			// redirect('admin/user');
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			$this->User_model->tambah($level);
			$alert = '<div class="alert alert-success alert-dismissible" role="alert">
                        Data berhasil ditambahkan
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
			$this->session->set_flashdata('alert',$alert);
			// redirect('admin/user');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	public function update(){
			$this->User_model->update();
			$alert = '<div class="alert alert-success alert-dismissible" role="alert">
                        Data berhasil diupdate
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
			$this->session->set_flashdata('alert',$alert);
			redirect('admin/user');
	}
	public function delete($id_user){
		$this->User_model->delete($id_user);
		$alert = '<div class="alert alert-danger alert-dismissible" role="alert">
                        Data berhasil dihapus
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
		$this->session->set_flashdata('alert',$alert);
		redirect('admin/user');
	}
	public function changepassword($id){
		$this->db->from('user')->where('id_user',$id);
		$data['user'] = $this->db->get()->row();
		$data['title'] = 'change password';
		$this->load->view('admin/changepassword',$data);
	}
	public function profile($id){
		$this->db->from('user')->where('id_user',$id);
		$data['user'] = $this->db->get()->row();
		$data['title'] = 'Update Profile';
		$this->load->view('admin/profile_user',$data);
	}
	public function update_profile(){
		$data = array(
			'nama' => $this->input->post('nama'),
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email'),
		);
		$where = array('id_user' => $this->input->post('id_user'));
		$this->db->update('user',$data,$where);
		$alert = '<div class="alert alert-success alert-dismissible" role="alert">
                        Profile berhasil diupdate
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
		$this->session->set_flashdata('alert',$alert);
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function ubah_password(){
		$password = $this->input->post('password');
		$new_password = md5($this->input->post('new_password'));
		$old_password = md5($this->input->post('old_password'));
		if($password != $old_password){
			$alert = '<div class="alert alert-danger alert-dismissible" role="alert">
                        Password lama salah
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
		$this->session->set_flashdata('alert',$alert);
		redirect($_SERVER['HTTP_REFERER']);
		} else if($password == $old_password){
			$data = array(
				'password' => $new_password
			);
			$where = array('id_user' => $this->input->post('id_user'));
			$this->db->update('user',$data,$where);
			$alert = '<div class="alert alert-success alert-dismissible" role="alert">
                        Password berhasil diupdate
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
		$this->session->set_flashdata('alert',$alert);
		redirect($_SERVER['HTTP_REFERER']);
		}
	}
}
?>
