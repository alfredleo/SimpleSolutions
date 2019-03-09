# PHP support for UTF-8 including emoji. Working with a string.
Simple solutions are not so simple...

Stress tests were taken from [what-are-the-most-difficult-to-render-unicode-samples](https://stackoverflow.com/questions/34538413/what-are-the-most-difficult-to-render-unicode-samples).


Read more here:
- [strrev-dosent-support-utf-8](https://stackoverflow.com/questions/17496493/strrev-dosent-support-utf-8)
- [how-to-reverse-a-unicode-string](https://stackoverflow.com/questions/434250/how-to-reverse-a-unicode-string)
- [function.grapheme-strstr](http://php.net/manual/en/function.grapheme-strstr.php)
- [UFT-8 charset](https://www.fileformat.info/info/charset/UTF-8/list.htm?start=30000)
- [what-every-javascript-developer-should-know-about-unicode](https://dmitripavlutin.com/what-every-javascript-developer-should-know-about-unicode) good explanation of grapheme
- [voku/portable-utf8](https://github.com/voku/portable-utf8)


Tests to run:


```php
<?php
// winner function to reverse any string in php
function reverse5($string)
{
    $length = grapheme_strlen($string);
    $ret = [];
    for ($i = 0; $i < $length; $i += 1) {
        $ret[] = grapheme_substr($string, $i, 1);
    }
    return implode(array_reverse($ret));
}

echo '<pre>';
testMe("ŎŏĞğÇçŞşЎўҒғЧчШш‘", "‘шШчЧғҒўЎşŞçÇğĞŏŎ"); // uzbek problematic letters test
testMe('Hello from github', 'buhtig morf olleH');
testMe("の\r\n", "\r\nの");
testMe('', '');
testMe('1', '1');
testMe('ab', 'ba');
testMe('тест по UTF8', '8FTU оп тсет');
testMe('اهلا بك', 'كب الها');
testMe('👹👺💀👻', '👻💀👺👹');
testMe("abca\xCC\x8Ao\xCC\x88", 'öåcba');
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
testMe('👭👬⚧⚥⚣⚢⚤', '⚤⚢⚣⚥⚧👬👭');
echo 'Emoji with skintone variations:';
testMe('👱👱🏻👱🏼👱🏽👱🏾👱🏿', '👱🏿👱🏾👱🏽👱🏼👱🏻👱');
echo 'Emoji with sex variations:';
testMe('🧟‍♀️🧟‍♂️', '🧟‍♂️🧟‍♀️');
echo 'Apple-invented combined emoji:';
testMe('👨‍❤️‍💋‍👨👩‍👩‍👧‍👦', '👩‍👩‍👧‍👦👨‍❤️‍💋‍👨');
echo '</pre>';
```
## TODO: 

- ~~Need real tests with double reverse and string comparison.~~
- ~~None of the function work well with sex emoji variations.~~