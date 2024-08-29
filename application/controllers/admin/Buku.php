<?php 
class Buku extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('level') == NUll){
			redirect('auth');
		} else if($this->session->userdata('level') == 'MEMBER'){
			redirect('auth');
		}
		$this->load->model('Buku_model');
	}
	public function index(){
		$data['title'] = 'page of buku';
		
		$this->db->from('kategori');
		$data['kategori'] = $this->db->get()->result_array();

		$data['buku'] = $this->Buku_model->kategori_buku();

		$this->load->view('admin/buku',$data);
	}

	public function tambah(){
		$judul = $this->input->post('judul');
		$this->db->from('buku');
		$this->db->where('judul',$judul);
		$cek = $this->db->get()->result_array();
		if($cek <> NULL){
			$alert = '<div class="alert alert-danger alert-dismissible" role="alert">
                        Judul buku sudah digunakan
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
			$this->session->set_flashdata('alert',$alert);
			redirect('admin/buku');
		} else{
			$data = array(
				'judul' => $judul,
				'penulis' => $this->input->post('penulis'),
				'penerbit' => $this->input->post('penerbit'),
				'id_kategori' => $this->input->post('id_kategori'),
				'tahun_terbit' => $this->input->post('tahun_terbit'),
				'jumlah' => $this->input->post('jumlah'),
			);
			$this->db->insert('buku',$data);
			$alert = '<div class="alert alert-success alert-dismissible" role="alert">
                        data berhasil ditambahkan
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
			$this->session->set_flashdata('alert',$alert);
			redirect('admin/buku');
		}
	}
	public function update(){
		$this->Buku_model->update();
			$alert = '<div class="alert alert-success alert-dismissible" role="alert">
                        data berhasil diupdate
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
		$this->session->set_flashdata('alert',$alert);
		redirect('admin/buku');
	}
	public function delete($id){
		$this->Buku_model->delete($id);
		$alert = '<div class="alert alert-danger alert-dismissible" role="alert">
                        data berhasil dihapus
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
		$this->session->set_flashdata('alert',$alert);
		redirect('admin/buku');
	}
}
?>
