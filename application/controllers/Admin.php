<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    //cek Login
    if($this->session->userdata('status') != "login"){
      $alert=$this->session->set_flashdata('alert', 'Anda belum Login');
      redirect(base_url().'welcome?pesan=belumlogin');
    }
  }

  function index(){
    $data['peminjaman'] = $this->db->query("select * from peminjaman order by id_pinjam desc limit 10")->result();
    $data['anggota'] = $this->db->query("select * from anggota order by id_anggota desc limit 10")->result();
    $data['buku'] = $this->db->query("select * from buku order by id_buku desc limit 10")->result();

    $this->load->view('admin/header');
    $this->load->view('admin/index',$data);
    $this->load->view('admin/footer');
  }

  function logout(){
    $this->session->sess_destroy();
    redirect(base_url().'welcome?pesan=logout');
  }

  function ganti_profile(){
    $this->load->view('admin/header');
    $this->load->view('admin/ganti_profile');
    $this->load->view('admin/footer');
  }

  function ganti_profile_act(){
    $nama = $this->input->post('nama');
    $username = $this->input->post('username');
    $pass_baru = $this->input->post('pass_baru');
    $ulang_pass = $this->input->post('ulang_pass');

    $this->form_validation->set_rules('nama','Ulangi Nama Baru','required');
    $this->form_validation->set_rules('username','Ulangi Username Baru','required');
    $this->form_validation->set_rules('pass_baru','Password Baru','required|matches[ulang_pass]');
    $this->form_validation->set_rules('ulang_pass','Ulangi Password Baru','required');
    if($this->form_validation->run() != false){
      $data = array(
        'nama_admin' => $nama,
        'username' => $username,
        'password' =>md5($pass_baru)
      );
      $w = array('id_admin' => $this->session->userdata('id'));
      $this->m_perpus->update_data('admin',$data,$w);
      redirect(base_url().'admin/ganti_profile?pesan=berhasil');
    }else{
      $this->load->view('admin/header');
      $this->load->view('admin/ganti_profile');
      $this->load->view('admin/footer');
    }
    }

    function buku(){
      $data['buku'] = $this->m_perpus->get_data('buku')->result();
      $this->load->view('admin/header');
      $this->load->view('admin/buku',$data);
      $this->load->view('admin/footer');
    }

    function tambah_buku(){
      $data['kategori'] = $this->m_perpus->get_data('kategori')->result();
      $this->load->view('admin/header');
      $this->load->view('admin/tambahbuku',$data);
      $this->load->view('admin/footer');
    }

    function tambah_buku_act(){
      $tgl_input = date('Y-m-d');
      $id_kategori = $this->input->post('id_kategori');
      $judul = $this->input->post('judul_buku');
      $pengarang = $this->input->post('pengarang');
      $penerbit = $this->input->post('penerbit');
      $thn_terbit = $this->input->post('thn_terbit');
      $isbn = $this->input->post('isbn');
      $jumlah_buku = $this->input->post('jumlah_buku');
      $lokasi = $this->input->post('lokasi');
      $status = $this->input->post('status');
      $this->form_validation->set_rules('id_kategori','Kategori','required');
      $this->form_validation->set_rules('judul_buku','Judul Buku','required');
      $this->form_validation->set_rules('status','Status Buku','required');
      if($this->form_validation->run() != false){
        //configurasi upload Gambar
        $config['upload_path'] = './assets/upload/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '2048';
        $config['file_name'] = 'gambar'.time();

        $this->load->library('upload',$config);

        if($this->upload->do_upload('foto')){
          $image = $this->upload->data();

          $data = array(
            'id_kategori' => $id_kategori,
            'judul_buku' => $judul,
            'pengarang' => $pengarang,
            'penerbit' => $penerbit,
            'thn_terbit' => $thn_terbit,
            'isbn' => $isbn,
            'jumlah_buku' => $jumlah_buku,
            'lokasi' => $lokasi,
            'gambar' => $image['file_name'],
            'tgl_input' => $tgl_input,
            'status_buku' => $status
          );
          $this->m_perpus->insert_data($data,'buku');
          redirect(base_url().'admin/buku');
        }else{
          $this->load->view('admin/header');
          $this->load->view('admin/tambahbuku');
          $this->load->view('admin/footer');
        }
      }
    }

      function hapus_buku($id){
        $where = array('id_buku' => $id);
        $this->m_perpus->delete_data($where,'buku');
        redirect(base_url().'admin/buku');
      }

    function edit_buku($id){
      $where = array('id_buku' =>$id);
      $data['buku'] = $this->db->query("select * from buku B, kategori K where B.id_kategori=K.id_kategori and B.id_buku='$id'")->result();
      $data['kategori'] =$this->m_perpus->get_data('kategori')->result();

      $this->load->view('admin/header');
      $this->load->view('admin/editbuku',$data);
      $this->load->view('admin/footer');
    }

    function update_buku(){
      $id = $this->input->post('id');
      $id_kategori = $this->input->post('id_kategori');
      $judul = $this->input->post('judul_buku');
      $pengarang = $this->input->post('pengarang');
      $penerbit = $this->input->post('penerbit');
      $thn_terbit = $this->input->post('thn_terbit');
      $isbn = $this->input->post('isbn');
      $jumlah_buku = $this->input->post('jumlah_buku');
      $lokasi = $this->input->post('lokasi');
      $status = $this->input->post('status');

      $this->form_validation->set_rules('id_kategori','ID Kategori','required');
      $this->form_validation->set_rules('judul_buku','Judul Buku','required|min_length[4]');
      $this->form_validation->set_rules('pengarang','Pengarang','required|min_length[4]');
      $this->form_validation->set_rules('penerbit','Penerbit','required|min_length[4]');
      $this->form_validation->set_rules('thn_terbit','Tahun Terbit','required|min_length[4]');
      $this->form_validation->set_rules('isbn','Nomor ISBN','required|numeric');
      $this->form_validation->set_rules('jumlah_buku','Jumlah Buku','required|numeric');
      $this->form_validation->set_rules('lokasi','Lokasi Buku','required|min_length[4]');
      $this->form_validation->set_rules('status','Status Buku','required');

      if($this->form_validation->run() != false){
          $config['upload_path'] = './assets/upload/';
          $config['allowed_types'] = 'jpg|png|jpeg';
          $config['max_size'] = '2048';
          $config['file_name'] = 'gambar'.time();

          $this->load->library('upload',$config);

          $where = array('id_buku' => $id);
          $data = array(
            'id_kategori' =>$id_kategori,
            'judul_buku' =>$judul,
            'pengarang' =>$pengarang,
            'penerbit' =>$penerbit,
            'thn_terbit' =>$thn_terbit,
            'isbn' =>$isbn,
            'jumlah_buku' =>$jumlah_buku,
            'lokasi' =>$lokasi,
            'gambar' =>$image['file_name'],
            'status_buku' =>$status
          );

           if($this->upload->do_upload('foto')){
              //proses upload Gambar
              $image = $this->upload->data();
              unlink('assets/upload/'.$this->input->post('old_pict',TRUE));
              $data['gambar'] = $image['file_name'];

              $this->m_perpus->update_data('buku',$data,$where);
            } else{
              $this->m_perpus->update_data('buku',$data,$where);
            }

          $this->m_perpus->update_data('buku',$data,$where);
          redirect(base_url().'admin/buku');
        } else{
            $where = array('id_buku' =>$id);
            $data['buku'] = $this->db->query("select * from buku B, kategori K where B.id_kategori=K.id_kategori and B.id_buku='$id'")->result();
            $data['kategori'] = $this->m_perpus->get_data('kategori')->result();
            $this->load->view('admin/header');
            $this->load->view('admin/editbuku',$data);
            $this->load->view('admin/footer');
        }
    }

    function anggota(){
      $data['anggota'] = $this->m_perpus->get_data('anggota')->result();
      $this->load->view('admin/header');
      $this->load->view('admin/anggota',$data);
      $this->load->view('admin/footer');
    }

    function tambah_anggota(){
      $this->load->view('admin/header');
      $this->load->view('admin/tambahanggota');
      $this->load->view('admin/footer');
    }

    function tambah_anggota_act(){
      $username = $this->input->post('username');
      $nama_anggota = $this->input->post('nama_anggota');
      $gender = $this->input->post('gender');
      $no_telp = $this->input->post('no_telp');
      $alamat = $this->input->post('alamat');
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      $this->form_validation->set_rules('username','Username','required');
      $this->form_validation->set_rules('nama_anggota','Nama Anggota','required');
      $this->form_validation->set_rules('no_telp','No.Telpon','required');
      $this->form_validation->set_rules('alamat','Alamat','required');
      $this->form_validation->set_rules('email','Email','required');
      $this->form_validation->set_rules('password','Password','required');
      if($this->form_validation->run() != false){
          $data = array(
            'username' => $username,
            'nama_anggota' => $nama_anggota,
            'gender' => $gender,
            'no_telp' => $no_telp,
            'alamat' => $alamat,
            'email' => $email,
            'password' => md5($password),
          );
          $this->m_perpus->insert_data($data,'anggota');
          redirect(base_url().'admin/anggota');
        }else{
          $this->load->view('admin/header');
          $this->load->view('admin/tambahanggota');
          $this->load->view('admin/footer');
        }
      }

      function edit_anggota($id){
        $where = array('id_anggota' =>$id);
        $data['anggota'] = $this->db->query("select * from anggota where id_anggota='$id'")->result();

        $this->load->view('admin/header');
        $this->load->view('admin/editanggota',$data);
        $this->load->view('admin/footer');
      }

      function update_anggota(){
        $id = $this->input->post('id');
        $username = $this->input->post('username');
        $nama_anggota = $this->input->post('nama_anggota');
        $gender = $this->input->post('gender');
        $no_telp = $this->input->post('no_telp');
        $alamat = $this->input->post('alamat');
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $this->form_validation->set_rules('username','Username','required');
        $this->form_validation->set_rules('nama_anggota','Nama Anggota','required');
        $this->form_validation->set_rules('no_telp','No.Telpon','required');
        $this->form_validation->set_rules('alamat','Alamat','required');
        $this->form_validation->set_rules('email','Email','required');
        $this->form_validation->set_rules('password','Password','required');

        if($this->form_validation->run() != false){
            $where = array('id_anggota' => $id);
            $data = array(
              'username' => $username,
              'nama_anggota' => $nama_anggota,
              'gender' => $gender,
              'no_telp' => $no_telp,
              'alamat' => $alamat,
              'email' => $email,
              'password' => md5($password),
            );

            $this->m_perpus->update_data('anggota',$data,$where);
            redirect(base_url().'admin/anggota');
          } else{
              $where = array('id_anggota' =>$id);
              $data['anggota'] = $this->db->query("select * from anggota where id_anggota='$id'")->result();
              $this->load->view('admin/header');
              $this->load->view('admin/editanggota',$data);
              $this->load->view('admin/footer');
          }
      }

      function kategori(){
		$data['kategori'] = $this->m_perpus->get_data('kategori')->result();
		$this->load->view('admin/header');
		$this->load->view('admin/kategori',$data);
		$this->load->view('admin/footer');
	}

	function tambah_kategori(){
		$this->load->view('admin/header');
		$this->load->view('admin/tambahkategori');
		$this->load->view('admin/footer');
	}

	function tambah_kategori_act(){
		$nama = $this->input->post('nama_kategori');
		
		$this->form_validation->set_rules('nama_kategori','Nama Kategori','required');
		if($this->form_validation->run() != false){
			$data = array(
				'nama_kategori' => $nama
			);
		
			$this->m_perpus->insert_data($data,'kategori');
			redirect(base_url().'admin/kategori');
		}else{
			$this->load->view('admin/header');
			$this->load->view('admin/tambahkategori');
			$this->load->view('admin/footer');
		}
	}

	function edit_kategori($id){
		$where = array('id_kategori' => $id);
		$data['kategori'] = $this->m_perpus->edit_data($where,'kategori')->result();

		$this->load->view('admin/header');
		$this->load->view('admin/editkategori',$data);
		$this->load->view('admin/footer');
	}

	function update_kategori(){
		$id = $this->input->post('id');
		$nama = $this->input->post('nama_kategori');

		$this->form_validation->set_rules('nama_kategori','Nama Kategori','required');
		if($this->form_validation->run() != false){
			$where = array('id_kategori' => $id);
			$data = array(
				'nama_kategori' => $nama
			);
			$this->m_perpus->update_data($where,$data,'kategori');
			redirect(base_url().'admin/kategori');
		}else{
			$where = array('id_kategori' => $id);
			$data['kategori'] = $this->m_perpus->edit_data($where,'kategori')->result();
			$this->load->view('admin/header');
			$this->load->view('admin/editkategori',$data);
			$this->load->view('admin/footer');
		}
	}

	function hapus_kategori($id){
		$where = array('id_kategori' => $id);
		$this->m_perpus->delete_data($where,'kategori');
		redirect(base_url().'admin/kategori');
	}

      function peminjaman(){
        $data['peminjaman'] = $this->m_perpus->get_data('peminjaman')->result();

        $this->load->view('admin/header');
        $this->load->view('admin/peminjaman',$data);
        $this->load->view('admin/footer');
      }

      function tambah_peminjaman(){
        $w = array('status_buku'=>'1');
        $data['buku'] = $this->m_perpus->edit_data($w,'buku')->result();
        $data['anggota'] = $this->m_perpus->get_data('anggota')->result();
        $data['peminjaman'] = $this->m_perpus->get_data('transaksi')->result();

        $this->load->view('admin/header');
        $this->load->view('admin/tambah_peminjaman',$data);
        $this->load->view('admin/footer');
      }

      function tambah_peminjaman_act(){
        $tgl_pencatatan = date('Y-m-d H:i:s');
        $anggota = $this->input->post('anggota');
        $buku = $this->input->post('buku');
        $tgl_pinjam = $this->input->post('tgl_pinjam');
        $tgl_kembali = $this->input->post('tgl_kembali');
        $denda = $this->input->post('denda');
        $this->form_validation->set_rules('anggota','Anggota','required');
        $this->form_validation->set_rules('buku','Buku','required');
        $this->form_validation->set_rules('tgl_pinjam','Tanggal Pinjam','required');
        $this->form_validation->set_rules('tgl_kembali','Tanggal Kembali','required');
        $this->form_validation->set_rules('denda','Denda','required');
        if($this->form_validation->run() != false){
            $data = array(
              'tgl_pencatatan' => $tgl_pencatatan,
              'id_anggota' => $anggota,
              'id_buku' => $buku,
              'tgl_pinjam' => $tgl_pinjam,
              'tgl_kembali' => $tgl_kembali,
              'denda' => $denda,
              'tgl_pengembalian' => '0000-00-00',
              'total_denda' => '0',
              'status_pengembalian' =>'0',
              'status_peminjaman' =>'0'
            );
            $this->m_perpus->insert_data($data,'transaksi');

            $d = array('status_buku' =>'0','tgl_input' => substr($tgl_pencatatan,0,10));
            $w = array('id_buku' => $buku);
            $this->m_perpus->update_data('buku',$d,$w);
            redirect(base_url().'admin/peminjaman');
          }else{
            $w = array('status_buku' => '1');
            $data['buku'] = $this->m_perpus->edit_data($w,'buku')->result();
            $data['anggota'] = $this->m_perpus->get_data('anggota')->result();

            $this->load->view('admin/header');
            $this->load->view('admin/tambah_peminjaman',$data);
            $this->load->view('admin/footer');
          }
        }

        function transaksi_hapus($id){
          $w = array('id_pinjam' => $id);
          $data = $this->m_perpus->edit_data($w,'peminjaman')->row();
          $ww = array('id_buku' => $data->id_buku);
          $data2 = array('status_buku' => '1');
          $this->m_perpus->update_data('buku',$data2,$ww);
          $this->m_perpus->delete_data($w,'peminjaman','detail_pinjam');
          redirect(base_url().'admin/peminjaman');
        }

        function transaksi_selesai($id){
          $data['buku'] = $this->m_perpus->get_data('buku')->result();
          $data['anggota'] = $this->m_perpus->get_data('anggota')->result();
          $data['peminjaman'] = $this->db->query("select * from peminjaman p, detail_pinjam d, anggota a, buku b where d.id_buku = b.id_buku and p.id_anggota=a.id_anggota and p.id_pinjam=d.id_pinjam and p.id_pinjam='$id' limit 1")->result();

          $this->load->view('admin/header');
          $this->load->view('admin/transaksi_selesai',$data);
          $this->load->view('admin/footer');
        }

        function transaksi_selesai_act(){
          $id = $this->input->post('id');
          $tgl_dikembalikan = $this->input->post('tgl_dikembalikan');
          $tgl_kembali = $this->input->post('tgl_kembali');
          $buku = $this->input->post('buku');
          $denda = $this->input->post('denda');
          $this->form_validation->set_rules('tgl_dikembalikan','Tanggal dikembalkan','required');

          if($this->form_validation->run() !=false){
            //hitung selisih hari
            $batas_kembali = strtotime($tgl_kembali);
            $dikembalikan = strtotime($tgl_dikembalikan);
            $selisih = abs(($dikembalikan-$batas_kembali)/(60*60*24));
            $total_denda = $denda*$selisih;
            //update status Peminjaman
            $data = array('status_peminjaman' => 'Selesai','totaldenda' => $total_denda,'tgl_pengembalian' => $tgl_dikembalikan,'status_pengembalian' => 'Kembali');
            $w = array('id_pinjam' =>$id);
            $this->m_perpus->update_data('peminjaman',$data,$w);
            //update status Buku
            $data2 = array('status_buku' => '1');
            $w2 = array('id_buku' => $buku);
            $this->m_perpus->update_data('buku',$data2,$w2);

            redirect(base_url().'admin/peminjaman');
          }else{
            $data['buku'] = $this->m_perpus->get_data('buku')->result();
            $data['anggota'] = $this->m_perpus->get_data('anggota')->result();
            $data['peminjaman'] = $this->db->query("select * from peminjaman p, anggota a, detail_pinjam d, buku b where p.id_anggota = a.id_anggota and p.id_pinjam=d.id_pinjam and d.id_buku=b.id_buku and p.id_pinjam='$id'")->result();

            $this->load->view('admin/header');
            $this->load->view('admin/transaksi_selesai',$data);
            $this->load->view('admin/footer');
          }
        }

        function cetak_laporan_buku(){
          $data['buku'] = $this->m_perpus->get_data('buku')->result();
          $this->load->view('admin/header');
          $this->load->view('admin/laporan_buku', $data);
          $this->load->view('admin/footer');
        }

        function laporan_print_buku(){
          $data['buku'] = $this->m_perpus->get_data('buku')->result();
          $this->load->view('admin/laporan_print_buku',$data);
        }

        function laporan_pdf_buku(){
          $this->load->library('dompdf_gen');

          $data['buku'] = $this->m_perpus->get_data('buku')->result();

          $this->load->view('admin/laporan_pdf_buku', $data);

         $paper_size  = 'A4'; // ukuran kertas
         $orientation = 'landscape'; //tipe format kertas potrait atau landscape
         $html = $this->output->get_output();

         $this->dompdf->set_paper($paper_size, $orientation);
         //Convert to PDF
         $this->dompdf->load_html($html);
         $this->dompdf->render();
         $this->dompdf->stream("laporan_data_buku.pdf", array('Attachment'=>0));
         // nama file pdf yang di hasilkan
        }

        Function cetak_laporan_anggota(){
          $data['anggota'] = $this->m_perpus->get_data('anggota')->result();
          $this->load->view('admin/header');
          $this->load->view('admin/laporan_anggota', $data);
          $this->load->view('admin/footer');
        }

        function laporan_print_anggota(){
          $data['anggota'] = $this->m_perpus->get_data('anggota')->result();
          $this->load->view('admin/laporan_print_anggota',$data);
        }

        function laporan_pdf_anggota(){
          $this->load->library('dompdf_gen');

          $data['anggota'] = $this->m_perpus->get_data('anggota')->result();

          $this->load->view('admin/laporan_pdf_anggota', $data);

         $paper_size  = 'A4'; // ukuran kertas
         $orientation = 'landscape'; //tipe format kertas potrait atau landscape
         $html = $this->output->get_output();

         $this->dompdf->set_paper($paper_size, $orientation);
         //Convert to PDF
         $this->dompdf->load_html($html);
         $this->dompdf->render();
         $this->dompdf->stream("laporan_data_anggota.pdf", array('Attachment'=>0));
         // nama file pdf yang di hasilkan
        }

        function laporan_transaksi(){
          $dari = $this->input->post('dari');
          $sampai = $this->input->post('sampai');
          $this->form_validation->set_rules('dari','Dari Tanggal','required');
          $this->form_validation->set_rules('sampai','Sampai Tanggal','required');

          if($this->form_validation->run() != false){

          $data['laporan'] = $this->db->query("select * from peminjaman p,detail_pinjam d,
          buku b,anggota a where d.id_buku=b.id_buku and p.id_anggota=a.id_anggota
          and p.id_pinjam=d.id_pinjam and date(tanggal_input) >= '$dari'")->result();

          $this->load->view('admin/header');
          $this->load->view('admin/laporan_filter_transaksi',$data);
          $this->load->view('admin/footer');
        }else{
          $this->load->view('admin/header');
          $this->load->view('admin/laporan_transaksi');
          $this->load->view('admin/footer');
        }
        }

        function laporan_print_transaksi(){
          $dari = $this->input->get('dari');
          $sampai = $this->input->get('sampai');

          if($dari != "" && $sampai != ""){
            $data['laporan'] = $this->db->query("select * from peminjaman p,detail_pinjam d,buku b,anggota a where d.id_buku=b.id_buku and p.id_anggota=a.id_anggota and p.id_pinjam=d.id_pinjam and date(tanggal_input) >= '$dari'")->result();
            $this->load->view('admin/laporan_print_transaksi',$data);
          }else{
            redirect("admin/laporan_transaksi");
          }
        }

        function laporan_pdf_transaksi(){
          $this->load->library('dompdf_gen');
          $dari = $this->input->get('dari');
          $sampai = $this->input->get('sampai');

          $data['laporan'] = $this->db->query("select * from peminjaman p,detail_pinjam d,buku b,anggota a
          where d.id_buku=b.id_buku and p.id_anggota=a.id_anggota and p.id_pinjam=d.id_pinjam and date(tanggal_input)
          >= '$dari'")->result();

         $this->load->view('admin/laporan_pdf_transaksi', $data);

         $paper_size  = 'A4'; // ukuran kertas
         $orientation = 'landscape'; //tipe format kertas potrait atau landscape
         $html = $this->output->get_output();

         $this->dompdf->set_paper($paper_size, $orientation);
         //Convert to PDF
         $this->dompdf->load_html($html);
         $this->dompdf->render();
         $this->dompdf->stream("laporan_data_transaksi.pdf", array('Attachment'=>0));
        }

        function table(){
          $data['buku'] = $this->db->query("select * from buku where status_buku='0'")->result();
          $this->load->view('admin/header');
          $this->load->view('admin/table',$data);
          $this->load->view('admin/footer');
        }

        public function table2()
        {
          $this->data['buku']=$this->m_perpus->getTable();
          $this->load->view("admin/table", $this->data , NULL);
        }

}
