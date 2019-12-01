<?php
require_once(APPPATH . 'libraries/Httpful.phar');

class M_akademik extends CI_Model
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
    function get_ValidasiPembimbing($status)
    {
        $sparql = <<< END
        $this->prefix
        SELECT ?kelompok ?nama ?minat ?dosen_penguji ?tempat_pkl ?waktu ?status ?nama_dosen
        WHERE {
         ?kelompok rdf:type filkom:Kelompok. 
          ?dosen_penguji rdf:type filkom:Penguji.
          ?dosen_penguji filkom:menguji ?kelompok .
          ?dosen_penguji filkom:nama_dosen ?nama_dosen.
          ?kelompok filkom:terdiri_dari ?mahasiswa.
          ?mahasiswa filkom:nama ?nama .
          ?kelompok filkom:melakukan ?semhas.
           ?semhas filkom:status_kegiatan ?status.
          ?semhas filkom:status_kegiatan "$status".
          ?kelompok filkom:keminatan ?minat.
          ?semhas filkom:ruang_semhas ?tempat_pkl.
          ?semhas filkom:waktu_kegiatan ?waktu
        
        }       
        

END;
        $url = 'http://localhost:3030/pkl/query?query=' . urlencode($sparql);
        $res = \Httpful\Request::get($url)->expectsJson()->send();
        $arr = json_decode($res,true);
        $arr = $arr['results']['bindings'];
        return $arr;
    }
    function get_validasi_sehmas($status)
    {
        $sparql = <<< END
        $this->prefix
        SELECT ?kelompok ?nama ?minat ?dosen_penguji ?tempat_pkl ?waktu ?status ?nama_dosen
        WHERE {
         ?kelompok rdf:type filkom:Kelompok. 
          ?dosen_penguji rdf:type filkom:Penguji.
          ?dosen_penguji filkom:menguji ?kelompok .
          ?dosen_penguji filkom:nama_dosen ?nama_dosen.
          ?kelompok filkom:terdiri_dari ?mahasiswa.
          ?mahasiswa filkom:nama ?nama .
          ?kelompok filkom:melakukan ?semhas.
           ?semhas filkom:status_kegiatan ?status.
          ?semhas filkom:status_kegiatan "$status".
          ?kelompok filkom:keminatan ?minat.
          ?semhas filkom:ruang_semhas ?tempat_pkl.
          ?semhas filkom:waktu_kegiatan ?waktu
        
        }  
        

END;
        $url = 'http://localhost:3030/pkl/query?query=' . urlencode($sparql);
        $res = \Httpful\Request::get($url)->expectsJson()->send();
        $arr = json_decode($res,true);
        $arr = $arr['results']['bindings'];
        return $arr;
    }
}
