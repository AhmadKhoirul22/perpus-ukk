<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('level') == NUll){
			redirect('auth');
		} else if($this->session->userdata('level') == 'MEMBER'){
			redirect('auth');
		}
	}

	public function index(){
		$data['title'] = 'page of dashboard';

		$this->db->from('buku');
		$data['buku'] = $this->db->get()->result_array();

		$this->db->from('user')->where('level','MEMBER');
		$data['member'] = $this->db->get()->result_array();
		
		$this->db->from('kategori');
		$data['kategori'] = $this->db->get()->result_array();
		
		$this->db->from('denda')->where('status','AKTIF');
		$data['denda'] = $this->db->get()->row();

		$this->db->select('b.judul, b.penulis, COUNT(d.id_buku) AS jumlah_peminjaman');
		$this->db->from('detail d');
		$this->db->join('peminjaman p', 'd.kode_peminjaman = p.kode_peminjaman');
		$this->db->join('buku b', 'd.id_buku = b.id_buku');
		$this->db->group_by('d.id_buku');
		$this->db->order_by('jumlah_peminjaman', 'DESC');
		$this->db->limit(5);
		$data['peminjaman_terbanyak'] = $this->db->get()->result_array();

		$this->db->from('peminjaman a')->order_by('a.tanggal_peminjaman','DESC');
		$this->db->join('user b','b.id_user = a.id_user');
		$this->db->limit(5);
		$data['activity'] = $this->db->get()->result_array();

		$this->load->view('admin/dashboard',$data);
	}
}
