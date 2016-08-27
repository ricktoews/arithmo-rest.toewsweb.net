<?php
class Decimal extends Output {

    public function __construct() {}


    public function getPeriod($denom, $num)
    {
        $outmode = 'text';

        $decObj = new DecimalCollection($denom, $num, 10);
        $data = array();
        $json = array();
        foreach ($decObj->fraction as $fraction) {
            $json[] = $data[$fraction->num] = array(
                    'num' => $fraction->num,
                    'denom' => $fraction->denom,
                    'fraction' => $fraction->fraction,
                    'decimal' => $fraction->period,
                    'length' => $fraction->period_length,
                    'repeating' => $fraction->repeating,
                );
        }
        $this->_data = $data;
        $this->_forjson = $json;
        $this->_title = 'Decimal Calculator';
        $this->_template = 'decimal.html';
    }


    public function primeReciprocals($max)
    {
        $pObj = new \Prime();
        $data = $pObj->showPrimesFromTo(7, $max);
        $primes = $data['prime_numbers'];
        $data = array();
        $json = array();
        $full_reptend = 0;
        $count = 0;
        foreach ($primes as $prime) {
            $decObj = new \DecimalCollection($prime, 1, 10);
            $record = $decObj->fraction[1];
            $full = $record->period_length + 1 == $record->denom ? true : false;
            if ($full) $full_reptend++;
            $json[] = $data[$record->denom] = array(
                'reciprocal' => $record->fraction,
                'period' => $record->period,
                'length' => $record->period_length,
                'full-reptend' => $full,
            );
            $count++;
        }
        $this->_data = $data;
        $this->_forjson = $json;
        $this->_title = 'Prime Reciprocals (Full-reptend count: ' . $full_reptend . ' / ' . $count . ')';
        
    }
}
