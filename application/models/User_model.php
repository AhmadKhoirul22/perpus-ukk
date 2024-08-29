<?php
class User_model extends CI_Model{
	public function user(){
		$this->db->from('user');
		$this->db->order_by('level','DESC');
		return $this->db->get()->result_array();
	}
	public function tambah($level){
		$data = array(
			'nama' => $this->input->post('nama'),
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password')),
			'level' => $level,
			'email' => $this->input->post('email'),
		);
		$this->db->insert('user',$data);
	}
	public function update(){
		$username = $this->input->post('username');
			$data = array(
				'nama' => $this->input->post('nama'),
				'username' => $username,
				'level' => $this->input->post('level'),
				'email' => $this->input->post('email'),
			);
			$where = array(
				'id_user' => $this->input->post('id_user')
			);
			$this->db->update('user',$data,$where);
	}
	public function delete($id_user){
		$where = array(
			'id_user' => $id_user
		);
		$this->db->delete('user',$where);
	}
	public function perpus(){
		$this->db->from('profile');
		return $this->db->get()->row();
	}
	public function update_perpus(){
		$data = array(
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
		);
		$where = array(
			'id_profile' => 1
		);
		$this->db->update('profile',$data,$where);
	}
}
?>
