<?php

$input = array_map('trim', file('input.txt'));

$increases = 0;
$last = $input[0];
for ($i = 0; $i < count($input); $i++) {
  if ($input[$i] > $last) {
    $increases++;
  }
  $last = $input[$i];
}

printf("There were %d depth increases in the %d sample measurements\n", $increases, count($input));
