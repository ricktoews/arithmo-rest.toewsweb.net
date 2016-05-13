<?php
$template = file_get_contents('template.php');
ob_start();
?>
    <h1>Rule of Three</h1>

    <p>What have the numbers 381, 68727, and 1929 in common?  Why yes:  all are divisible by 3.  (Why else would they be highlighted on this page, right?)  Let's look a little closer.</p>

    <p>Notice what you get when you add the digits of each:  for 381, you get 12; for 68727, you get 30; for 1929, you get 21.  In each of these cases, the number 3 will divide the sum without leaving a remainder.  Any number that has this quality is itself divisible by 3:  381 = 3 x 127, 68727 = 3 x 22909, 1929 = 3 x 643.  (Feel free to check other examples.)</p>

    <p>So what's going here?  Why does this work for 3 but not for most other numbers?  (For instance, the digits of 86 add up to 14, which is divisible by 7; however, 86 divided by 7 leaves a remainder of 2.)  What's special about 3?</p>

    <p>In order to understand this, we need to take a look at our numbering system:  base 10.  Consider, for example, the number 496.  Although we write this as just a 4, followed by a 9, followed by a 6, what we mean is 4 x 100 plus 9 x 10 plus 6 x 1.  It's a three-digit number, which means it takes three places.  The first place is always the digit times 1, the second place is the digit times 10, the third place is the digit times 100, and so on.</p>

    <p>Do you see the progression?  As we move to the left, each successive place is the digit multiplied by a number ending in a certain number of 0s.  In fact, the number of 0s is one less than the number of the place itself:  the first place is just 1, the second place is 10 (or the first place times 10), the third place is 100 (or the second place times 10), the fourth place is 1000 (the third place times 10), etc.</p>

    <p>Now, if you divide 10 by 3, you get a remainder of 1.  So if you multiplied 10 10s by 10, you'd get 10 remainders of 1, or 10; however, 10 itself divided by 3 leaves a remainder of 1, so 10 10s multipled by 3 leaves a remainder of 1.  In fact, no matter how many 10s we multiply together, if we divide the result by 3, we get a remainder of 1.</p>

    <p>Knowing this, suppose we have the number 5000.  This is 5 x 1000.  Applying what we've just seen, 1000 divided by 3 leaves a remainder of 1.  So if we have 5 1000s divided by 3, we'll get five remainders of 1, or a remainder of 5.  (Yes, that would itself leave a remainder of 2, but let's keep the 5 for a moment while we explain.)  Likewise, if we divided 400 by 3, we would get four remainders of 1, or a remainder of 4; and so on, for any number multiplied by a power of 10.  Because of this, when we add the digits of a number, the total is a total of remainders for divisions by 3.  If this total is itself divisible by 3, it means that the number itself is divisible by 3.</p>

    <p><a href="primeout.php">Click here to play PrimeOut</a>.</p>
<?php
$content = ob_get_clean();
$replace = array('s' => array('%TITLE%', '%CONTENT%'), 'r' => array('Number Theory', $content));

$out = str_replace($replace['s'], $replace['r'], $template);
print $out;
?>
