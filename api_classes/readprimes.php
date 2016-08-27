<?php
$json = file_get_contents('primes.json');
$data = json_decode($json);

echo sprintf('The 105th prime number is %s', $data->primes[104]) . "\n";
