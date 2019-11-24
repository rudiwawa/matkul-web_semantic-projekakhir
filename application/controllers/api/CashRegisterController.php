<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CashRegisterController     extends CI_Controller
{
    protected $date;
    protected $tabel = 'cash_flow';
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->model('CashRegister_model');
        // $this->date = new DateTime();
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
    public function get()
    {
        // $this->is_valid();
        $id =  $this->input->post('cash_flow_id');
        $res = $this->Master->get($this->tabel, array('id' => $id));
        $res['data']['open']=date('d F Y H:i:s', strtotime($res['data']['open']));
        // foreach ($res as $key => $value) {
            // $res[0]['open']=date('d F Y', strtotime($res[0]['open']));
        // }
        $res['data']['data_pegawai'] = json_decode($res['data']['data_pegawai']);
        if ($res['status']) {
            $this->msg('data', '200', $res['data']);
        } else {
            $this->msg('data', '400', '', $res['data']['message']);
            // $this->msg('data', '400',$res);
        };
    }

    /*
     * Adding a new metode_pembayaran
     */
    function open()
    {
        $id_pegawai = $this->input->post('id_pegawai');
        if (isset($_POST) && count($_POST) > 0) {
            $params = array(
                'responsible_id' => $this->input->post('responsible_id'),
                'open' => date('Y-m-d H:i:s'),
                'open_cash' => $this->input->post('open_cash'),
                'data_pegawai' => json_encode($this->Master->get('pegawai', array('id' => $id_pegawai))),
                'status' => 'progress',
            );

            $run = $this->Master->add($this->tabel, $params);
            $res = $run['data'];
            if ($run['status']) {
                $this->msg('data', '200', $res);
            } else {
                $this->msg('data', '400', '', $res);
                // $this->msg('data', '400',$run);
            };
        } else {
            $this->msg('data', '404', '');
        }
    }


    /*
     * Editing a metode_pembayaran
     */
    function close()
    {
        $id = $this->input->post('id');
        if (isset($_POST) && count($_POST) > 0) {
            $params = array(
                'close' => date('Y-m-d H:i:s'),
                'close_cash' => $this->input->post('close_cash'),
                'status' => 'unvalidated',
            );
            $is_progress =  $this->Master->get_select($this->tabel, array('status'), array('id' => $id));
            // var_dump($is_progress);
            if ($is_progress['status']) {
                if ($is_progress['data']['status'] == 'progress') {
                    $run = $this->Master->update($this->tabel, array('id' => $id), $params);
                    $this->msg('data', '200', $run['data']);
                    if ($run['status']) {
                        $this->msg('data', '200', $run['data']);
                    } else {
                        $this->msg('data', '400', '', $run['data']);
                        // $this->msg('data', '400',$run);
                    };
                } else {
                    $this->msg('data', '300', '', 'Anda tidak dapat melakukan close register. Anda harus open register terlebih dahulu' . $is_progress['data']['status']);
                }
            } else {
                $this->msg('data', '400', $id, $is_progress['data']['message']);
            }
        } else {
            $this->msg('data', '400', '');
        }
    }

    /*
     * Deleting metode_pembayaran
     */
    function remove()
    {
        $id =  $this->input->post('id');
        $metode_pembayaran = $this->Master->get($this->tabel, array('id' => $id));

        // check if the metode_pembayaran exists before trying to delete it
        if (isset($metode_pembayaran['id'])) {
            if ($this->Master->delete($this->tabel, array('id' => $id))) {
                $this->msg('data', '200', '');
            };
        } else
            $this->msg('data', '404', '');
    }
}
