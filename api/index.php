<?php
require 'vendor/autoload.php';

require 'api_functions/functions.php';
require 'api_classes/connect.php';

$app = new \Slim\App();

//-----------------------------------------------------------------------------
// CORS
//-----------------------------------------------------------------------------
$app->add(function ($request, $response, $next) {
	$newResponse = $response
		->withHeader('Access-Control-Allow-Origin', '*')
		->withHeader('Access-Control-Allow-Headers', array('Content-Type', 'X-Requested-With', 'Authorization'))
		->withHeader('Access-Control-Allow-Methods', array('GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'));

	if ($request->isOptions()) {
		return $newResponse;
	}

	return $next($request, $newResponse);
});


$app->get('/', 'intro');

// Decimal Calculator
$app->get('/dc/{denom:\d+}[/{num:\d+}]', 'dc_denom_num');
$app->get('/dc/primes/{max:\d+}', 'prime_reciprocals');

// Fibonacci numbers
$app->get('/fib/{max:\d+}', 'fibonacci');

// Squares
$app->get('/square/{max:\d+}', 'square');

// Cubes
$app->get('/cube/{max:\d+}', 'cube');

// Triangular numbers
$app->get('/tri/{max:\d+}', 'tri_upto');
$app->get('/tri/{from:\d+}/{to:\d+}', 'tri_from_to');
$app->get('/tri/{from:\d+}/to/{to:\d+}', 'tri_from_to');
$app->get('/tri/test/{num:\d+}', 'tri_test');

// Phi
$app->get('/phi/{digits:\d+}', 'phi_digits');
$app->get('/phi/powers(/{max:\d+})', 'phi_powers');

// Prime numbers
$app->get('/primes/{max:\d+}', 'primes_upto');
$app->get('/primes/{from:\d+}/{to:\d+}', 'primes_from_to');
$app->get('/nthprime/{from:\d+}/{to:\d+}', 'nth_prime_from_to');
$app->get('/isprime/{n:\d+}', 'prime_check');

$app->get('/cmp/{max:\d+}/{a}/{b}(/{c})', 'compare');

$app->run();
