<?php
class Pengembalian extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('level') == NUll){
			redirect('auth');
		} else if($this->session->userdata('level') == 'MEMBER'){
			redirect('auth');
		}
	}
	public function index(){
		$this->db->from('peminjaman a')->order_by('a.id_peminjaman');
		$this->db->join('user b','b.id_user = a.id_user','left');
		$this->db->join('denda_peminjaman c','c.kode_peminjaman = a.kode_peminjaman','left');
		$this->db->where('a.status','DIKEMBALIKAN');
		$data['peminjaman'] = $this->db->get()->result_array();

		$data['title'] = 'page of peminjaman';

		$this->db->from('user')->where('level','MEMBER');
		$data['user'] = $this->db->get()->result_array();
		$this->load->view('admin/pengembalian',$data);
	}
	public function mengembalikan_buku($kode_peminjaman){
		$this->db->from('detail');
		$this->db->where('kode_peminjaman',$kode_peminjaman);
		$detail = $this->db->get()->result_array();

		$this->db->from('peminjaman');
		$this->db->where('kode_peminjaman',$kode_peminjaman);
		$peminjaman = $this->db->get();
		$row1 = $peminjaman->row();
		$tanggal_pengembalian = $row1->tanggal_pengembalian;

		$this->db->from('denda')->where('status','AKTIF');
		$row = $this->db->get()->row();
		$denda = $row->harga_denda;

		$jml = count($detail) * $denda;

		date_default_timezone_set("Asia/Jakarta");
		$tanggal_kembali = date('Ymd');
		// $tanggal_kembali = date('20240816');

		$selisih_hari = (strtotime($tanggal_kembali) - strtotime($tanggal_pengembalian)) / (60 * 60 * 24);
		// waktu lalu di kalikan 60 60 24

		// menentukan apakah peminjaman kena denda 
		if($selisih_hari > 0){
			$harga_denda = $selisih_hari * $jml;
		} else {
			$harga_denda = 0;
		}
		// menentukan apakah denda
		if($harga_denda > 0){
			$data = array(
				'kode_peminjaman' => $kode_peminjaman,
				'denda' => $harga_denda,
			);
			$this->db->insert('denda_peminjaman',$data);
		} else if($harga_denda == 0){
			$data = array(
				'kode_peminjaman' => $kode_peminjaman,
				'denda' => 0,
			);
			$this->db->insert('denda_peminjaman',$data);
		}

		foreach($detail as $det){
			// update jumlah buku
			$id_buku = $det['id_buku'];
			$this->db->from('buku');
			$this->db->where('id_buku',$id_buku);
			$query = $this->db->get();
			$row = $query->row();
			
			if($row){
				$penjumlahan = $row->jumlah + 1;
				$data = array(
					'jumlah' => $penjumlahan
				);
				$this->db->where('id_buku',$id_buku);
				$this->db->update('buku',$data);
			}
		}

		$data = array(
			'tanggal_kembali' => $tanggal_kembali,
			'status' => 'DIKEMBALIKAN',
		);
		$this->db->where('kode_peminjaman',$kode_peminjaman);
		$this->db->update('peminjaman',$data);

		$alert = '<div class="alert alert-success alert-dismissible" role="alert">
                        berhasil dikembalikan
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
			$this->session->set_flashdata('alert',$alert);
			redirect('admin/peminjaman/');
	}
}
?>
