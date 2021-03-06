<?php
class DataTest extends PHPUnit_Framework_TestCase {
    public function setUp()
    {
    }

    /**
     * @dataProvider providerMethod
     */
    public function testAdd($a, $b, $c)
    {
        $this->assertEquals($c, $a + $b);
    }

    public function providerMethod()
    {
        return array(
            array(0, 0, 0),
            array(0, 1, 1),
            array(1, 1, 3),
            array(1, 0, 1),
        );
    }
}
?>
