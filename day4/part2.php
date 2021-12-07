<?php

$input = array_map('trim', file('input.txt'));

// $input = [
//   '7,4,9,5,11,17,23,2,0,14,21,24,10,16,13,6,15,25,12,22,18,20,8,19,3,26,1',
//   '',
//   '22 13 17 11  0',
//   ' 8  2 23  4 24',
//   '21  9 14 16  7',
//   ' 6 10  3 18  5',
//   ' 1 12 20 15 19',
//   '',
//   ' 3 15  0  2 22',
//   ' 9 18 13 17  5',
//   '19  8  7 25 23',
//   '20 11 10 24  4',
//   '14 21 16 12  6',
//   '',
//   '14 21 17 24  4',
//   '10 16 15  9 19',
//   '18  8 23 26 20',
//   '22 11 13  6  5',
//   ' 2  0 12  3  7'
// ];

$draws = explode(',', $input[0]);
$boards = $board = [];
for ($i = 2; $i < count($input); $i++) {
  if ($input[$i]) {
    $board[] = preg_split('/\s+/', trim($input[$i]));
  } else {
    $boards[] = $board;
    $board = [];
  }
}
$boards[] = $board;

$answer = getresults($draws, $boards);
printf("The final board to win had a score of %d\n", $answer);

function getresults($draws, $boards) {
  foreach ($draws as $draw) {
    foreach ($boards as $k => $board) {
      $boards[$k] = updateboard($board, $draw);
      if (checkwin($boards[$k])) {
        if (count($boards) == 1) {
          $answer = $draw * array_reduce($boards[$k], function($c, $i) {
            return $c + array_sum($i);
          });
          return $answer;
        } else {
          unset($boards[$k]);
        }
      }
    }
  }
}

function updateboard($board, $draw) {
  return array_map(function($b) use ($draw) {
    return array_map(function($i) use ($draw) {
      return $i == $draw ? 'x' : $i;
    }, $b);
  }, $board);
}

function checkwin($board) {
  return array_sum(array_map(function($b) {
    return implode('',$b) == 'xxxxx';
  }, array_merge($board, array_map(null, ...$board))));
}

