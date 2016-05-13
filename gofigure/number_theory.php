<?php
$template = file_get_contents('template.php');
ob_start();
?>
    <h1>Some Prime Number Theory</h1>

    <p>What are some ways you can tell if a number is not a prime number?</p>
    <ul>
    <li>As you may have learned, any number that ends in 0 is divisible by 10 and is therefore not prime.</li>
    <li>Any even number is divisible by 2.  Therefore, no even number except 2 itself is a prime number.</li>
    <li>Any number that ends in 5.  Therefore, no number that ends in 5, except 5 itself, is a prime number.</li>
    <li>Any number whose digits add up to a multiple of 3 is divisible by 3.  Therefore no such number, except 3 itself, is a prime number.</li>
    </ul>

    <p>Most people know some of these tricks; however, the trick of checking the sum of a number's digits to see if it's a multiple of 3 might not be familiar.  If you are interested in understanding why this works, <a href="rule_of_three.php">click here</a>.</p>
<?php
$content = ob_get_clean();
$replace = array('s' => array('%TITLE%', '%CONTENT%'), 'r' => array('Number Theory', $content));

$out = str_replace($replace['s'], $replace['r'], $template);
print $out;
?>
