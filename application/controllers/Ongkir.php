<?php
class Ongkir extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ongkir_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Aplikasi Cek Ongkir';        
        $data['daftar_kota'] = $this->Ongkir_model->daftar_kota();
        $input = [
            "kota_asal" => '',
            "kota_tujuan" => '',
            "berat" => '',
            "kurir" => ''
        ];

        if ($_POST) {
            $input = $this->input->post(null, true);
            $data['daftar_ongkir'] = $this->Ongkir_model->cek_ongkir($input);
        }       

        $this->load->view('templates/header', $data);
        $this->load->view('ongkir/index', compact('data', 'input'));
        $this->load->view('templates/footer');
    }
}
