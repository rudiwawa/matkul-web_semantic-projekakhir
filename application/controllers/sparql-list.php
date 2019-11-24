<?php

include('./httpful.phar');

$sparql = <<< END
PREFIX ub: <http://ub.ac.id#>
PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
SELECT ?fakultas ?nama
	WHERE { ?fakultas rdf:type ub:Fakultas . ?fakultas ub:nama ?nama}
END;

$url = 'http://localhost:3030/ub/query?query=' . urlencode($sparql);
$res = \Httpful\Request::get($url)->expectsJson()->send();
$arr = json_decode($res);


foreach ($arr->results->bindings as $data) {
	echo $data->fakultas->value, ' ', $data->nama->value, '<br>';
}