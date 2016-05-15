<?php
class Fibonacci extends Output {
    private $_phi;
    private $_sqrt5;
    
    public function __construct() 
    {
        $this->_sqrt5 = pow(5, .5);
        $this->_phi = (1 + $this->_sqrt5) / 2;
    }

    public function getUpTo($max) 
    {
        $i = 1;
        $fib = 1;
        $fibs = array();
        for ($i = 1; $i <= $max; $i++) {
            $fib = $this->_calculateNth($i);
            $fibs[$i] = $fib;
        }
        $this->_data = $fibs;
    }


    private function _calculateNth($n)
    {
        return round(pow($this->_phi, $n) / $this->_sqrt5);
    }
}
