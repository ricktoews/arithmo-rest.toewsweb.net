<?php
class Fibonacci extends Output {
    private $_phi;
    private $_sqrt5;
	private $_fibonacci;
    
    public function __construct() 
    {
		$data = json_decode(file_get_contents('./data/fibonacci.json'));
		$this->_fibonacci = $data->fibonacci;
        $this->_sqrt5 = pow(5, .5);
        $this->_phi = (1 + $this->_sqrt5) / 2;
    }

    public function getUpTo($max) 
    {
        $i = 1;
        $fib = 1;
        $fibs = array();
		$json = array();
        for ($i = 1; $i <= $max; $i++) {
            $fib = $this->_calculateNth($i);
            $fibs[$i] = $this->_fibonacci[$i];
        }
        $this->_data = $fibs;
        $this->_forjson = $fibs;
    }


    private function _calculateNth($n)
    {
        return round(pow($this->_phi, $n) / $this->_sqrt5);
    }
}
