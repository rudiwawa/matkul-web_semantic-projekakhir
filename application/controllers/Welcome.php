<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $data = array(
            'sidebar'=>'Sidebar_mahasiswa',
            'content' => 'Login',
        );
        $this->load->view('index', $data);
    }
    public function dasboard()
    {
        $data = array(
            'sidebar'=>'Sidebar_mahasiswa',
            'content' => 'Dashboard',
        );
        $this->load->view('index', $data);
    }
    public function daftarPKL()
    {
        $data = array(
            'sidebar'=>'Sidebar_mahasiswa',
            'content' => 'DaftarPKL',
        );
        $this->load->view('index', $data);
    }
    public function progresPKL()
    {
        $data = array(
            'sidebar'=>'Sidebar_mahasiswa',
            'content' => 'ProgresPKL',
        );
        $this->load->view('index', $data);
    }
    public function laporanPKL()
    {
        $data = array(
            'sidebar'=>'Sidebar_mahasiswa',
            'content' => 'LaporanPKL',
        );
        $this->load->view('index', $data);
    }

    public function formDaftarPKL()
    {
        $data = array(
            'sidebar'=>'Sidebar_mahasiswa',
            'content' => 'formDaftarPKL',
        );
        $this->load->view('index', $data);
    }
    public function formDaftarSemhas()
    {
        $data = array(
            'sidebar'=>'Sidebar_mahasiswa',
            'content' => 'formDaftarSemhas',
        );
        $this->load->view('index', $data);
    }
    public function formLogbook()
    {
        $data = array(
            'sidebar'=>'Sidebar_mahasiswa',
            'content' => 'formLogbook',
        );
        $this->load->view('index', $data);
    }
    public function logbookPKL()
    {
        $data = array(
            'sidebar'=>'Sidebar_mahasiswa',
            'content' => 'logbookPKL',
        );
        $this->load->view('index', $data);
    }
    public function pkl_lihat_kelompok()
    {
        $data = array(
            'sidebar'=>'Sidebar_dosen',
            'content' => 'pkl_lihat_kelompok',
        );
        $this->load->view('index', $data);
    }

    public function pkl_lihat_dosbing()
    {
        $data = array(
            'sidebar'=>'Sidebar_dosen',
            'content' => 'pkl_pilih_dosbing',
        );
        $this->load->view('index', $data);
    }
    public function ValidasiPembimbing()
    {
        $data = array(
            'sidebar'=>'Sidebar_akademik',
            'content' => 'ValidasiPembimbing',
        );
        $this->load->view('index', $data);
    }
    public function ValidasiSemhasPkl()
    {
        $data = array(
            'sidebar'=>'Sidebar_akademik',
            'content' => 'ValidasiSemhasPkl',
        );
        $this->load->view('index', $data);
    }
    public function profil()
    {
        $data = array(
            'sidebar'=>'Sidebar_mahasiswa',
            'content' => 'profil',
        );
        $this->load->view('index', $data);
    }
}
