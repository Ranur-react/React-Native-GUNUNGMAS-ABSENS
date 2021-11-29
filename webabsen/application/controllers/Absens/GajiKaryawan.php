
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GajiKaryawan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status_login') == true)
            cek_user();
        else
            redirect('logout');
        $this->load->model('Absens/Mdata_jabatan');
        $this->load->model('Absens/Mdata_karyawan');
    }
    public function index()
    {
        $data = [
            'title' => 'Data Gaji & Jabatan Karyawan',
            'page'  => 'Data Jabatan',
            'small' => '',
            'urls'  => '<li class="active">Data Jabatan</li>',
            'data'  => $this->Mdata_jabatan->tampildata()
        ];
        $this->template->display('Absens/datajabatan/index', $data);
    }
    public function create()
    {
        $this->load->view('Absens/datajabatan/create', '');
    }
    public function store()
    {
        if ($this->input->is_ajax_request() == TRUE) {
            $this->form_validation->set_rules('idkaryawan', 'Id Karyawan', 'required|is_unique[karyawan.id_karyawan]');
            $this->form_validation->set_rules('namakaryawan', 'Nama Karyawan', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('nohp', 'Nomor Handphone', 'required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required');
            $this->form_validation->set_message('required', '%s tidak boleh kosong.');
            $this->form_validation->set_message('is_unique', '%s sudah digunakan.');
            if ($this->form_validation->run() == TRUE) {
                $params = $this->input->post(null, TRUE);
                $this->Mdata_karyawan->store($params);
                $json['status'] = true;
                $this->session->set_flashdata('pesan', sukses('data karyawan berhasil di simpan'));
            } else {
                $json['status'] = false;
                $json['pesan']  = $this->form_validation->error_array();
            }
            echo json_encode($json);
        } else {
            exit('data tidak bisa dieksekusi');
        }
    }
    public function edit()
    {
        $kode = $this->input->post('kode');
        $d['data'] = $this->Mdata_karyawan->shows($kode);
        $this->load->view('Absens/datakaryawan/edit', $d);
    }
    public function update()
    {
        if ($this->input->is_ajax_request() == TRUE) {
            $this->form_validation->set_rules('idkaryawan', 'Id Karyawan', 'required');
            $this->form_validation->set_rules('namakaryawan', 'Nama Karyawan', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('nohp', 'Nomor Handphone', 'required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required');
            $this->form_validation->set_message('required', '%s tidak boleh kosong.');
            $this->form_validation->set_message('is_unique', '%s sudah digunakan.');
            if ($this->form_validation->run() == TRUE) {
                $params = $this->input->post(null, TRUE);
                $this->Mdata_karyawan->update($params);
                $json['status'] = true;
                $this->session->set_flashdata('pesan', sukses('Data Karyawan berhasil diupdate'));
            } else {
                $json['status'] = false;
                $json['pesan']  = $this->form_validation->error_array();
            }
            echo json_encode($json);
        } else {
            exit('data tidak bisa dieksekusi');
        }
    }
    public function destroy($kode)
    {
        if (!$this->Mdata_karyawan->destroy($kode)) {
            $this->session->set_flashdata('pesan', danger('Anda tidak bisa menghapus data karyawan'));
        } else {
            $this->session->set_flashdata('pesan', sukses('Anda telah menghapus data karyawan'));
        }
        redirect('dk');
    }

    public function cetak()
    {
        $a = $this->uri->segment(4);
        $data = [
            'data'  => $this->Mdata_karyawan->tampildata($a),

        ];
        $this->load->view('Absens/datakaryawan/cetak', $data);
    }
}