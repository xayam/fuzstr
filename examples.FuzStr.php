<?php

include_once __DIR__ . '/class.FuzStr.php';

$fuzstr = new FuzStr();

//test1
$input  = "иван ёва ф34 4ф 444  уцйа куп  errgf rtf  rtg куу п куп куп ивану";
$input2 = mb_strrev($input);

$fuzstr->init($input, explode(' ', $input));
echo $fuzstr->fuzzy() . "\n";

$fuzstr->init($input2, explode(' ', $input2), 5);
echo $fuzstr->fuzzy() . "\n";

$fuzstr->init($input, explode(' ', $input2), 3, true);
echo $fuzstr->fuzzy() . "\n\n";

//test2
$input =  'стартовал молоденький паренёк только вчера прибывший на свою первую практику это' .
    ' было действительно 1 практика курсантов лика за всё время его недолгое но плодотворный ' .
    'учёбы и сразу боевое дежурство гордость';
$input2 = 'это была действительно первая практика курсанта флика за всё время его недолгой но плодотворной' .
    ' учёбы и сразу боевое дежурство гордость и ответственность за хорошо отработанную смену читалась ' .
    'сейчас на его хоть и немного сонном но счастливом лице';

$fuzstr->init($input, explode(' ', $input2), 1, true); //??? >100%
echo $fuzstr->fuzzy() . "\n";

$fuzstr->init($input, explode(' ', $input2), 2, true);
echo $fuzstr->fuzzy() . "\n";

$fuzstr->init($input, explode(' ', $input2), 3, true);
echo $fuzstr->fuzzy() . "\n";

$fuzstr->init($input, explode(' ', $input2), 5, true);
echo $fuzstr->fuzzy() . "\n";

$fuzstr->init($input, explode(' ', $input2), 15, true);
echo $fuzstr->fuzzy() . "\n";

$fuzstr->init($input, explode(' ', $input2), 50, true);
echo $fuzstr->fuzzy() . "\n\n";

//test3
$input = "прогзвольные";
$input2  = "андрей (и все кто захочет присоединяйтесь), напиши две произвольные строки для сравнения (нечеткого) ," . 
" какие первые придут в голову, можно откуда-то скопировать, не очень маленькие не очень большие, но первая строка" . 
" должна быть меньше второй, так как поиск осуществляется вхождение первой строки во вторую... плиз. А я напишу" . 
" сколько мой нечеткий алгоритм выдает соответствия в процентах... (я тут тестирую своё то что мы с тобой" . 
" в личке обсуждали)";

$fuzstr->init($input, explode(' ', $input2));
echo $fuzstr->fuzzy() . "\n\n";
exit();
