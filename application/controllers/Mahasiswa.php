<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
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
    public function __construct()
    {
        parent::__construct();
       
    }
    protected  $sidebar_mahasiswa = 'Sidebar_mahasiswa';

    public function index()
    {
        $data = array(
            'sidebar' => $this->sidebar_mahasiswa ,
            'content' => 'Login',
        );
        $this->load->view('index', $data);
    }

    public function login()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $this->load->model('M_mahasiswa');
        $this->M_mahasiswa->login_mahasiswa($username, $password);
    }

    public function logout()
    {
        
        $this->session->unset_userdata('uname');
        $this->session->unset_userdata('name');
        $this->session->unset_userdata('status');
        redirect('Mahasiswa/index');
    }

    public function dasboard()
    {
        $data = array(
            'sidebar' => $this->sidebar_mahasiswa,
            'content' => 'Dashboard',
        );
        $this->load->view('index', $data);
    }
    public function daftarPKL()
    {
        $data = array(
            'sidebar' => $this->sidebar_mahasiswa,
            'content' => 'DaftarPKL',
        );
        $this->load->view('index', $data);
    }
    public function progresPKL()
    {
        $data = array(
            'sidebar' => $this->sidebar_mahasiswa,
            'content' => 'ProgresPKL',
        );
        $this->load->view('index', $data);
    }
    public function laporanPKL()
    {
        $data = array(
            'sidebar' => $this->sidebar_mahasiswa,
            'content' => 'LaporanPKL',
        );
        $this->load->view('index', $data);
    }
    public function formDaftarPKL()
    {
        $data = array(
            'sidebar' => $this->sidebar_mahasiswa,
            'content' => 'formDaftarPKL',
        );
        $this->load->view('index', $data);
    }
    public function formDaftarSemhas()
    {
        $data = array(
            'sidebar' => $this->sidebar_mahasiswa,
            'content' => 'formDaftarSemhas',
        );
        $this->load->view('index', $data);
    }
    public function formLogbook()
    {
        $data = array(
            'sidebar' => $this->sidebar_mahasiswa,
            'content' => 'formLogbook',
        );
        $this->load->view('index', $data);
    }
    public function logbookPKL()
    {
        $data = array(
            'sidebar' => $this->sidebar_mahasiswa,
            'content' => 'logbookPKL',
        );
        $this->load->view('index', $data);
    }
    public function profil()
    {
        $data = array(
            'sidebar' => $this->sidebar_mahasiswa,
            'content' => 'profil',
        );
        $this->load->view('index', $data);
    }
}
