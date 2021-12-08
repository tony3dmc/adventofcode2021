<?php

$input = array_map('trim', file('input.txt'));

// $input = [
//   '16,1,2,0,4,2,7,1,2,14'
// ];

$positions = explode(',', $input[0]);

// $target = median($positions);
$lowest_fuel = 0;
$lowest_distance = 0;
for ($i = 0; $i < max($positions); $i++) {
  $target = $i;

  $fuel = array_sum(array_map(function($p) use ($target) {
    $distance = abs($p - $target);
    return (($distance * ($distance + 1)) / 2);
  }, $positions));

  if ($fuel < $lowest_fuel || !$lowest_fuel) {
    $lowest_fuel = $fuel;
    $lowest_distance = $target;
  }
  printf("To reach position %d will take %d fuel\n", $target, $fuel);
}
printf("\nPosition %d was the lowest with %d fuel\n", $lowest_distance, $lowest_fuel);

function median($ints) {
  sort($ints);
  if (count($ints) % 2) {
    return $ints[(count($ints) - 1)/2];
  } else {
    $pos = count($ints) / 2;
    return (($ints[$pos] + $ints[$pos-1]) / 2);
  }
}
