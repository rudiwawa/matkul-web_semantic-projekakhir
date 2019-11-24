<?php
defined('BASEPATH') or exit('No direct script access allowed');
// var_dump('./httpful.phar');

require_once(APPPATH.'libraries/Httpful.phar');
// require_once('./httpful.phar');
class Api extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
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
    public function index()
    {
        



        $sparql = <<< END
        SELECT ?subject ?predicate ?object
        WHERE {
          ?subject ?predicate ?object
        }
        LIMIT 25
END;

        $url = 'http://localhost:3030/pkl/query?query=' . urlencode($sparql);
        $res = \Httpful\Request::get($url)->expectsJson()->send();
        $arr = json_decode($res);
        $arr = $arr->results->bindings;
        // var_dump($arr);
        $this->msg('data', '200', $arr);
        // foreach ($arr->results->bindings as $data) {
        //     echo $data->fakultas->value, ' ', $data->nama->value, '<br>';
        // }
    }

}
