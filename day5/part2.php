<?php

error_reporting(E_ALL ^ E_NOTICE);

$input = array_map('trim', file('input.txt'));

// $input = [
//   '0,9 -> 5,9',
//   '8,0 -> 0,8',
//   '9,4 -> 3,4',
//   '2,2 -> 2,1',
//   '7,0 -> 7,4',
//   '6,4 -> 2,0',
//   '0,9 -> 2,9',
//   '3,4 -> 1,4',
//   '0,0 -> 8,8',
//   '5,5 -> 8,2'
// ];

$grid = [];
foreach ($input as $def) {
  list($x1, $y1, $x2, $y2) = preg_split('/\D+/', $def);

  $x = $x1;
  $y = $y1;
  while ($x != $x2 || $y != $y2) {
    $grid[$x][$y]++;
    if ($x != $x2) {
      $x += $x1 < $x2 ? 1 : -1;
    }
    if ($y != $y2) {
      $y += $y1 < $y2 ? 1 : -1;
    }
  }
  $grid[$x][$y]++;
}

$overlaps = 0;
foreach ($grid as $x => $ys) {
  foreach ($ys as $y) {
    if ($y > 1) {
      $overlaps++;
    }
  }
}
printf("There are %d overlaps in the grid\n", $overlaps);