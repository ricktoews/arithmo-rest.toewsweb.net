<?php
/**
 * Namespace to bind together the functions used by the API.
 */
namespace ArithmophileAPI;

/**
 * Displays the API introductory page.
 */
function intro()
{
    global $app;
    try {
        $app->render('intro.html');
    }
    catch (\Exception $e) {
    }
}


/**
 * Output the data pertaining to the specified denominator and optional numerator.
 *
 * @param $denom int Denominator of fraction
 * @param $num int Optional numerator of fraction.  If omitted, all numerators are included in output data.
 */
function dc_denom_num($denom, $num = null)
{
    try {
        if ($num > $denom) {
            throw new \Exception('/dc/denom/num - num, if specified, must be less than denom.');
        }
        $num || $num = '1-' . ($denom - 1);
        $dec = new \Decimal();
        $dec->getPeriod($denom, $num);
        $dec->output();
    }
    catch (\Exception $e) {
        echo 'Error:  ' . $e->getMessage();
    }
}


function prime_reciprocals($max)
{
    try {
        $dec = new \Decimal();
        $dec->primeReciprocals($max);
        $dec->output();
    }
    catch (\Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}


/**
 * Output the triangular numbers from position 1 to the specified position.
 *
 * @param $max int Position of last trianguar number to include in output
 *
 * @example If $max == 5, output will be the first five triangular numbers: 1, 3, 6, 10, 15
 */
function tri_upto($max) 
{
    try {
//        require 'api_classes/triangular.php';
        $triObj = new \Triangular();
        $triObj->getTriangularsFromTo(1, $max);

        $triObj->output();
    }
    catch (\Exception $e) {
    }
}

/**
 * Ouput the trianguar numbers between the specified positions.
 *
 * @param $from int Position at which to begin output
 * @param $to int Position at which to end output
 */
function tri_from_to($from, $to) 
{
    try {
//        require 'api_classes/triangular.php';
        $triObj = new \Triangular();
        $triObj->getTriangularsFromTo($from, $to);
        $triObj->output();
    }
    catch (\Exception $e) {
    }
}

/**
 * Output whether a given number is triangular; and, if so, what its position is.
 *
 * @param $n int Number to test for triangularity
 */
function tri_test($n) {
    try {
//        require 'api_classes/triangular.php';
        $triObj = new \Triangular();

        $triObj->isTriangular($n);
        $triObj->output();
    }
    catch (\Exception $e) {
    
    }
}

/**
 * Output the Cubes, starting at 1

 * @param $max int Number of cubes
 */
function cube($max) 
{
    try {
//        require 'api_classes/cube.php';
        $cubeObj = new \Cube();
        $cubeObj->getUpTo($max);
        $cubeObj->output();
    }
    catch (\Exception $e) {
    }
}


/**
 * Output the Square numbers, starting at 1

 * @param $max int Number of squares
 */
function square($max) 
{
    try {
//        require 'api_classes/square.php';
        $sqObj = new \Square();
        $sqObj->getUpTo($max);
        $sqObj->output();
    }
    catch (\Exception $e) {
    }
}


/**
 * Output the Fibonacci numbers, starting at 1

 * @param $max int Number of Fibonacci numbers to output, or maximum Fibonacci value
 */
function fibonacci($max) 
{
    try {
//        require 'api_classes/fibonacci.php';
        $fibObj = new \Fibonacci();
        $fibObj->getUpTo($max);
        $fibObj->output();
    }
    catch (\Exception $e) {
    }
}


/**
 * Output the specified number of digits of the number phi (aka the Golden Ratio).
 * This number starts 1.618...
 *
 * @param $digits int Number of digits to output.
 */
function phi_digits($digits) 
{
    try {
//        require 'api_classes/phi.php';
        $phiObj = new \Phi();
        $phiObj->phiDigits($digits);
        $phiObj->output();
    }
    catch (\Exception $e) {
    }
}

/**
 * Output powers of phi, from exponent 0 to the exponent specified.
 * The output is provided in two forms:  (n*sqrt(5) + m) / 2, and as a real number approximation.
 *
 * @param $max int Maximum exponent to output.
 */
function phi_powers($max = 10) 
{
    try {
//        require 'api_classes/phi.php';
        $phiObj = new \Phi();
        $phiObj->phiPowers($max);
        $phiObj->output();
    }
    catch (\Exception $e) {
    }
}

/**
 * Output primes less than or equal to the specified value.
 *
 * @param $max int Ceiling for prime number output.  Current maximum prime number is 7919.
 *
 */
function primes_upto($max) 
{
    try {
//        require 'api_classes/prime.php';
        $primeObj = new \Prime();
        $primeObj->showPrimesFromTo(1, $max);
        $primeObj->output();
    }
    catch (\Exception $e) {
    }
}

/**
 * Output prime numbers within a specified range.
 *
 * @param $from int Number at which to begin checking for primes
 * @param $to int Number at which to stop checking for primes
 * @param $debug Boolean
 */
function primes_from_to($from, $to, $debug = null) 
{
    try {
//        require 'api_classes/prime.php';
        $primeObj = new \Prime($debug);
        $primeObj->showPrimesFromTo($from, $to);
        $primeObj->output();
    }
    catch (\Exception $e) {
    }
}

/**
 * Output nth prime numbers within a specified range.
 *
 * @param $from int Start at nth prime
 * @param $to int End at nth prime
 */
function nth_prime_from_to($from, $to, $debug = null) 
{
    try {
//        require 'api_classes/prime.php';
        $primeObj = new \Prime($debug);
        $primeObj->showNthPrimeFromTo($from, $to);
        $primeObj->output();
    }
    catch (\Exception $e) {
    }
}

/**
 * Output whether a number is prime; and, if not, its unique factors.
 *
 * @param $n int Number to check for primeness
 */
function prime_check($n) 
{
    try {
//        require 'api_classes/prime.php';
        $primeObj = new \Prime();
        $primeObj->isPrime($n);
        $primeObj->output();
    }
    catch (\Exception $e) {
    }
}


/**
 * Output comparison between selected functions.
 *
 * @param $max int Maximum number for comparison.
 */
function compare($max, $a, $b, $c = null) 
{
    try {
//        require_once 'api_classes/compare.php';
        $cmpObj = new \Compare(array($a, $b, $c), $max);
        $data = $cmpObj->gatherData(); 
        $cmpObj->compare($data);
        $cmpObj->output();
    }
    catch (\Exception $e) {
    }
}
?>
