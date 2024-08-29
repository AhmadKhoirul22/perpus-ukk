<?php
class Buku_model extends CI_Model{

	public function kategori_buku(){
		$this->db->from('buku a');
		$this->db->join('kategori b','b.id_kategori = a.id_kategori','left');
		return $this->db->get()->result_array();
	}
	public function update(){
		$data = array(
			'judul' => $this->input->post('judul'),
			'penulis' => $this->input->post('penulis'),
			'penerbit' => $this->input->post('penerbit'),
			'id_kategori' => $this->input->post('id_kategori'),
			'tahun_terbit' => $this->input->post('tahun_terbit'),
			'jumlah' => $this->input->post('jumlah'),
		);
		$where = array(
			'id_buku' => $this->input->post('id_buku')
		);
		$this->db->update('buku',$data,$where);
	}
	public function delete($id){
		$where = array(
			'id_buku' => $id
		);
		$this->db->delete('buku',$where);
		// return $where;
	}
	public function cari_buku($keyword){
		$this->db->like('judul',$keyword);
		$this->db->or_like('penulis',$keyword);
		$this->db->or_like('penerbit',$keyword);
		return $this->db->get('buku')->result();
	}
	public function rating_buku($id_buku){
		$this->db->select('avg(rating) as rata_rata');
		$this->db->from('ulasan_buku');
		$this->db->where('id_buku',$id_buku);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			return $query->row()->rata_rata;
		} else {
			return 0; // Jika tidak ada ulasan, nilai default 0
		}
	}
	
}
?>
