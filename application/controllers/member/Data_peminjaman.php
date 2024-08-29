<?php
class Data_peminjaman extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('level') == NULL){
			redirect('auth');
		}
	}
	public function index(){
		$this->db->from('peminjaman')->where('id_user',$this->session->userdata('id_user'));
		$this->db->where('status','DIPINJAM');
		$data['peminjaman'] = $this->db->get()->result_array();

		$data['title'] = 'Data Peminjaman';

		$this->load->view('member/data_peminjaman',$data);
	}
}
?>
