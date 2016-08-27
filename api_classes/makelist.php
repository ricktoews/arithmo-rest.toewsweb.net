<?php
class PrimeList {

    public function __construct($file) {
        $this->link = mysqli_connect("localhost","rick","toews","test123") or die("Error " . mysqli_error($link));
        $this->lines = file($file);
    }

    private function _remove_blank($item) {
        return $item > '';
    }

    public function buildPrimeList($nth) {
        $primes = array();
        $nth = 3000001;
        foreach ($this->lines as $ndx => $line) {
            if ($ndx < 2) continue;
            $ints = array_filter(explode(' ', trim($line)), array('PrimeList', '_remove_blank'));
            foreach ($ints as $prime) {
                $sql = "INSERT INTO prime_numbers SET nth=$nth, prime=$prime";
                $this->link->query($sql);
                $nth++;
            }
        }
    }

    public function output() {
        $primes = array('primes' => $this->primes);
        $json = json_encode($primes);
        echo $json;
        echo "\n";
    }
}

$file = 'primes5.txt';
$start = 4000001;
$pl = new PrimeList($file);
$pl->buildPrimeList($start);
