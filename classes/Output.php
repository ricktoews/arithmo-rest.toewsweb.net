<?php
class Output {
    protected $_debug;
    protected $_data;
    protected $_title;
    protected $_template;
    private $_host;

    public function __construct()
    {
        $this->_title = 'Another Avocational Arithmophile Adventure';
        $this->_template = null;
    }

    public function output()
    {
        $this->_debug = true;
        $this->_host = $_SERVER['HTTP_HOST'];
        $outmode = substr($this->_host, 0, strpos($this->_host, '.'));

        switch ($outmode) {
            case 'json':
                $this->_output_json();
                break;
            default:
                $this->_output_json();
        }
    }

    private function _output_json()
    {
		$status = isset($this->_status) ? $this->_status : 'success';
		$payload = array(
			'status' => $status,
			'data' => $this->_forjson,
		);
        $output = json_encode($payload);
        echo $output;
    }

    private function _output_default()
    {
        global $app;
        $output = array_merge(array('title' => $this->_title, 'data' => $this->_data));
        
        if (0&&$this->_template) {
            $app->render($this->_template, $output);
            if ($this->_debug) {
                print '<pre>';
                print_r($this->_data);
                print '</pre>';
            }
        }
        else {
            print_r($output);
        }
    }
}

?>

