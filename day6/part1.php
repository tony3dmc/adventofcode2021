<?php

$input = array_map('trim', file('input.txt'));

// $input = [
//   '3,4,3,1,2'
// ];
$days = 80;

$childhood = 2;
$gestation = 6;
$fish = explode(',', $input[0]);

printf("Initial state: %s\n", implode(',', $fish));

for ($day = 0; $day < $days; $day++) {
  $new_fish = array_fill(0, count($fish) - count(array_filter($fish)), $childhood + $gestation);
  $fish = array_merge(array_map(function($f) use ($gestation) {
    return $f > 0 ? $f - 1 : $gestation;
  }, $fish), $new_fish);
  // printf("After %d days: %s\n", $day + 1, implode(',', $fish));
}

printf("A total of %d fish exist after %d days\n", count($fish), $days);