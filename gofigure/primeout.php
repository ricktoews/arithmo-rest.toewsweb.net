<?php
$template = file_get_contents('template_wide.php');
ob_start();
?>
<script type="text/javascript" src="/js/primeout.js"></script>
<p>The object of this game is simple:  Click on the numbers that are <i><b>not</b></i> prime.</p>
<div id="msg_box">
    <div id="scoreboard">
        <div id="homeruns">
            <p>Hits</p>
            <ul>
            <li></li>
            <li></li>
            <li></li>
            </ul>
        </div>
        <div id="outs">
            <p>Misses</p>
            <ul>
            <li></li>
            <li></li>
            <li></li>
            </ul>
        </div>
    </div>
</div>
<div id="field"></div>

<div id="overlay">
<div id="hit" class="popup">
<p>Awesome!  You got all of the composite numbers and avoided the prime number.</p>
<p>Click to continue.</p>
</div>
<div id="miss" class="popup">
<p>Whoa!  The number you just clicked happens to be prime!</p>
<p>Remember:  Look for numbers that are even, or that end in 5, or whose digits add up to a multiple of 3.  Most non-prime (composite) numbers less than 100 have at least one of these characteristics.  There are three exceptions:  49, 77, and 91.  These three have none of these characteristics but are divisible by 7.</p>
<p>Click to continue.</p>
</div>
<div id="finished" class="popup">
<p>Three rounds successfully completed!  You appear to be getting the hang of prime numbers!</p>
<p><a href="primeout.php">Play again</a>, or <a href="primeintro.php">read about prime numbers</a>.</p>
</div>
<div id="drawingboard" class="popup">
<p>Maybe you're just having trouble with your mouse; however, that's the third time you've clicked a prime number.  Perhaps a <a href="primeintro.php">concept review</a> is in order?</p>
<p>Or maybe you would just like to try to <a href="primeout.php">vindicate yourself</a>?</p>
</div>
</div>
<?php
$content = ob_get_clean();
$replace = array('s' => array('%TITLE%', '%CONTENT%'), 'r' => array('PrimeOut', $content));

$out = str_replace($replace['s'], $replace['r'], $template);
print $out;
?>
