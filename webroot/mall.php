<?php

include(__DIR__ . '/config.php');

$me['title'] = "MassMusik Mall";

$me['main'] = <<<EOD

<div class='article'>
<h1>MassMusik Mall</h1>
<p>Body text.</p>

</div>

<div class='rb'>
<h2>Senaste Nyheterna!</h2>
</div>

EOD;

include(ME_THEME_PATH); 