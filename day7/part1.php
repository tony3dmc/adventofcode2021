<?php

$input = array_map('trim', file('input.txt'));

$input = [
  '16,1,2,0,4,2,7,1,2,14'
];

$positions = explode(',', $input[0]);

$target = median($positions);

$fuel = array_sum(array_map(function($p) use ($target) {
  return abs($p - $target);
}, $positions));
printf("To reach position %d will take %d fuel\n", $target, $fuel);

function median($ints) {
  sort($ints);
  if (count($ints) % 2) {
    return $ints[(count($ints) - 1)/2];
  } else {
    $pos = count($ints) / 2;
    return (($ints[$pos] + $ints[$pos-1]) / 2);
  }
}