<?php
$template = file_get_contents('template.php');
ob_start();
?>
    <h1>Introduction to Prime Numbers</h1>

    <p>A prime number is a number greater than 1 that has only itself and 1 as factors.  This means that there are no other numbers that can be divided into a prime number without leaving a remainder.  For example, the number 13 is a prime number because 13 divided by anything except for 1 and 13 will leave a remainder.</p>

    <p>The first several prime numbers are 2, 3, 5, 7, and 11.</p>

    <p>Some interesting facts about prime numbers:</p>
    <ul>
    <li>The number 2 is the only even prime number.  (Can you think of why this is true?)</li>
    <li>Exactly one-quarter of the integers from 1 to 100 are prime.</li>
    <li>There are infinitely many prime numbers.</li>
    <li>Although it is possible to predict approximate frequency of prime numbers within certain ranges, there is no known formula for generating prime numbers.</li>
    </ul>

    <p>Here is a game called <a href="primeout.php">PrimeOut</a> that will challenge you to identify and avoid clicking prime numbers.</p>

    <p><a href="number_theory.php">Click</a> here to learn some tricks you can use to tell if a number is <i>not</i> a prime number--even if you don't know exactly what numbers divide into it.</p>

<?php
$content = ob_get_clean();
$replace = array('s' => array('%TITLE%', '%CONTENT%'), 'r' => array('GoFigure - Introduction to Prime Numbers', $content));

$out = str_replace($replace['s'], $replace['r'], $template);
print $out;
?>
