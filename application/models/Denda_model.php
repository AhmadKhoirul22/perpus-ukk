<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Denda_model extends CI_Model {

    public function get_all_denda() {
        return $this->db->get('denda')->result();
    }

    // public function get_denda($id) {
    //     return $this->db->get_where('denda', array('id' => $id))->row();
    // }

    public function create_denda($data) {
        if ($data['status'] == 'AKTIF') {
            $this->db->update('denda', array('status' => 'TIDAK AKTIF'));
        }
        return $this->db->insert('denda', $data);
    }

    public function update_denda($id, $data) {
        if ($data['status'] == 'AKTIF') {
            $this->db->update('denda', array('status' => 'TIDAK AKTIF'));
        }
        $this->db->where('id_denda', $id);
        return $this->db->update('denda', $data);
    }

    public function delete_denda($id) {
        return $this->db->delete('denda', array('id_denda' => $id));
    }
}
