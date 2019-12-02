<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akademik extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_akademik');
        $this->date = new DateTime();
    }

    public function index(Type $var = null)
    {
        $this->ValidasiPembimbing();
    }
    public function ValidasiPembimbing()
    {
        $valid = $this->M_akademik->get_ValidasiPembimbing("valid");
        $non_valid = $this->M_akademik->get_ValidasiPembimbing("non valid");
        $valid = $this->groub_by_kelompok('kelompok', $valid);
        $non_valid = $this->groub_by_kelompok('kelompok', $non_valid);
        // var_dump ($valid);
        $data = array(
            'valid' => $valid,
            'non_valid' => $non_valid,
            'sidebar'=>'Sidebar_akademik',
            'content' => 'ValidasiPembimbing',
        );
        $this->load->view('index', $data);
    }

    function ValidasiPembimbingAction()
    {
        
    }
    public function ValidasiSemhasPkl()
    {
        $valid = $this->M_akademik->get_ValidasiPembimbing("valid");
        $non_valid = $this->M_akademik->get_ValidasiPembimbing("non valid");
        $valid = $this->groub_by_kelompok('kelompok', $valid);
        $non_valid = $this->groub_by_kelompok('kelompok', $non_valid);
        $data = array(
            'valid' => $valid,
            'non_valid' => $non_valid,
            'sidebar'=>'Sidebar_akademik',
            'content' => 'ValidasiSemhasPkl',
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
