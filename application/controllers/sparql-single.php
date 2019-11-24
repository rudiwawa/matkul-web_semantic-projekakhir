<?php

include('./httpful.phar');

$sparql = <<< END
PREFIX ub: <http://ub.ac.id#>
SELECT ?nama
	WHERE {ub:filkom ub:ketua ?dekan . ?dekan ub:nama ?nama}
END;

$url = 'http://localhost:3030/ub/query?query=' . urlencode($sparql);
$res = \Httpful\Request::get($url)->expectsJson()->send();
$arr = json_decode($res);

// print_r($arr);
// echo '<br>';
echo $arr->results->bindings[0]->nama->value;