<?php 
class Peminjaman extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('level') == NUll){
			redirect('auth');
		} else if($this->session->userdata('level') == 'MEMBER'){
			redirect('auth');
		}
		$this->load->library('pdf');
	}
	public function index(){
		$this->db->from('peminjaman a');
		$this->db->join('user b','b.id_user = a.id_user','left');
		$this->db->where('a.status','DIPINJAM');
		$this->db->order_by('id_peminjaman','DESC');
		$data['peminjaman'] = $this->db->get()->result_array();

		$data['title'] = 'page of peminjaman';

		$this->db->from('user')->where('level','MEMBER');
		$data['user'] = $this->db->get()->result_array();
		$this->load->view('admin/peminjaman',$data);
	}

	public function transaksi($id){
		$this->db->from('user')->where('id_user',$id);
		$data['user'] = $this->db->get()->row();

		$this->db->from('temp')->where('id_user',$id);
		$this->db->join('buku','buku.id_buku = temp.id_buku','left');
		$data['temp'] = $this->db->get()->result_array();

		$this->db->from('buku');
		$data['buku'] = $this->db->get()->result_array();

		$data['title'] = 'page of transaksi';

		$this->load->view('admin/transaksi',$data);
	}

	public function tambah_temp(){
		$id_user = $this->input->post('id_user');
		$id_buku = $this->input->post('id_buku');
		$this->db->from('temp');
		$this->db->where('id_user',$id_user);
		$this->db->where('id_buku',$id_buku);
		$cek = $this->db->get()->result_array();
		if($cek <> null){
			$alert = '<div class="alert alert-danger alert-dismissible" role="alert">
                        buku sudah dipilih
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
			$this->session->set_flashdata('alert',$alert);
			redirect('admin/peminjaman/transaksi/'.$id_user);
		} else {
			$data = array(
				'id_user' => $id_user,
				'id_buku' => $id_buku,
			);
			$this->db->insert('temp',$data);
			$alert = '<div class="alert alert-success alert-dismissible" role="alert">
                        berhasil ditambahkan
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
			$this->session->set_flashdata('alert',$alert);
			redirect('admin/peminjaman/transaksi/'.$id_user);
		}
	}

	public function delete_temp($id){
		$data = array(
			'id_temp' => $id
		);
		$this->db->delete('temp',$data);
		$alert = '<div class="alert alert-danger alert-dismissible" role="alert">
                        berhasil dihapus
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
		$this->session->set_flashdata('alert',$alert);
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function pinjam_buku(){
		date_default_timezone_set("Asia/Jakarta");
		$tanggal = date('Y-m-d');
		// untuk memuat angka random
		$kode_peminjaman = rand(1000,9000);

		$lama_meminjam = 3;
		$tanggal_pengembalian = date('Y-m-d',strtotime('+'.$lama_meminjam.'days',strtotime($tanggal)));
		// menambah otomatis hari

		$this->db->from('temp a');
		$this->db->join('buku b','b.id_buku = a.id_buku','left');
		$this->db->where('a.id_user',$this->input->post('id_user'));
		$temp = $this->db->get()->result_array();

		foreach($temp as $temp){

			if ($temp['jumlah'] < 1) {
				$alert = '<div class="alert alert-danger alert-dismissible" role="alert">
							Jumlah buku tidak mencukupi, buku tidak bisa dipinjam.
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						  </div>';
				$this->session->set_flashdata('alert', $alert);
				redirect('admin/peminjaman/');
				return; // Menghentikan proses jika jumlah buku kurang dari 1
			}
		// insert detail
		$detail = array(
			'kode_peminjaman' => $kode_peminjaman,
			'id_buku' => $temp['id_buku'],
		);
		$this->db->insert('detail',$detail);
		// delete temp
		$delete = array(	
			'id_temp' => $temp['id_temp']
		);
		$this->db->delete('temp',$delete);
		// update buku
		$buku = array(
			'jumlah' => $temp['jumlah'] - 1,
		);
		$wh = array(
			'id_buku' => $temp['id_buku']
		);
		$this->db->update('buku',$buku,$wh);
		}
		// insert peminjaman
		$data = array(
			'kode_peminjaman' => $kode_peminjaman,
			'tanggal_peminjaman' => $tanggal,
			'tanggal_pengembalian' => $tanggal_pengembalian,
			'tanggal_kembali' => '',
			'status' => 'DIPINJAM',
			'id_user' => $this->input->post('id_user'),
		);
		$this->db->insert('peminjaman',$data);
		$alert = '<div class="alert alert-success alert-dismissible" role="alert">
                        berhasil ditambahkan
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
			$this->session->set_flashdata('alert',$alert);
			redirect('admin/peminjaman/');
	}
	public function detail_pinjam($kode_peminjaman){
		$this->db->from('detail a');
		$this->db->join('buku b','b.id_buku = a.id_buku','left');
		$this->db->where('a.kode_peminjaman',$kode_peminjaman);
		$data['detail'] = $this->db->get()->result_array();

		$this->db->from('peminjaman a');
		$this->db->join('user b','b.id_user = a.id_user','left');
		$this->db->where('a.kode_peminjaman',$kode_peminjaman);
		$data['user'] = $this->db->get()->row();

		$this->db->from('denda_peminjaman')->where('kode_peminjaman',$kode_peminjaman);
		$data['denda'] = $this->db->get()->row();

		$data['title'] = 'detail peminjaman';
		$this->load->view('admin/detail_pinjam',$data);
	}
	public function delete($kode_peminjaman){
		$this->db->where('kode_peminjaman',$kode_peminjaman);
		$this->db->delete('peminjaman');

		$this->db->where('kode_peminjaman',$kode_peminjaman);
		$this->db->delete('detail');

		$alert = '<div class="alert alert-danger alert-dismissible" role="alert">
		Data berhasil dihapus
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	  	</div>';
		$this->session->set_flashdata('alert',$alert);
		redirect('admin/peminjaman');
	}
	public function cetak_laporan(){
		$data = array(
			'tanggal_1' => $this->input->post('tanggal_1'),
			'tanggal_2' => $this->input->post('tanggal_2'),
			'status' => $this->input->post('status'),
		);
		$this->load->view('admin/cetakpeminjaman',$data);
	}
}
?>
