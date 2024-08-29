<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Denda extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
        $this->load->model('Denda_model');
		if($this->session->userdata('level') == NUll){
			redirect('auth');
		} else if($this->session->userdata('level') == 'MEMBER'){
			redirect('auth');
		}
		$this->load->library('pdf');
    }

    public function index() {
		$data['title'] = 'page of denda';
		$this->db->from('denda');
		$data['denda'] = $this->db->get()->result_array();
        $this->load->view('admin/denda',$data);
    }

    public function tambah() {
        if ($this->input->post()) {
            $data = array(
                'harga_denda' => $this->input->post('harga_denda'),
                'status' => $this->input->post('status')
            );
            // $this->Denda_model->create_denda($data);
			if ($data['status'] == 'AKTIF') {
				$this->db->update('denda', array('status' => 'TIDAK AKTIF'));
			}
			$this->db->insert('denda', $data);
            redirect('admin/denda');
        } else {
            $this->load->view('admin/denda');
        }
    }

    public function update() {
		$id = $this->input->post('id_denda');
        if ($this->input->post()) {
            $data = array(
                'harga_denda' => $this->input->post('harga_denda'),
                'status' => $this->input->post('status')
            );
            // $this->Denda_model->update_denda($id, $data);
			if ($data['status'] == 'AKTIF') {
				$this->db->update('denda', array('status' => 'TIDAK AKTIF'));
			}
			$this->db->where('id_denda', $id);
			$this->db->update('denda', $data);
            redirect('admin/denda');
        } else {
            $data['denda'] = $this->Denda_model->get_denda($id);
            $this->load->view('admin/denda',$data);
        }
    }

    public function delete($id) {
        $this->Denda_model->delete_denda($id);
        redirect('admin/denda');
    }
	public function cetak_denda(){
		$tanggal_1 = $this->input->post('tanggal_1');
		$tanggal_2 = $this->input->post('tanggal_2');

		$data = array(
			// 'utang' => $utang,
			'tanggal_1' => $tanggal_1,
			'tanggal_2' => $tanggal_2,
		);
		$this->load->view('admin/cetakdenda',$data);
	}
}
