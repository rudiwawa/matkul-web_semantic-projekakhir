<?php
require_once(APPPATH . 'libraries/Httpful.phar');

class M_akademik extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    function get_ValidasiPembimbing(Type $var = null)
    {
        $sparql = <<< END

        PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
        PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
        PREFIX owl: <http://www.w3.org/2002/07/owl#>
        PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
        PREFIX filkom:<http://www.semanticweb.org/kharis/ontologies/2019/10/pkl-filkom#>
        SELECT ?kelompok ?nama ?tempat_pkl ?minat ?dosen ?status
        WHERE {
        ?kelompok rdf:type filkom:Kelompok. 
          ?dosen rdf:type filkom:Pembimbing .
          ?dosen filkom:membimbing ?kelompok .
          ?kelompok filkom:terdiri_dari ?mahasiswa.
          ?mahasiswa filkom:nama ?nama .
         ?kelompok filkom:mempunyai ?profil.
          ?profil filkom:nama_tempat ?tempat_pkl.
          ?kelompok filkom:status_kelompok ?status.
          ?kelompok filkom:keminatan ?minat
        }        
        

END;
        $url = 'http://localhost:3030/pkl/query?query=' . urlencode($sparql);
        $res = \Httpful\Request::get($url)->expectsJson()->send();
        $arr = json_decode($res,true);
        $arr = $arr['results']['bindings'];
        return $arr;
    }

    function pkl_lihat_dosbing(Type $var = null)
    {
        $sparql = <<< END

        PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
        PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
        PREFIX owl: <http://www.w3.org/2002/07/owl#>
        PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
        PREFIX filkom:<http://www.semanticweb.org/kharis/ontologies/2019/10/pkl-filkom#>
        
        SELECT ?nama  ?kelompok  ?status
        WHERE {
          ?kelompok rdf:type filkom:Kelompok. 
          ?kelompok filkom:terdiri_dari ?mahasiswa.
          ?mahasiswa filkom:nama ?nama.
          ?kelompok  filkom:status_kelompok ?status
        }
        

END;
        $url = 'http://localhost:3030/pkl/query?query=' . urlencode($sparql);
        $res = \Httpful\Request::get($url)->expectsJson()->send();
        $arr = json_decode($res,true);
        $arr = $arr['results']['bindings'];
        return $arr;
    }
}
