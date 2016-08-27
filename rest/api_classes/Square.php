<?php
class Square extends Output {
    public function getUpTo($max)
    {
        $data = array();
        $json = array();
        for ($i = 1; $i <= $max; $i++) {
            $data[$i] = $i*$i;
        }
        $this->_data = $data;
        $this->_forjson = $data;
    }
}
