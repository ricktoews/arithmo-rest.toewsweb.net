<?php
/*
CLASS DecimalCollection
    A fraction list object is instantiated with three pieces of data:  
    a numerator range, a denominator, and a number base.

PROPERTIES
    public:
        $base: number base (defaults to 10).
        $fraction: list of fraction objects (FractionObj).


METHODS
        
    PUBLIC __construct:  Object constructor.  Builds list of fraction objects.


    PRIVATE parse:  parses the numerator range and returns an array.  This is
    expected to be either one integer or else a starting and stopping integer.

*/
class DecimalCollection {
    public $base, $fraction;

    public function __construct($denom, $num, $base)
    {
        list($num1, $num2) = $this->parse($num);
        if ($num2 >= $denom) { $num2 = $denom - 1; }
        $this->base = strlen($base) == 0 ? 10 : $base;
        if ($this->base != 10) {
            $num1 = base_convert($num1, $this->base, 10);
            $num2 = base_convert($num2, $this->base, 10);
            $denom = base_convert($denom, $this->base, 10);
        }

        for ($i = $num1; $i <= $num2; $i++) {
            $this->fraction[$i] = new DecimalData($denom, $i, $base);
        }
    }


    private function parse($n) {
        $nrange = array(); 
        if (preg_match("/^([0-9a-zA-Z]+)\s*-\s*([0-9a-zA-Z]+)$/", $n, $matches)) {
            $nrange[] = $matches[1]; 
            $nrange[] = $matches[2]; 
        }
        else {
            $nrange[] = $n;
            $nrange[] = $n;
        }
        return $nrange;
    }
}

