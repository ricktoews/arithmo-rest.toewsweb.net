<?php
$template = file_get_contents('template_wide.php');
ob_start();
?>
<script type="text/javascript" src="/js/simplify.js"></script>
<p>The object of this game is to reduce the fractions by dragging number tiles onto them.  When you believe you have reduced a fraction as far as possible, click on it.  If you're right, a yellow border will be added to its box.  If you're wrong, you'll get a big red X instead.  Be careful, though:  you also lose if you drag a wrong number onto a fraction.</p>
<div id="field"></div>

<div id="overlay">
    <div id="finished" class="popup">
        <p><a href="simplify.php">Play again</a></p>
    </div>
</div>
<?php
$content = ob_get_clean();
$replace = array('s' => array('%TITLE%', '%CONTENT%'), 'r' => array('Simplify', $content));

$out = str_replace($replace['s'], $replace['r'], $template);
print $out;
?>
