<?php

function deb($arr, $die = false)
{
    echo '<pre>' . print_r($arr, true) . '</pre>';
    if ($die) die;
}

function array_sum_by_key()
{
    $args = func_get_args();

    $arr = array_shift($args);

    $to_sum = is_array($args [0]) ? $args [0] : $args;

    $sum = 0;

    foreach ($arr as $k => $v) {
        if (in_array($k, $to_sum)) {
            $sum += $v;
        }
    }

    return $sum;
}


function array_to_object($array)
{   ///массив перевести в объект
    $obj = new stdClass;
    foreach ($array as $k => $v) {
        if (strlen($k)) {
            if (is_array($v)) {
                $obj->{$k} = array_to_object($v); //RECURSION
            } else {
                $obj->{$k} = $v;
            }
        }
    }
    return $obj;
}

function count_obj($obj)
{   ///объект перевести в массив
    $i = 0;
    foreach ($obj as $key => $val) $i++;
    return $i;
}

function object_to_array($obj)
{   ///объект перевести в массив
    $arrObj = is_object($obj) ? get_object_vars($obj) : $obj;
    foreach ($arrObj as $key => $val) {
        $val = (is_array($val) || is_object($val)) ? object_to_array($val) : $val;
        $arr[$key] = $val;
    }
    return $arr;
}


function getDayRus()
{
// массив с названиями дней недели
    $days = array(
        'Воскресенье', 'Понедельник',
        'Вторник', 'Среда',
        'Четверг', 'Пятница', 'Суббота'
    );
// номер дня недели
// с 0 до 6, 0 - воскресенье, 6 - суббота
    $num_day = (date('w'));
// получаем название дня из массива
    $name_day = $days[$num_day];
// вернем название дня
    return $name_day;
}

function getDaylRus($num_day)
{
// массив с названиями дней недели
    $days = array(
        'Воскресенье', 'Понедельник',
        'Вторник', 'Среда',
        'Четверг', 'Пятница', 'Суббота'
    );
// номер дня недели
// с 0 до 6, 0 - воскресенье, 6 - суббота
// получаем название дня из массива
    $name_day = $days[$num_day];
// вернем название дня
    return $name_day;
}

function getMonRus($num_mon)
{
// массив с названиями дней месяца
    $mons = array('Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня',
        'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря');
// номер мецаца
    $name_mon = $mons[$num_mon];
// вернем название
    return $name_mon;
}

function getMonRusd($num_mon)
{
// массив с названиями дней месяца
    $mons = array('Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
        'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь');
// номер мецаца
    $name_mon = $mons[$num_mon];
// вернем название
    return $name_mon;
}


function cleanInput($input)
{

    $search = array(
        '@<script[^>]*?>.*?</script>@si', // javascript
        '@<[\/\!]*?[^<>]*?>@si', // HTML теги
        /*        '@<style[^>]*?>.*?</style>@siU', // теги style*/
        '@<![\s\S]*?--[ \t\n\r]*>@'         // многоуровневые комментарии
    );
    $output = preg_replace($search, '', $input);
    return $output;
}


