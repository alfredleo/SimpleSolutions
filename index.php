<?php

/**
 * Create function to reverse a string in php
 * Ex: abcd is returned as dcba
 * 1) simplest possible
 * 2) without any built-in functions
 * 3) you can use only one string in memory on low resources.
 * 4) TODO: that works with utf-8 too
 */

/**
 * @param $string
 * @return string
 */
function reverse1($string)
{
    return strrev($string);
}

/**
 * @param $string
 * @return string
 */
function reverse2($string)
{
    $size = strlen($string);
    $reversed = '';
    for ($i = 0; $i < $size; $i++) {
        $reversed .= $string[$size - $i - 1];
    }
    return $reversed;
}

/**
 * @param $string
 * @return mixed
 */
function reverse3($string)
{
    $size = strlen($string);
    for ($i = (int)($size / 2.0) - 1; $i >= 0; $i--) {
        $tempChar = $string[$i]; // save iterating character
        $string[$i] = $string[$size - $i - 1]; // send last character to new position
        $string[$size - $i - 1] = $tempChar; // put character to the end
    }
    return $string;
}

// testing
function testMe($str)
{
    echo reverse3($str) . PHP_EOL;
    echo reverse1($str) . PHP_EOL;
    echo reverse2($str) . PHP_EOL . PHP_EOL;
}

testMe('Hello from github');
testMe('1');
testMe('ab');
testMe('тест по UTF8'); // TODO
