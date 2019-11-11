<?php
use GuzzleHttp\Client;

class Ongkir_model extends CI_model 
{
    private $_client;

    public function __construct()
    {
        parent::__construct();
        $this->_client = new Client([
            'base_uri' => 'https://api.rajaongkir.com/starter/'
        ]);
    }

    public function daftar_kota()
    {
        $response = $this->_client->request('GET', 'city', [
            'query' => [
                'key' => 'dc58e9376348f84d8e5118f77abf1a67'
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), TRUE);
        return $result['rajaongkir']['results'];
    }

    public function cek_ongkir($input)
    {
        $data = [
            "key" => 'dc58e9376348f84d8e5118f77abf1a67',
            "origin" => $input['kota_asal'],
            "destination" => $input['kota_tujuan'],
            "weight" => $input['berat'],
            "courier" => $input['kurir']
        ];
        
        $response = $this->_client->request('POST', 'cost', [
            'form_params' => $data
        ]);

        $result = json_decode($response->getBody()->getContents(), TRUE);
        return $result['rajaongkir']['results'];
    }
}
