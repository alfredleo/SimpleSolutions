# SimpleSolutions
Simple solutions to some questions in php. They are not so simple...

Stress tests were taken from [what-are-the-most-difficult-to-render-unicode-samples](https://stackoverflow.com/questions/34538413/what-are-the-most-difficult-to-render-unicode-samples).
Read more here:
- (strrev-dosent-support-utf-8)[https://stackoverflow.com/questions/17496493/strrev-dosent-support-utf-8]
- (how-to-reverse-a-unicode-string)[https://stackoverflow.com/questions/434250/how-to-reverse-a-unicode-string]


Tests to run:


```php
<?php
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
testMe('👭👬⚧⚥⚣⚢⚤');
echo 'Apple-invented combined emoji:';
testMe('👨‍❤️‍💋‍👨👩‍👩‍👧‍👦');
```
## TODO: 

- Need real tests with double reverse and string comparison.
- None of the function work well with sex emoji variations.