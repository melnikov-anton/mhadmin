<?php
$test = '333';

$head_content = <<<HEAD
<title> Mini Hosting Admin </title>
HEAD;


$body_content = <<<BODY
<h3>Hello World $test</h3>
<p>Just a text</p>
BODY;


include 'template.php';
