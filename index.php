<?php

/**
 * Test online with https://3v4l.org/
 * Create function to reverse a string in php
 * Ex: abcd is returned as dcba
 * 1) simplest possible
 * 2) without any built-in functions
 * 3) you can use only one string in memory on low resources.
 * 4) that works with utf-8 too
 * 5) with full grapheme support
 * 6) using IntlBreakIterator
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
 * This function pass all the tests visually if test in real browser.
 * Set as standard for tests.
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

/**
 * IntlBreakIterator can be used since PHP 5.5 (intl 3.0)
 * @param $str
 * @return string
 */
function reverse6($str)
{
    $it = IntlBreakIterator::createCodePointInstance();
    $it->setText($str);
    $ret = '';
    $pos = 0;
    $prev = 0;
    foreach ($it as $pos) {
        $ret = substr($str, $prev, $pos - $prev) . $ret;
        $prev = $pos;
    }
    return $ret;
}

/**
 * @param $str
 * @param $functionName
 * @param $correctReverse
 */
function compareStrings($str, $functionName, $correctReverse)
{
    $reversed = $functionName($str);
    $testPass = ($reversed === $correctReverse);
    echo $reversed . (($testPass) ? ' <b style="color:green">PASS</b>' : ' <b style="color:red">FAIL</b>') . PHP_EOL;
}

/**
 * @param $str
 * @param $correctReverse
 */
function testMe($str, $correctReverse)
{
    echo "--- Testing: '$str'" . PHP_EOL;
    compareStrings($str, 'reverse1', $correctReverse);
    compareStrings($str, 'reverse2', $correctReverse);
    compareStrings($str, 'reverse3', $correctReverse);
    compareStrings($str, 'reverse4', $correctReverse);
    compareStrings($str, 'reverse5', $correctReverse);
    compareStrings($str, 'reverse6', $correctReverse);
    echo "----------------------------" . PHP_EOL;
}

echo '<pre>';
testMe('Hello from github', 'buhtig morf olleH');
testMe('1', '1');
testMe('ab', 'ba');
testMe('тест по UTF8', '8FTU оп тсет');
testMe('اهلا بك', 'كب الها');
testMe('👹👺💀👻', '👻💀👺👹');
testMe("abca\xCC\x8Ao\xCC\x88",'öåcba');
testMe("\u{1000}\u{1F7C9}\u{12043}𒁂\u{12042}\u{12030}\u{12031}\u{10ffff}", '􏿿𒀱𒀰𒁂𒁂𒁃🟉က');
echo 'Vertically-stacked characters:';
testMe('Z̤͔ͧ̑̓ä͖̭̈̇lͮ̒ͫǧ̗͚̚o̙̔ͮ̇͐̇', 'o̙̔ͮ̇͐̇ǧ̗͚̚lͮ̒ͫä͖̭̈̇Z̤͔ͧ̑̓');
echo 'Right-to-left words:';
testMe('اختبار النص', 'صنلا رابتخا');
echo 'Mixed-direction words:';
testMe('من left اليمين to الى right اليسار', 'راسيلا thgir ىلا ot نيميلا tfel نم');
echo 'Mixed-direction characters:';
testMe('a‭b‮c‭d‮e‭f‮g', 'g‮f‭e‮d‭c‮b‭a');
echo 'Very long characters:';
testMe('﷽﷽﷽﷽﷽﷽﷽﷽﷽﷽﷽﷽﷽﷽﷽﷽', '﷽﷽﷽﷽﷽﷽﷽﷽﷽﷽﷽﷽﷽﷽﷽﷽');
echo 'Emoji with skintone variations:';
testMe('👱👱🏻👱🏼👱🏽👱🏾👱🏿', '👱🏿👱🏾👱🏽👱🏼👱🏻👱');
echo 'Emoji with sex variations:';
testMe('🧟‍♀️🧟‍♂️', '🧟‍♂️🧟‍♀️');
testMe('👭👬⚧⚥⚣⚢⚤', '⚤⚢⚣⚥⚧👬👭');
echo 'Apple-invented combined emoji:';
testMe('👨‍❤️‍💋‍👨👩‍👩‍👧‍👦', '👩‍👩‍👧‍👦👨‍❤️‍💋‍👨');
echo '</pre>';