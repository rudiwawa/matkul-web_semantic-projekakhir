<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment extends CI_Controller
{
    protected $date;
    protected $tabel = 'payment';
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->model('Payment_model');
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
        $data = $this->Master->get_all($this->tabel);
        foreach ($data as $key => $value) {
            $data_order = json_decode($data[$key]['data_order']);
            $data[$key]['data_customer'] = json_decode($data[$key]['data_customer'])->customer;
            // $data[$key]['data_order']=;
            $data[$key]['data_payment'] = json_decode($data[$key]['data_payment']);
        }
        $this->msg('data', '200', $data);
    }

    public function get()
    {
        $this->is_valid();
        $id =  $this->input->post('tr_id');
        $res = $this->Master->get($this->tabel, array('tr_id' => $id));
        if ($res['status']) {
            $this->msg('data', '200', $res['data']);
        } else {
            $this->msg('data', '400', '', $res['data']['message']);
            // $this->msg('data', '400',$res);
        };
    }

    public function get_setoran_hari_ini()
    {
        $this->is_valid();
        $id =  $this->input->post('responsible_id');
        $where =  array('responsible_id' => $id);
        $day =  date('Y-m-d');
        $res = $this->get_setoran_day($where, $day);
        $this->msg('data', '200', $res);
    }

    function get_omset_all_day()
    {

        $day = $this->input->post('day');
        // CAST(create_at AS DATE),responsible_id  -> GROUB BY sehingga dipastikan responsible_id atau waktu berbeda
        $arr_dt_payment = $this->Master->get_all('payment', '', '', 'responsible_id,CAST(create_at AS DATE) as create_at', '', TRUE, 'CAST(create_at AS DATE),responsible_id');
        // $this->msg('data', '200', $arr_dt_payment);
        $res = array();
        foreach ($arr_dt_payment as $key => $value) {
            // var_dump($value['responsible_id']);
            $where =  array('responsible_id' => $value['responsible_id']);
            array_push($res, $this->get_setoran_day($where, $value['create_at'], true));
            // var_dump($res);
        }
        $this->msg('data', '200', $res);
    }

    function get_setoran_day($where, $day, $all = false)
    {
        $arr_sum = $this->Payment_model->get_sum('payment as p', 'sum(total) as total,sum(p.total_payment) as total_payment,sum(p.tunai) as tunai,sum(p.non_tunai) as non_tunai,sum(p.potongan) as potongan', array('p.create_at' => $day), $where);
        $total_cash_flow = $this->Master->get_all('cash_flow', $where, array('open', 'DESC'), 'open_cash as total', array('open' => $day), FALSE);
        // $this->msg('data', '200', $arr_sum);
        if ($arr_sum) {
            $res['omset'] = (float) $arr_sum->total_payment;
            $res['tunai'] = (float) $arr_sum->tunai;
            $res['non_tunai'] = (float) $arr_sum->non_tunai;
            $res['pegawai'] = (float) $arr_sum->non_tunai;
            if ($all) {
                $res['tanggal'] = $arr_sum->create_at;
                $res['pegawai'] = $arr_sum->username;
                $res['cabang'] = $arr_sum->nama;
            }
        } else {
            $res['omset'] = 0.0;
            $res['tunai'] = 0.0;
            $res['non_tunai'] = 0.0;
        }

        if ($total_cash_flow) {
            $res['cash_register'] = (float) $total_cash_flow['total'];
        } else {
            $res['cash_register'] = 0.0;
        }

        $res['setoran_hari_ini'] = $res['cash_register'] + $res['tunai'];
        return $res;
    }

    function get_history_transaksi()
    {
        $responsible_id = $this->input->post('responsible_id');
        $day = $this->input->post('day');
        $where =  array('responsible_id' => $responsible_id);
        $res = $this->get_setoran_day($where, $day);
        $arr_ht['omset'] = $res['omset'];
        $arr_ht['tunai'] = $res['tunai'];
        $arr_ht['non_tunai'] = $res['non_tunai'];
        $arr_ht = array_merge($arr_ht, array('pembayaran' => $this->Payment_model->get_history_transaksi($day, $where)));
        $this->msg('data', '200', $arr_ht);
    }
    function get_omset_hari_ini()
    {
        $responsible_id = $this->input->post('responsible_id');
        $day = date('Y-m-d');
        $where =  array('responsible_id' => $responsible_id);
        $res = $this->get_setoran_day($where, $day);
        $arr_ht['omset'] = $res['omset'];
        $arr_ht['tunai'] = $res['tunai'];
        $arr_ht['non_tunai'] = $res['non_tunai'];
        $arr_ht = array_merge($arr_ht, array('pembayaran' => $this->Payment_model->get_history_transaksi($day, $where)));
        $this->msg('data', '200', $arr_ht);
    }

    function get_transaksi_hari_ini(Type $var = null)
    {
        $like = array('create_at' => date('Y-m-d'));
        $where = array('cabang_id' => $this->input->post('cabang_id'));
        $res = $this->Master->get_all('payment', $where, '', '', $like);
        // $res = $this->Payment_model->get_transaksi_hari_ini_dt_order($day, $where);
        // $this->get_merge_pm($pm,'001000220191030083859');
        // $res = $order;
        foreach ($res as $key => $value) {
            $res[$key]['data_order'] = json_decode($value['data_order']);
            $res[$key]['data_customer'] = json_decode($value['data_customer']);
            $res[$key]['data_payment'] = json_decode($value['data_payment']);
            // $res[$key]['payment_method'] = $this->get_merge_pm();
        }
        $this->msg('data', '200', $res);
    }

    // function get_merge_pm($data,$tr_id)
    // {
    //     $res['tr_id']=$tr_id;
    //     $res['payment']=array();
    //     foreach ($data as $key => $value) {
    //         array_push($res['payment'],array('nominal'=>$value['nominal'],'media'=>$value['nama']));
    //     }
    //     $this->msg('data', '200', $data);
    // }




    /*
     * Adding a new produk
     */
    function add()
    {
        $this->is_valid();
        $kw = $this->input->post('kimochi_wallet_bonus');
        $params = array(
            'tr_id' => $this->input->post('tr_id'),
            'cabang_id' => $this->input->post('cabang_id'),
            'customer_id' => $this->input->post('customer_id'),
            'responsible_id' => $this->input->post('responsible_id'),

            'create_at' => date('Y-m-d H:i:s'),
            'update_at' => date('Y-m-d H:i:s'),
        );
        $dt_customer=$this->get_data_customer();
        $params['data_customer'] = json_encode($dt_customer);
        $params['data_order'] = json_encode($this->get_data_order());
        $data_payment = $this->get_data_payment();
        // $this->msg('data', '200', $data_payment);
        $params['data_payment'] = json_encode($data_payment['payment_method']);

        //KASUSNYA KEMARIN KEBALIK ISTILAHNYA JADI KETUKAR
        $params['total_payment'] = $data_payment['total']; //masukan aja 
        $params['total'] = $data_payment['total_payment']; //masukan  + diskon

        $params['tunai'] = $data_payment['tunai'];
        $params['non_tunai'] = $data_payment['non_tunai'];
        $params['potongan'] = $data_payment['potongan'];
        $params['kimochi_wallet'] = $data_payment['kimochi_wallet'];
        // var_dump(json_decode($params['data_payment'])->total);
        // var_dump(json_decode($params['data_order'])->total);
        $bayar = (float) $params['total'];
        $tagihan = (float) json_decode($params['data_order'])->total;

        if ($bayar < $tagihan) {
            $this->msg('data', '400', array('bayar' => $bayar, 'tagihan' => $tagihan,'kurang'=>($tagihan-$bayar)), "belum lunas");
        }
        // var_dump($dt_customer);
        // $this->msg('data', '200',);
        $res = $this->Master->add($this->tabel, $params);

        if ($res['status']) {
            $this->Master->update('taking_order', array('tr_id' => $params['tr_id']), array('status' => 'paid')); //update status menjadi PAID
            $this->get_data_payment(TRUE); //update sisa_kuota 
            $this->Master->update('customer',['id'=>$dt_customer['customer']['id']],['kimochi_wallet'=>((int)$dt_customer['customer']['kimochi_wallet']+(int)$kw)]);
            $this->msg('data', '200', array('tr_id' => $params['tr_id']));
        } else {
            $this->msg('data', '400', $params['tr_id'], $res['data']['message']);
        };
    }

    function get_data_customer()
    {
        $id =  $this->input->post('customer_id');
        $res = $this->Master->get('customer', array('id' => $id));
        if ($res['status']) {
            $data['customer'] = $res['data'];
            return $data;
        } else {
            $this->msg('data', '400', '', $res['data']['message']);
        };
    }
    function get_data_order()
    {
        $id =  $this->input->post('tr_id');
        $res = $this->Master->get_all('taking_order', array('tr_id' => $id), '', array('id AS taking_order_id', 'cabang_id', 'barang_id', 'data_barang', 'qyt', 'total', 'create_at', 'update_at'));
        $data['total'] = 0.0;
        foreach ($res as $key => $value) {
            // var_dump($res[$key]["data_customer"]);
            // $res[$key]["data_customer"]=json_decode($res[$key]["data_customer"]);
            $res[$key]["data_barang"] = json_decode($res[$key]["data_barang"])->barang;
            $data['total'] += (float) $res[$key]["total"];
        }
        $data['taking_order'] = $res;
        // var_dump($data['total']);
        return $data;
    }

    function in_array($str, $data)
    {

        foreach ($data as $key => $value) {
            if ($str == $value['id']) {
                return TRUE;
            }
        }
        return FALSE;
    }
    function get_data_payment($update = FALSE)
    {
        $id =  $this->input->post('tr_id');
        $res = $this->Master->get_all('payment_method', array('tr_id' => $id));
        if (!$update) {
            $methode_pembayaran = $this->Payment_model->get_payment_method('payment_method', array('pm.tr_id' => $id));
            $id_potongan = $this->Master->get_all('metode_pembayaran', array("jenis" => 'potongan'), '', 'id');
            $id_kw = $this->Master->get_all('metode_pembayaran', array("jenis" => 'kw'), '', 'id');
            $id_tunai = $this->Master->get_all('metode_pembayaran', array("jenis" => 'tunai'), '', 'id');
            $id_non_tunai = $this->Master->get_all('metode_pembayaran', array("jenis" => 'non tunai'), '', 'id');
            // var_dump( $id_kw);
            $data['total'] = 0.0; //masukan aja
            $data['total_payment'] = 0.0; //diskon + masukan
            $data['kimochi_wallet'] = 0.0; //diskon + masukan
            $data['tunai'] = 0.0;
            $data['non_tunai'] = 0.0;
            $data['potongan'] = 0.0;
            // $this->msg('data', '200', $methode_pembayaran);
        }

        foreach ($res as $key => $value) {
            if ($update) {
                $diskon_id = $value['diskon_id'];
                $sisa_kuota = $this->Master->get_select('diskon', 'sisa_kuota', array('id' => $diskon_id))['data']['sisa_kuota'];
                // $this->msg('data', '200', $sisa_kuota);
                if ($diskon_id != 0) {
                    $decreament_sisa_kuota = array(
                        'sisa_kuota' => $sisa_kuota - 1
                    );
                    $this->Master->update('diskon', array('id' => $diskon_id), $decreament_sisa_kuota);
                }
            } else {
                $res[$key]["data_metode_pembayaran"] = json_decode($res[$key]["data_metode_pembayaran"]);
                if (!$this->in_array($value['metode_pembayaran_id'], $id_potongan)) {
                    $data['total'] += (float) $res[$key]["nominal"];
                }else {
                    $data['potongan'] += (float) $res[$key]["nominal"];
                }
                $data['tunai'] += $this->in_array($value['metode_pembayaran_id'], $id_tunai) ? (float) $res[$key]["nominal"] : 0.0;
                $data['non_tunai'] += $this->in_array($value['metode_pembayaran_id'], $id_non_tunai) ? (float) $res[$key]["nominal"] : 0.0;
                $data['kimochi_wallet']+= $this->in_array($value['metode_pembayaran_id'], $id_kw) ? (float) $res[$key]["nominal"] : 0.0;
                $data['total_payment'] += (float) $res[$key]["nominal"];
            }
        }
        if (!$update) {
            $data['payment_method']['metode_pembayaran'] = $methode_pembayaran;
            $data['payment_method']['detail'] = $res;
            return $data;
        }
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
            'nama' => $this->input->post('nama'),
            'nomor' => $this->input->post('nomor'),
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
