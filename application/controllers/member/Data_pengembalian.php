<?php
class Data_pengembalian extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('level') == NULL){
			redirect('auth');
		}
	}
	public function index(){
		$this->db->from('peminjaman')->where('id_user',$this->session->userdata('id_user'));
		$this->db->where('status','DIKEMBALIKAN');
		$data['pengembalian'] = $this->db->get()->result_array();

		$data['title'] = 'Data Pengembalian';

		$this->load->view('member/data_pengembalian',$data);
	}
	public function detail($kode_peminjaman){
		$this->db->from('detail a');
		$this->db->join('buku b','b.id_buku = a.id_buku','left');
		$this->db->where('a.kode_peminjaman',$kode_peminjaman);
		$data['detail'] = $this->db->get()->result_array();

		$this->db->from('peminjaman a');
		$this->db->join('user b','b.id_user = a.id_user');
		$this->db->where('a.kode_peminjaman',$kode_peminjaman);
		$data['user'] = $this->db->get()->row();

		$data['title'] = 'detail peminjaman';
		$this->load->view('member/data_detail',$data);
	}
}
?>
