# SimpleSolutions
Simple solutions to some questions in php.
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
echo 'Apple-invented combined emoji:';
testMe('👨‍❤️‍💋‍👨👩‍👩‍👧‍👦');
```
