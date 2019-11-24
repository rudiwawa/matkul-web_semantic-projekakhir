<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Diskon extends CI_Controller
{
    protected $date;
    protected $tabel = 'diskon';
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        // $this->load->model('user');
        $this->date = new DateTime();
        // $this->load->library('Msg');
        //==== ALLOWING CORS
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
    }
    public function msg($name, $status, $data, $custom_msg = '')
    {
        $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($this->msg->get($name, $status, $data, $custom_msg), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit;
    }

    function is_valid()
    {
        if (isset($_POST) && count($_POST) <= 0) {
            $this->msg('', '400', '', 'tidak ada masukan');
        }
    }

    public function get_all()
    {
        $this->msg('data', '200', $this->Master->get_all($this->tabel));
    }

    public function get()
    {
        $this->is_valid();
        $id =  $this->input->post('id');
        $res = $this->Master->get($this->tabel, array('id' => $id));
        if ($res['status']) {
            $this->msg('data', '200', $res['data']);
        } else {
            $this->msg('data', '400', '', $res['data']['message']);
            // $this->msg('data', '400',$res);
        };
    }

    public function get_available()
    {
        $now = date('Y-m-d');
        // $this->is_valid();
        $res = $this->Master->get_all($this->tabel, array('sisa_kuota >'=>0,'mulai <='=>$now,'akhir >='=>$now),array('create_at','DESC'));
        // if ($res['status']) {
        $this->msg('data', '200', $res);
        // } else {
        // $this->msg('data', '400', '', $res['data']['message']);
        // $this->msg('data', '400',$res);
        // };
    }



    /*
     * Adding a new produk
     */
    function add()
    {
        $this->is_valid();
        $params = array(
            'kode_diskon' => $this->input->post('kode_diskon'),
            'nama' => $this->input->post('nama'),
            'detail' => $this->input->post('detail'),
            'mulai' => $this->input->post('mulai'),
            'akhir' => $this->input->post('akhir'),
            'potongan' => $this->input->post('potongan'),
            'kuota' => $this->input->post('kuota'),
            'sisa_kuota' => $this->input->post('kuota'),
            // 'potongan' => $this->input->post('potongan'),
            'create_at' => date('Y-m-d H:i:s'),
            'update_at' => date('Y-m-d H:i:s'),
        );


        $res = $this->Master->add($this->tabel, $params);
        if ($res['status']) {
            $this->msg('data', '200', $res['data']);
        } else {
            $this->msg('data', '400', '', $res['data']['message']);
        };
    }

    /*
     * Editing a produk
     */
    function edit()
    {
        $this->is_valid();
        // $this->msg('data', '200', $this->input->post('nama'));
        // check if the produk exists before trying to edit it
        $id =  $this->input->post('id');
        $data = array(
            'kode_diskon' => $this->input->post('kode_diskon'),
            'nama' => $this->input->post('nama'),
            'detail' => $this->input->post('detail'),
            'mulai' => $this->input->post('mulai'),
            'akhir' => $this->input->post('akhir'),
            'potongan' => $this->input->post('potongan'),
            'kuota' => $this->input->post('kuota'),
            'sisa_kuota' => $this->input->post('kuota'),
            'potongan' => $this->input->post('potongan'),
            // 'create_at' => date('Y-m-d H:i:s'),
            'update_at' => date('Y-m-d H:i:s'),

        );
        $res = $this->Master->update($this->tabel,  array('id' => $id), $data);
        if ($res['status']) {
            $this->msg('data', '200', $res['data']);
        } else {
            $this->msg('data', '400', '', $res['data']['message']);
        };
    }

    /*
     * Deleting produk
     */
    function remove()
    {
        $this->is_valid();
        $id =  $this->input->post('id');
        $res = $this->Master->delete($this->tabel, array('id' => $id));

        if ($res['status']) {
            $this->msg('data', '200', $res['data']);
        } else {
            $this->msg('data', '400', '', $res['data']['message']);
        };
    }
}
