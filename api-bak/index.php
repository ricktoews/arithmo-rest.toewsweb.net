<?php
spl_autoload_register(function($class) {
    if (substr($class, 0, 4) != 'Twig' && substr($class, 0, 4) != 'Slim') {
        if (file_exists('api_classes/' . $class . '.php')) {
            $file = 'api_classes/' . $class . '.php';
        }
        elseif (file_exists('classes/' . $class . '.php')) {
            $file = 'classes/' . $class . '.php';
        }
        require_once $file;
    }
});

require 'Slim/Slim.php';
require 'Slim/View.php';
require 'api_functions/functions.php';
require 'api_classes/connect.php';
require 'Slim-Extras/Views/TwigView.php';

$app = new Slim(array(
    'view' => new TwigView()
    ));

$app->get('/',                      '\ArithmophileAPI\intro');

// Decimal Calculator
$app->get('/dc/:denom(/:num)',      '\ArithmophileAPI\dc_denom_num')        ->conditions(array('denom' => '\d+', 'num' => '\d+'));
$app->get('/dc/primes/:max',        '\ArithmophileAPI\prime_reciprocals')   ->conditions(array('max' => '\d+'));
$app->get('/dc/primes/:max',        '\ArithmophileAPI\prime_reciprocals')   ->conditions(array('max' => '\d+'));

// Fibonacci numbers
$app->get('/fib/:max',              '\ArithmophileAPI\fibonacci')           ->conditions(array('max' => '\d+'));

// Fibonacci numbers
$app->get('/square/:max',           '\ArithmophileAPI\square')              ->conditions(array('max' => '\d+'));

// Fibonacci numbers
$app->get('/cube/:max',             '\ArithmophileAPI\cube')                ->conditions(array('max' => '\d+'));

// Triangular numbers
$app->get('/tri/:max',              '\ArithmophileAPI\tri_upto')            ->conditions(array('max' => '\d+'));
$app->get('/tri/:from/:to',         '\ArithmophileAPI\tri_from_to')         ->conditions(array('from' => '\d+', 'to' => '\d+'));
$app->get('/tri/:from/to/:to',      '\ArithmophileAPI\tri_from_to')         ->conditions(array('from' => '\d+', 'to' => '\d+'));
$app->get('/tri/test/:num',         '\ArithmophileAPI\tri_test')            ->conditions(array('num' => '\d+'));

// Phi
$app->get('/phi/:digits',           '\ArithmophileAPI\phi_digits')          ->conditions(array('digits' => '\d+'));
$app->get('/phi/powers(/:max)',     '\ArithmophileAPI\phi_powers')          ->conditions(array('max' => '\d+'));

// Prime numbers
$app->get('/primes/:max',           '\ArithmophileAPI\primes_upto')         ->conditions(array('max' => '\d+'));
$app->get('/primes/:from/:to',      '\ArithmophileAPI\primes_from_to')      ->conditions(array('from' => '\d+', 'to' => '\d+'));
$app->get('/nthprime/:from/:to',    '\ArithmophileAPI\nth_prime_from_to')   ->conditions(array('from' => '\d+', 'to' => '\d+'));
$app->get('/isprime/:n',            '\ArithmophileAPI\prime_check')         ->conditions(array('n' => '\d+'));

$app->get('/cmp/:max/:a/:b(/:c)',   '\ArithmophileAPI\compare')             ->conditions(array('max' => '\d+'));

$app->run();

