<?php
print isRelativePrime(210, 151) . "\n";

function isRelativePrime($a, $b) {
    $gcf = 0;
    $iter = 0;
    while (!$gcf && $iter < 100) {
$iter++;
        if (max($a, $b) % min($a, $b) == 0) {
            $gcf = min($a, $b);
        }
       
        else {
            if ($b > $a) {
                $b = $b - $a;
            }
            else {
                $a = $a - $b;
            }
print "a: $a, b: $b\n";
        }
    }
    return $gcf;
}
?>
