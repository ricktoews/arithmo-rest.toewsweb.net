<?php
class Cube extends Output {
    public function getUpTo($max)
    {
        $data = array();
        $json = array();
        for ($i = 1; $i <= $max; $i++) {
            $data[$i] = pow($i, 3);
        }
        $this->_data = $data;
        $this->_forjson = $data;
    }
}

