<?php
class Dashboard extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('level') == NULL){
			redirect('auth');
		}
		$this->load->model('Buku_model');
	}
	public function index(){
		$data['title'] = 'Welcome to Library';

		$data['buku'] = $this->Buku_model->kategori_buku();

		$this->load->view('member/dashboard',$data);
	}

	public function detail_buku($id_buku){
		$this->db->from('buku a')->where('a.id_buku',$id_buku);
		$this->db->join('kategori b','b.id_kategori = a.id_kategori','left');
		$data['buku'] = $this->db->get()->result_array();

		$this->db->from('buku a')->where('a.id_buku',$id_buku);
		$this->db->join('kategori b','b.id_kategori = a.id_kategori','left');
		$this->db->join('ulasan_buku c','c.id_buku = a.id_buku','left');
		$this->db->join('user d','d.id_user = c.id_user','left');
		$data['rating'] = $this->db->get()->result_array();

		$data['title'] = 'Detail Buku';
		$this->load->view('member/detail_buku',$data);
	}
	public function search(){
		$keyword = $this->input->get('keyword');
		if($keyword){
			$data['buku'] = $this->Buku_model->cari_buku($keyword);
		}
		$data['kategori'] = $this->Buku_model->kategori_buku();
		$data['title'] = 'search';
		$data['kategori'] = $this->Buku_model->kategori_buku();
		$this->load->view('member/search',$data);
	}
	public function tambah_ulasan(){
		$id_user = $this->input->post('id_user');
		$id_buku = $this->input->post('id_buku');
		$this->db->from('peminjaman')->where('id_user',$id_user);
		$cek = $this->db->get()->result_array();

		$this->db->from('ulasan_buku')->where('id_user',$id_user);
		$this->db->where('id_buku',$id_buku);
		$cek1 = $this->db->get()->result_array();
		if($cek == NULL){
			$alert = '<div class="alert alert-danger">Jika belum meminjam buku, tidak bisa memberikan ulasan</div>';
			$this->session->set_flashdata('alert',$alert);
			redirect($_SERVER['HTTP_REFERER']);
		} else if($cek1 != null) {
			$alert = '<div class="alert alert-danger">hanya dapat memberikan 1 ulasan</div>';
			$this->session->set_flashdata('alert',$alert);
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			$data = array(
				'id_user' => $id_user,
				'id_buku' => $id_buku,
				'rating' => $this->input->post('rating'),
				'ulasan' => $this->input->post('ulasan'),
			);
			$this->db->insert('ulasan_buku',$data);
			$alert = '<div class="alert alert-success">Berhasil memberikan ulasan</div>';
			$this->session->set_flashdata('alert',$alert);
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	public function hapus_ulasan($id){
		$data = array(
			'id_ulasan' => $id
		);
		$this->db->delete('ulasan_buku',$data);
		$alert = '<div class="alert alert-danger">ulasan dihapus</div>';
		$this->session->set_flashdata('alert',$alert);
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function update_ulasan(){
		$data = array(
			'id_user' => $this->input->post('id_user'),
			'id_buku' => $this->input->post('id_buku'),
			'ulasan' => $this->input->post('ulasan'),
			'rating' => $this->input->post('rating'),
		);
		$where = array(
			'id_ulasan' => $this->input->post('id_ulasan')
		);
		$this->db->update('ulasan_buku',$data,$where);
		$alert = '<div class="alert alert-success">ulasan diupdated</div>';
		$this->session->set_flashdata('alert',$alert);
		redirect($_SERVER['HTTP_REFERER']);
	}
}
?>
