<?php

$input = array_map('trim', file('input.txt'));

/*$input = [
  '00100',
  '11110',
  '10110',
  '10111',
  '10101',
  '01111',
  '00111',
  '11100',
  '10000',
  '11001',
  '00010',
  '01010'
];
*/

# Oxygen generator rating
$generator = getRating($input, 1);
$scrubber = getRating($input, 0);

printf("Oxygen generator is %d (%s) and CO2 scrubber is %d (%s). Life support rating is %d\n", bindec($generator), $generator, bindec($scrubber), $scrubber, bindec($generator) * bindec($scrubber));


function getRating($input, $type) {
  for ($n = 0; $n < strlen($input[0]); $n++) {
    $ones = array_reduce($input, function($c, $i) use ($n) {
      return $i[$n] + $c;
    });

    $comp = $ones < count($input) / 2 ? abs($type - 1) : $type;
    $input = array_values(array_filter($input, function($k) use ($n, $comp) {
      return $k[$n] == $comp;
    }));

    if (count($input) == 1) {
      return $input[0];
    }
  }
  return false;
}