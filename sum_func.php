<?php

/**
 * Считает сумму двух чисел, заданных одной строкой через пробел
 *
 * @param $str
 * @return string
 */
function sum ($str) {

    list($num1, $num2) = explode(' ', $str);

    $num1 = (string)$num1;
    $num2 = (string)$num2;

    $l1 = strlen($num1);
    $l2 = strlen($num2);
    $res = '';
    $flag = 0;

    for ($i = 1; $i <= max($l1, $l2); $i++) {
        $c1 = ($l1 - $i) < 0 ? 0 : $num1[$l1 - $i];
        $c2 = ($l2 - $i) < 0 ? 0 : $num2[$l2 - $i];
        $sum = $c1 + $c2 + $flag;
        $flag = ($sum > 9) ? 1 : 0;
        $res .= $sum % 10;
    }

    return ltrim(strrev($res), '0');
}

/**
 * Пример использования
 */
//echo sum('25 655604998650439860954860954860954685049680459586509685498375498579834759843759843573498576439869784365874365874365847365487356');
