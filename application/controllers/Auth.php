<?php 
class Auth extends CI_Controller{
	public function index(){
		$data['title'] = 'page of login';
		$this->load->view('auth',$data);
	}
	public function login(){
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));

		$this->db->from('user');
		$this->db->where('username',$username);
		$cek = $this->db->get()->row();

		if($cek == NULL){
			$alert = '<div class="alert alert-danger alert-dismissible" role="alert">
                        username tidak tedaftar
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
			$this->session->set_flashdata('alert',$alert);
			redirect('auth');
		} else if($cek->password == $password){
			$data = array(
				'nama' => $cek->nama,
				'username' => $cek->username,
				'password' => $cek->password,
				'level' => $cek->level,
				'id_user' => $cek->id_user,
			);
			$this->session->set_userdata($data);
			$alert = '<div class="alert alert-success alert-dismissible" role="alert">
                        Login berhasil
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
			if($cek->level == 'MEMBER'){
			$this->session->set_flashdata('alert',$alert);
			redirect('member/dashboard');
			} else{
			$this->session->set_flashdata('alert',$alert);
			redirect('admin/dashboard');
			}
			// redirect('admin/welcome');
		} else {
			$alert = '<div class="alert alert-danger alert-dismissible" role="alert">
                        Password salah
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
			$this->session->set_flashdata('alert',$alert);
			redirect('auth');
		}
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect('auth');
	}
	public function daftar(){
		$data['title'] = 'page of register';
		$this->load->view('register',$data);
	}
	public function register(){
		$username = $this->input->post('username');
		$this->db->from('user')->where('username',$username);
		$cek = $this->db->get()->result_array();
		if($cek <> null){
			$alert = '<div class="alert alert-danger alert-dismissible" role="alert">
                        Username sudah digunakan
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
			$this->session->set_flashdata('alert',$alert);
			redirect('auth/daftar');
		} else{
			$data = array(
				'username' => $username,
				'email' => $this->input->post('email'),
				'nama' => $this->input->post('nama'),
				'level' => 'MEMBER',
				'password' => md5($this->input->post('password')),
			);
			$this->db->insert('user',$data);
			$alert = '<div class="alert alert-success alert-dismissible" role="alert">
                        Berhasil Register
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
			$this->session->set_flashdata('alert',$alert);
			redirect('auth/daftar');
		}
		
	}
}

?>
