#!/usr/bin/env php
<?php
$cmd = "for i in `find ../public -name '*.php'`;do grep '\ \*\ [GET|POST]' \$i;done";
passthru($cmd, $rosult);
echo $rosult;
