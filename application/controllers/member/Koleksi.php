<?php
class Koleksi extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('level') == NULL){
			redirect('auth');
		}
		$this->load->model('Buku_model');
	}
	public function index(){
		$this->db->from('koleksi a');
		$this->db->join('buku b','b.id_buku = a.id_buku','left');
		$this->db->join('kategori c','c.id_kategori = b.id_kategori','left');
		$this->db->where('a.id_user',$this->session->userdata('id_user'));
		$data['koleksi'] = $this->db->get()->result_array();

		$data['title'] = 'page of koleksi';

		$this->load->view('member/koleksi',$data);
	}
	public function tambah_koleksi(){
		$id_buku = $this->input->post('id_buku');
		$id_user = $this->input->post('id_user');
		$this->db->from('koleksi');
		$this->db->where('id_buku',$id_buku);
		$this->db->where('id_user',$id_user);
		$cek = $this->db->get()->result_array();
		if($cek <> null){
			$alert = '<div class="alert alert-danger">Buku sudah ditambahkan koleksi</div>';
		$this->session->set_flashdata('alert',$alert);
		redirect($_SERVER['HTTP_REFERER']);
		} else {
			$data = array(
				'id_buku' => $id_buku,
				'id_user' => $id_user,
			); 
			$this->db->insert('koleksi',$data);
			$alert = '<div class="alert alert-success">Buku Berhasil ditambahkan kekoleksi</div>';
		$this->session->set_flashdata('alert',$alert);
		redirect($_SERVER['HTTP_REFERER']);
		}
	}
	public function delete($id){
		$where = array(
			'id_koleksi' => $id
		);
		$this->db->delete('koleksi',$where);
		$alert = '<div class="alert alert-danger">Buku dihapus dari koleksi</div>';
		$this->session->set_flashdata('alert',$alert);
		redirect('member/koleksi/');
	}
}
?>
