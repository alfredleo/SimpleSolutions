<?php

/**
 * Test online with https://3v4l.org/
 * Create function to reverse a string in php
 * Ex: abcd is returned as dcba
 * 1) simplest possible
 * 2) without any built-in functions
 * 3) you can use only one string in memory on low resources.
 * 4) that works with utf-8 too
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

/**
 * Pattern modifiers: u(PCRE_UTF8), s(PCRE_DOTALL)
 * Use utf-8 and match dot.
 * @param $str
 * @return string
 */
function reverse4($str)
{
    preg_match_all('/./us', $str, $ar);
    return join('', array_reverse($ar[0]));
}

/**
 * All other function won't work correct with some grapheme
 * @param $string
 * @return string
 */
function reverse5($string)
{
    $length = grapheme_strlen($string);
    $ret = [];
    for ($i = 0; $i < $length; $i += 1) {
        $ret[] = grapheme_substr($string, $i, 1);
    }
    return implode(array_reverse($ret));
}

// testing
function testMe($str)
{
    echo "--- Testing '$str' ---" . PHP_EOL;
    echo reverse1($str) . PHP_EOL;
    echo reverse2($str) . PHP_EOL;
    echo reverse3($str) . PHP_EOL;
    echo reverse4($str) . PHP_EOL;
    echo reverse5($str) . PHP_EOL . PHP_EOL;
}


testMe('Hello from github');
testMe('1');
testMe('ab');
testMe('тест по UTF8');
testMe('اهلا بك');
testMe('👹👺💀👻');
testMe("abca\xCC\x8Ao\xCC\x88");
testMe(json_decode('"' . '\u1000' . '"'));
echo 'Vertically-stacked characters:';
testMe('Z̤͔ͧ̑̓ä͖̭̈̇lͮ̒ͫǧ̗͚̚o̙̔ͮ̇͐̇');
echo 'Right-to-left words:';
testMe('اختبار النص');
echo 'Mixed-direction words:';
testMe('من left اليمين to الى right اليسار');
echo 'Mixed-direction characters:';
testMe('a‭b‮c‭d‮e‭f‮g');
echo 'Very long characters:';
testMe('﷽﷽﷽﷽﷽﷽﷽﷽﷽﷽﷽﷽﷽﷽﷽﷽');
echo 'Emoji with skintone variations:';
testMe('👱👱🏻👱🏼👱🏽👱🏾👱🏿');
echo 'Emoji with sex variations:';
testMe('🧟‍♀️🧟‍♂️');
echo 'Apple-invented combined emoji:';
testMe('👨‍❤️‍💋‍👨👩‍👩‍👧‍👦');
