<?php

class Prime extends Output {
	private $_primes;

    public function __construct()
    {
		$data = json_decode(file_get_contents('./data/primes.json'));
		$this->_primes = $data->primes;
    }

    public function showPrimesFromTo($from, $to)
    {
        $this->_data = $this->_list_primes_from_to($from, $to);
        $this->_title = 'Prime Numbers';
        $this->_template = 'prime_numbers.html';
        $this->_forjson = $this->_data;
    }

    public function showNthPrimeFromTo($from, $to)
    {
        $this->_data = $this->_list_nth_prime_from_to($from, $to);
        $this->_title = 'Nth Prime Numbers';
        $this->_template = 'prime_numbers.html';
		$this->_forjson = $this->_data;
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
        $this->_forjson = $data;
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
		for ($pndx = 0; isset($this->_primes[$pndx]) && $this->_primes[$pndx] <= $max_prime; $pndx++) {
			$prime = $this->_primes[$pndx];
            if ($n % $prime == 0) {
                $factors[] = $prime;
            }
        }

        return $factors;
    }

    private function _list_primes_from_to($from, $to)
    {
        $list = array('primes_listed' => 0);
		for ($pndx = 0; isset($this->_primes[$pndx]) && $this->_primes[$pndx] <= $to; $pndx++) {
			$prime = $this->_primes[$pndx];
			if ($prime >= $from) {
				$nth = $pndx+1;
            	$list['prime_numbers'][$nth] = $prime; 
			}
        }
        $list['primes_listed'] = sizeof($list['prime_numbers']);
        return $list;
    }


    private function _list_nth_prime_from_to($from, $to)
    {
        $list = array('primes_listed' => 0);
		for ($pndx = $from; $pndx <= $to; $pndx++) {
            $list['prime_numbers'][$pndx] = $this->_primes[$pndx-1]; 
        }
        $list['primes_listed'] = sizeof($list['prime_numbers']);
        return $list;
    }
}
?>
