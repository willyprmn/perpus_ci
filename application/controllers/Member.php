<?php
defined('BASEPATH') or exit ('NO Direct Script Access Allowed');

class Member extends CI_Controller{
	function __construct(){
		parent::__construct();
		// cek login
		if($this->session->userdata('status') != "login"){
			$alert=$this->session->set_flashdata('alert', 'Anda belum Login');
			redirect(base_url().'welcome?pesan=belumlogin');
		}
	}

	function index(){
		$data['anggota'] = $this->m_perpus->get_data('anggota')->result();
		$data['buku'] = $this->m_perpus->get_data('buku')->result();
		$data['header'] = 'Katalog Buku';
		$this->load->view('daftarbuku', $data);
	}

	function home2(){
		$data['anggota'] = $this->m_perpus->get_data('anggota')->result();
		$data['buku'] = $this->db->query("select * from buku where jumlah_buku>'5'")->result();
		$data['header'] = 'Katalog Buku';
		$this->load->view('daftarbuku2', $data);
	}
}
