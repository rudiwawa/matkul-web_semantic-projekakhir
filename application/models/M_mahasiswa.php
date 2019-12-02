<?php
require_once(APPPATH . 'libraries/Httpful.phar');
//https://www.w3.org/Submission/SPARQL-Update/
class M_mahasiswa extends CI_Model
{
    protected $prefix = <<< END

  PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
  PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
  PREFIX owl: <http://www.w3.org/2002/07/owl#>
  PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
  PREFIX filkom:<http://www.semanticweb.org/kharis/ontologies/2019/10/pkl-filkom#>

END;
    public function __construct()
    {
        parent::__construct();
    }
    function login_mahasiswa($username, $password)
    {
        $sparql = <<< END
        $this->prefix
        SELECT ?username  ?password ?nama ?status
        WHERE {
          ?mahasiswa rdf:type filkom:Mahasiswa.
          ?mahasiswa filkom:username ?username.
          ?mahasiswa filkom:nama ?nama.
          ?mahasiswa filkom:username "$username".
          ?mahasiswa filkom:password ?password.
          ?mahasiswa filkom:password "$password".
          ?mahasiswa filkom:bagian_dari ?kelompok.
          ?kelompok filkom:status_kelompok ?status.
        }
END;
        $url = 'http://localhost:3030/pkl/query?query=' . urlencode($sparql);
        $res = \Httpful\Request::get($url)->expectsJson()->send();
        $arr = json_decode($res, true);
        $arr = $arr['results']['bindings'];
        //$array = array('1', '2');
        if (empty($arr)) {
            echo "Login Failed";
            var_dump($arr);
            die;
        }else{
            $this->session->set_userdata("uname", $username);
            $this->session->set_userdata("name", $arr[0]["nama"]["value"]);
            $this->session->set_userdata("status", $arr[0]["status"]["value"]);
            //die;
            redirect('Mahasiswa/dasboard');
        }
        //return $arr;
    }

}
