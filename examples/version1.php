<?php

require  dirname(__DIR__) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Versioning.php';


orchestra\Versioning::version('1');
echo PHP_EOL;
orchestra\Versioning::version();
echo PHP_EOL;
orchestra\Versioning::version(false);
echo PHP_EOL;
orchestra\Versioning::version('2');
echo PHP_EOL;
orchestra\Versioning::version();

