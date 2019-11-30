<?php
defined('BASEPATH') or exit('No direct script access allowed');
// require_once(APPPATH.'libraries/Httpful.phar');
class Dosen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_dosen');
        $this->load->helper('form');
        $this->date = new DateTime();
    }

    public function index(Type $var = null)
    {
        $this->pkl_lihat_kelompok();
    }
    public function pkl_lihat_kelompok()
    {
        $res = $this->M_dosen->get_lihat_kelompok();
        $res = $this->groub_by_kelompok('kelompok', $res);
        // var_dump($res);
        // foreach ($res as $key => $value) {
        //     var_dump($value);
        // }
        $data = array(
            'data' => $res,
            'sidebar' => 'Sidebar_dosen',
            'content' => 'pkl_lihat_kelompok',
        );
        $this->load->view('index', $data);
    }

    public function pkl_lihat_dosbing()
    {
        $res = $this->M_dosen->pkl_lihat_dosbing();
        $res = $this->groub_by_kelompok('kelompok', $res);
        // var_dump($res);
        $data = array(
            'data' => $res,
            'sidebar' => 'Sidebar_dosen',
            'content' => 'pkl_pilih_dosbing',
        );
        $this->load->view('index', $data);
    }
    public function pkl_lihat_dosbing_action()
    {
        $res = $this->M_dosen->getAll_dosen_pembimbing();
        // $res = $this->groub_by_kelompok('kelompok', $res);
        // var_dump($res);
        $data = array(
            'data' => $res,
            'sidebar' => 'Sidebar_dosen',
            'content' => 'pkl_pilih_dosbing_action',
        );
        $this->load->view('index', $data);
    }
    public function pkl_lihat_dosbing_save()
    {
        $res = $this->M_dosen->getAll_dosen_pembimbing();

        $data = array(
            'data' => $res,
            'sidebar' => 'Sidebar_dosen',
            'content' => 'pkl_pilih_dosbing_action',
        );
        $this->load->view('index', $data);
    }
    public function input_nilai()
    {
        // $res = $this->M_dosen->get_lihat_kelompok();
        // $res = $this->groub_by_kelompok('kelompok', $res);
        $data = array(
            // 'data' => $res,
            'sidebar' => 'Sidebar_dosen',
            'content' => 'input_nilai',
        );
        $this->load->view('index', $data);
    }

    function groub_by_kelompok($by, $data)
    {
        $tmp = array();
        // $tmp[]['value'] = array();
        $c = -1;
        // $tmp[]['value'] = array();
        foreach ($data as $key => $value) {
            $trim = "http://www.semanticweb.org/kharis/ontologies/2019/10/pkl-filkom#";
            $found = false;
            foreach ($tmp as $key => $tmp2) {
                if ($value[$by]['value'] == $tmp2['kelompok']) {
                    $found = true;
                }
            }
            // echo "found".$found."<br>";
            if (!$found) {
                $tmp_id = $value[$by]['value'];
                array_push($tmp, ['kelompok' => $tmp_id]);
                $c++;
                // echo "c=$c";
                array_push($tmp[$c], ['data' => $value]);
            } else {
                // $swith=true;
                // echo "KETEMU";
                array_push($tmp[$c], ['data' => $value]);
            }
        }
        return $tmp;
        // var_dump($c);
        // var_dump($tmp);
    }
}
