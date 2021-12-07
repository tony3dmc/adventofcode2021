<?php

$input = array_map('trim', file('input.txt'));

$x = 0;
$y = 0;
$aim = 0;
for ($i = 0; $i < count($input); $i++) {
  list($direction, $amount) = explode(' ', $input[$i]);
  switch ($direction) {
    case 'forward':
      $x += $amount;
      $y += $aim * $amount;
      break;
    case 'down':
      $aim += $amount;
      break;
    case 'up':
      $aim -= $amount;
      break;
  }
}

printf("After %d movements, we are at %d horizontal and %d depth. Final answer is %d\n", count($input), $x, $y, $x * $y);

