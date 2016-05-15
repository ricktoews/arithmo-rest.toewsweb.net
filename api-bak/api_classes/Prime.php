<?php
class Prime extends Output {
    private $_db;

    public function __construct()
    {
        global $db;

        $this->_db = $db;
    }

    public function showPrimesFromTo($from, $to)
    {
        $this->_data = $this->_list_primes_from_to($from, $to);
        $this->_title = 'Prime Numbers';
        $this->_template = 'prime_numbers.html';
        return $this->_data;
    }

    public function showNthPrimeFromTo($from, $to)
    {
        $this->_data = $this->_list_nth_prime_from_to($from, $to);
        $this->_title = 'Nth Prime Numbers';
        $this->_template = 'prime_numbers.html';
    }

    public function isPrime($n)
    {
        $factors = $this->_factor($n);
        $data = array(
            'number' => $n,
            'prime_factors' => $factors,
        );
        $this->_title = 'Prime Factors';
        $this->_template = 'is_prime.html';
        $this->_data = $data;
    }

    /*
     * private method _factor:  compute and return an array of prime factors for 
     *    the specified value.
     *
     * This takes the approach of testing each prime number from 2 to the largest
     * prime number less than or equal to half of the specified value to determine
     * whether that prime number is a factor.
     *
     * The _primes array only goes up to 7919 currently, so this is rather limited.
     */
    private function _factor($n)
    {
        $factors = array();
        $pndx = 0;
        $max_prime = floor($n / 2);
        $sql = "SELECT prime FROM prime_numbers WHERE prime <= $max_prime";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute();
        $stmt->bind_result($prime);
        while ($stmt->fetch()) {
            if ($n % $prime == 0) {
                $factors[] = $prime;
            }
        }

        return $factors;
    }

    private function _list_primes_from_to($from, $to)
    {
        $list = array('primes_listed' => 0);
        $sql = "SELECT nth, prime FROM prime_numbers WHERE prime BETWEEN $from AND $to ORDER BY nth";
        $stmt = $this->_db->prepare($sql);

        $stmt->execute();
        $stmt->bind_result($nth, $prime);
        while ($stmt->fetch()) {
            $list['prime_numbers'][$nth] = $prime; 
        }
        $list['primes_listed'] = sizeof($list['prime_numbers']);
        return $list;
    }


    private function _list_nth_prime_from_to($from, $to)
    {
        $list = array('primes_listed' => 0);
        $sql = "SELECT nth, prime FROM prime_numbers WHERE nth BETWEEN $from AND $to ORDER BY nth";
        $stmt = $this->_db->prepare($sql);

        $stmt->execute();
        $stmt->bind_result($nth, $prime);
        while ($stmt->fetch()) {
            $list['prime_numbers'][$nth] = $prime; 
        }
        $list['primes_listed'] = sizeof($list['prime_numbers']);
        return $list;
    }
}
?>
