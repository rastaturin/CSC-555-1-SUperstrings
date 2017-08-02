<?php

$list =  ['ATG', 'GGG', 'GGT', 'GTA', 'GTG', 'TAT', 'TGG'];

echo findShortest($list);
echo PHP_EOL;

/**
 * Returns shortest common supertstring
 *
 * @param array $list of strings to combine
 * @return string
 */
function findShortest($list) {
    $result = mergeStrings($list);
    foreach (findCombinations($list) as $candidate) {
        $test = mergeStrings($candidate);
        if (strlen($result) > strlen($test)) {
            $result = $test;
        }
    }
    return $result;
}

/**
 * Merges several strings in order, i.e. "ABC", "CAB", "ABD" -> "ABCABD"
 * 
 * @param $list
 * @return string
 */
function mergeStrings($list) {
    $result = '';
    foreach ($list as $word) {
        $result = mergeTwoStrings($result, $word);
    }
    return $result;
}

/**
 * Merges two strings
 * 
 * @param $str1
 * @param $str2
 * @return string
 */
function mergeTwoStrings($str1, $str2) {
    $common = findCommon($str1, $str2);
    return $str1 . substr($str2, $common);
}

function findCommon($str1, $str2) {
    $gap = min(strlen($str1), strlen($str2));
    for ($j = $gap; $j >= 0; $j--) {
        if (substr($str1, -$j) == substr($str2, 0, $j)) {
            return $j;
        }
    }
    return 0;
}

/**
 * Return all combinations of elements of the given array
 *
 * @param array $list
 * @return array
 */
function findCombinations(array $list) {
    if (count($list) == 1) {
        return [$list];
    }

    $result = [];
    for ($i = 0; $i < count($list); $i++) {
        $new = $list;
        $el = $list[$i];
        array_splice($new, $i, 1);
        foreach (findCombinations($new) as $rest) {
            $rest[] = $el;
            $result[] = $rest;
        }
    }
    return $result;
}

