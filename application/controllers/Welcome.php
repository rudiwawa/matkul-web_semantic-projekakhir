<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
            'content' => 'Login',
        );
        $this->load->view('index', $data);
    }
    public function dasboard()
    {
        $data = array(
            'content' => 'Dashboard',
        );
        $this->load->view('index', $data);
    }
    public function daftarPKL()
    {
        $data = array(
            'content' => 'DaftarPKL',
        );
        $this->load->view('index', $data);
    }
    public function progresPKL()
    {
        $data = array(
            'content' => 'ProgresPKL',
        );
        $this->load->view('index', $data);
    }
    public function laporanPKL()
    {
        $data = array(
            'content' => 'LaporanPKL',
        );
        $this->load->view('index', $data);
    }
    
    public function formDaftarPKL()
    {
        $data = array(
            'content' => 'formDaftarPKL',
        );
        $this->load->view('index', $data);
    }
    
    public function laporanPKL()
    {
        $data = array(
            'content' => 'LaporanPKL',
        );
        $this->load->view('index', $data);
    }
    
}
