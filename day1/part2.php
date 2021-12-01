<?php

$input = array_map('trim', file('input.txt'));

$increases = 0;
$last = $input[0] + $input[1] + $input[2];
for ($i = 2; $i < count($input); $i++) {
  $moving_average = array_sum(array_slice($input, $i - 2, 3));
  if ($moving_average > $last) {
    $increases++;
  }
  $last = $moving_average;
}

printf("There were %d moving average depth increases in the %d sample measurements\n", $increases, count($input));
