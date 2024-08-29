<?php
class Kategori_model extends CI_Model{
	public function kategori(){
		$this->db->from('kategori');
		return $this->db->get()->result_array();
	}
	public function delete($id_kategori){
		$data = array(
			'id_kategori' => $id_kategori,
		);
		$this->db->delete('kategori',$data);
	}
	public function update(){
		$data = array(
			'nama_kategori' => $this->input->post('nama_kategori'),
		);
		$where = array(
			'id_kategori' => $this->input->post('id_kategori')
		);
		$this->db->update('kategori',$data,$where);
	}
}
?>
