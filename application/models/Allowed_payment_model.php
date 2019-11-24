<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */

class Allowed_payment_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    //THE MASTER OF THE MASTER
    /*
     * Get allowed_payment by id
     */
    public function get($tabel, $where)
    {
        $run = $this->db->get_where($tabel, $where)->row_array();
        $res = array();
        if (!isset($run)) {
            $res['data']['message'] = 'data not exist ->tabel_' . $tabel;
            $res['status'] = false;
        } else {
            $res['data'] = $run;
            $res['status'] = true;
        }
        return $res;
    }

    public function get_select($tabel, $select, $where)
    {
        $this->db->select($select);
        $run = $this->db->get_where($tabel, $where)->row_array();
        $res = array();
        if (!isset($run)) {
            $res['data']['message'] = 'data not exist';
            $res['status'] = false;
        } else {
            $res['data'] = $run;
            $res['status'] = true;
        }
        return $res;
    }
    function get_where_cabang_id($cabang_id)
    {
        $this->db->select('mp.*');
        $this->db->from('allowed_payment as ap');
        $this->db->join('metode_pembayaran as mp', 'ap.metode_pembayaran_id = mp.id');
        $this->db->where('ap.cabang_id', $cabang_id);
        $query =  $this->db->get();
        return $query->result_array();
    }
    /*
     * Get all allowed_payment
     */
    public function get_all()
    {
        $query = $this->db->query("SELECT cabang_id, JSON_ARRAYAGG(metode_pembayaran_id) AS metode_pembayaran_id 
        FROM allowed_payment GROUP BY cabang_id;");
        return $query->result_array();
    }
}
