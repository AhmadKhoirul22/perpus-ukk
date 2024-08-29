<?php
class Kategori extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('level') == NUll){
			redirect('auth');
		} else if($this->session->userdata('level') == 'MEMBER'){
			redirect('auth');
		}
		$this->load->model('Kategori_model');
	}
	public function index(){
		$data['kategori'] = $this->Kategori_model->kategori();
		$data['title'] = 'page of kategori';

		$this->load->view('admin/kategori',$data);
	}
	public function tambah(){
		$nama_kategori = $this->input->post('nama_kategori');
		
		$this->db->from('kategori');
		$this->db->where('nama_kategori',$nama_kategori);
		$cek = $this->db->get()->result_array();
		if($cek <> NULL){
			$alert = '<div class="alert alert-danger alert-dismissible" role="alert">
                        Nama Kategori sudah digunakan
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
			$this->session->set_flashdata('alert',$alert);
			redirect('admin/kategori');
		} else {
			$data = array(
				'nama_kategori' => $this->input->post('nama_kategori'),
			);
			$this->db->insert('kategori',$data);
			$alert = '<div class="alert alert-success alert-dismissible" role="alert">
                        Data berhasil ditambahkan
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
			$this->session->set_flashdata('alert',$alert);
			redirect('admin/kategori');
		}
	}
	public function delete($id_kategori){
		$this->Kategori_model->delete($id);
		$alert = '<div class="alert alert-danger alert-dismissible" role="alert">
                        Data berhasil dihapus
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
		$this->session->set_flashdata('alert',$alert);
		redirect('admin/kategori');
	}
	public function update(){
		$this->Kategori_model->update();
		$alert = '<div class="alert alert-success alert-dismissible" role="alert">
                        Data berhasil diupdate
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
		$this->session->set_flashdata('alert',$alert);
		redirect('admin/kategori');
	}
}
?>
