<?php

$input = array_map('trim', file('input.txt'));

$gamma = '';
$epsilon = '';

$digits = strlen($input[0]);
for ($n = 0; $n < $digits; $n++) {
  $sum = 0;
  for ($i = 0; $i < count($input); $i++) {
    $sum += $input[$i][$n];
  }
  if ($sum > count($input) / 2) {
    $gamma .= '1';
    $epsilon .= '0';
  } else {
    $gamma .= '0';
    $epsilon .= '1';
  }
}

printf("Final values after processing %d inputs are gamma = %s (%d), epsilon = %s (%d). Gives us power consumption of %d.\n", count($input), $gamma, bindec($gamma), $epsilon, bindec($epsilon), bindec($gamma) * bindec($epsilon));

