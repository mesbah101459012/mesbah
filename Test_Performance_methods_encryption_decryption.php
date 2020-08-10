<?php
/**
 * User: Arris
 * Date: 21.09.2017, time: 0:35
 */
 
 error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
const TEST_COUNT = 100000;
const SOURCE = 'Тестируем обратимое шифрование на php';
const KEY = "password";

function TESTER( $testing_function, $argument )
{
    $t = microtime(true);

    for ($test_iterator = 0; $test_iterator < TEST_COUNT; $test_iterator++) {
        $testing_function( $argument );
    }
    return round(microtime(true) - $t, 4);
}

$crypt = function($cipher) {
    $ivlen = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($ivlen);
    openssl_encrypt(SOURCE, $cipher, KEY, $options=0, $iv);
};

$methods = openssl_get_cipher_methods(false);

array_splice( $methods, 0, count($methods) / 2);

$timings = array();

foreach ($methods as $cypher) {
    $time = TESTER( $crypt, $cypher );
    $timings[ $cypher ] = $time;

    echo str_pad($cypher, 40, ' ', STR_PAD_LEFT), " have time  ", str_pad($time, 8, STR_PAD_LEFT), ' seconds. ', PHP_EOL;
}

uasort($timings, function($a, $b){
    return $a <=> $b;
});

$min_time = round(reset($timings) / TEST_COUNT, 7);
$min_cypher = key($timings);

$max_time = round(end($timings) / TEST_COUNT, 7);
$max_cypher = key($timings);

echo '-------------', PHP_EOL;
echo "Total tests: ", count($timings), PHP_EOL;
echo "Max timing : {$max_time} seconds for `{$max_cypher}` algorithm.", PHP_EOL;
echo "Min timing : {$min_time} seconds for `{$min_cypher}` algorithm.", PHP_EOL;

echo 'Details: ', PHP_EOL;

foreach ($timings as $m => $t) {
    echo '- ', str_pad($t, 8, STR_PAD_LEFT), " seconds for `{$m}`",  PHP_EOL;
}

echo PHP_EOL;