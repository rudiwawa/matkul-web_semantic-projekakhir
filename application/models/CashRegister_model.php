<?php

class CashRegister_model extends CI_Model
{
    //referense https://codeigniter.com/user_guide/general/models.html
    protected $users = 'pegawai';
    protected $cashflow = 'cash_flow';
    protected $date;
    public function __construct()
    {
        parent::__construct();
        $this->date = new DateTime();
    }



    
}
