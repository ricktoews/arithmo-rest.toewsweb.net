<?php
class Compare extends Output {
    private $_calls;

    public function __construct($fns, $max)
    {
        $calls = array();
        $url_template = 'http://arithmo.toewsweb.net/%s/%s';
        foreach ($fns as $fn) {
            if ($fn) {
                $calls[] = sprintf($url_template, $fn, $max);
            }
        }
        $this->_calls = $calls;
    }

    public function gatherData()
    {
        foreach ($this->_calls as $ndx => $call) {
            $ch = curl_init($call);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $data = curl_exec($ch);
            curl_close($ch);
            $data = json_decode($data);
            $values = array();
            foreach ($data as $key => $value) {
                $values[$key] = $value;
            }
            $response[] = $values;
        }
        return $response;
    }

    public function compare($data)
    {
        $this->_data = array_intersect($data[0], $data[1]);
    }
}
