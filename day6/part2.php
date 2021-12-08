<?php

error_reporting(E_ALL ^ E_NOTICE);

$input = array_map('trim', file('input.txt'));

// $input = [
//   '3,4,3,1,2'
// ];
$days = 256;

$childhood = 2;
$gestation = 6;
$fish = explode(',', $input[0]);

$population = [];
foreach ($fish as $fishie) {
  $population[$fishie]++;
}
printf("Initial state: %s (%d fish)\n", showPopulation($population), array_sum($population));

for ($day = 0; $day < $days; $day++) {
  if (isset($population[0])) {
    $population[$gestation + 1] += $population[0];
    $population[$gestation + $childhood + 1] += $population[0];
    unset($population[0]);
  }

  $new_population = [];
  foreach ($population as $age => $count) {
    $new_population[$age - 1] = $count;
  }
  $population = $new_population;
  printf("After %d days: %s (%d fish)\n", $day + 1, showPopulation($population), array_sum($population));
}

printf("A total of %d fish exist after %d days\n", array_sum($population), $days);

function showPopulation($population) {
  ksort($population);
  $output = [];
  foreach ($population as $age => $count) {
    $output[] = $age . ' => ' . $count;
  }
  return implode(', ', $output);
}