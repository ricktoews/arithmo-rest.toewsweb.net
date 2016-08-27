<?php
require_once 'connect.php';

class AnalyzePrimes {
    private $_db;
    
    public function __construct() {
        global $db;
        $this->_db = $db;
        $this->primes = array();
    }

    public function findTwins() {
        $sql = "SELECT nth, prime FROM prime_numbers WHERE prime <= 1000000 ORDER BY nth";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute();
        $stmt->bind_result($nth, $prime);
        $last_prime = -1;
        $max_gap = 0;
        $twins = 0;
        while ($stmt->fetch()) {
            $cur_prime = $prime;
            if ($prime - $last_prime == 2) {
                $twins++;
            }
            elseif ($prime - $last_prime > $max_gap) {
                $gap_data = array(
                    'difference' => $prime - $last_prime,
                    'from' => $last_prime,
                    'to' => $prime,
                );
                $max_gap = $prime - $last_prime;
            }
            $last_prime = $prime;
        }
        echo "Number of twin primes: $twins\n";
        echo "Largest gap: ";
        print_r($gap_data);
        echo "\n";
    }
}

$ap = new AnalyzePrimes();
echo "Count: " . sizeof($ap->primes);
//$ap->findTwins();

