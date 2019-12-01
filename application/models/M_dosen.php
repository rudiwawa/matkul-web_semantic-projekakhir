<?php
require_once(APPPATH . 'libraries/Httpful.phar');
//https://www.w3.org/Submission/SPARQL-Update/
class M_dosen extends CI_Model
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
    function get_lihat_kelompok(Type $var = null)
    {
        $sparql = <<< END
        $this->prefix
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
        $arr = json_decode($res, true);
        $arr = $arr['results']['bindings'];
        return $arr;
    }

    function pkl_lihat_dosbing(Type $var = null)
    {
        $sparql = <<< END
        $this->prefix
        SELECT ?nama  ?kelompok ?dosen ?nama_dosen
        WHERE {
          ?kelompok rdf:type filkom:Kelompok. 
          ?dosen rdf:type filkom:Pembimbing .
          ?dosen filkom:membimbing ?kelompok .
  		  ?dosen filkom:nama_dosen ?nama_dosen .
          ?kelompok filkom:terdiri_dari ?mahasiswa.
          ?mahasiswa filkom:nama ?nama
        }
        
END;
        $url = 'http://localhost:3030/pkl/query?query=' . urlencode($sparql);
        $res = \Httpful\Request::get($url)->expectsJson()->send();
        $arr = json_decode($res, true);
        $arr = $arr['results']['bindings'];
        return $arr;
    }

    function pkl_update_dosbing(Type $var = null)
    {
        $sparql = <<< END
      $this->prefix
      SELECT ?nama  ?kelompok ?dosen 
      WHERE {
        ?kelompok rdf:type filkom:Kelompok. 
        ?dosen rdf:type filkom:Pembimbing .
        ?dosen filkom:membimbing ?kelompok .
        ?kelompok filkom:terdiri_dari ?mahasiswa.
        ?mahasiswa filkom:nama ?nama
      }
      
END;
        $url = 'http://localhost:3030/pkl/query?query=' . urlencode($sparql);
        $res = \Httpful\Request::get($url)->expectsJson()->send();
        $arr = json_decode($res, true);
        $arr = $arr['results']['bindings'];
        return $arr;
    }

    function getAll_dosen_pembimbing(Type $var = null)
    {
        $sparql = <<< END
        PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
        PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
        PREFIX owl: <http://www.w3.org/2002/07/owl#>
        PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
        PREFIX filkom: <https://filkom.ub.ac.id/>
        
        SELECT ?dosen ?nama_lengkap
                WHERE {
                  ?dosen rdf:type filkom:DosenPNS.
                ?dosen filkom:nama_lengkap ?nama_lengkap
                }   
        
        
END;
        $url = 'http://localhost:3030/dosen/query?query=' . urlencode($sparql);
        $res = \Httpful\Request::get($url)->expectsJson()->send();
        $arr = json_decode($res, true);
        $arr = $arr['results']['bindings'];
        return $arr;
    }
}
