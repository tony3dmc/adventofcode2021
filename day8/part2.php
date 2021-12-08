<?php

$input = array_map('trim', file('input.txt'));

// $input = [
//   'be cfbegad cbdgef fgaecd cgeb fdcge agebfd fecdb fabcd edb | fdgacbe cefdb cefbgd gcbe',
//   'edbfga begcd cbg gc gcadebf fbgde acbgfd abcde gfcbed gfec | fcgedb cgb dgebacf gc',
//   'fgaebd cg bdaec gdafb agbcfd gdcbef bgcad gfac gcb cdgabef | cg cg fdcagb cbg',
//   'fbegcd cbd adcefb dageb afcb bc aefdc ecdab fgdeca fcdbega | efabcd cedba gadfec cb',
//   'aecbfdg fbg gf bafeg dbefa fcge gcbea fcaegb dgceab fcbdga | gecf egdcabf bgf bfgea',
//   'fgeab ca afcebg bdacfeg cfaedg gcfdb baec bfadeg bafgc acf | gebdcfa ecba ca fadegcb',
//   'dbcfg fgd bdegcaf fgec aegbdf ecdfab fbedc dacgb gdcebf gf | cefg dcbef fcge gbcadfe',
//   'bdfegc cbegaf gecbf dfcage bdacg ed bedf ced adcbefg gebcd | ed bcgafe cdgba cbgef',
//   'egadfb cdbfeg cegd fecab cgb gbdefca cg fgcdab egfdb bfceg | gbdfcae bgc cg cgb',
//   'gcafb gcf dcaebfg ecagb gf abcdeg gaef cafbge fdbac fegbdc | fgae cfgab fg bagce'
// ];

$total = 0;
foreach ($input as $line) {
  list($inputs, $outputs) = explode(' | ', $line);
  $inputs = array_map('sortString', explode(' ', $inputs));

  $outputs = array_map('sortString', explode(' ', $outputs));

  $inputs = analyse($inputs);

  $outputs = array_map(function($o) use ($inputs) { return $inputs[$o]; }, $outputs);
  $total += (int)implode('', $outputs);
}
printf("The total of all output values is %d\n", $total);



function sortString($string) {
  $list = str_split($string);
  sort($list);
  return implode('', $list);
}

function analyse($inputs) {
  $knowns = $unknowns = [];
  foreach ($inputs as $input) {
    switch(strlen($input)) {
      case 2:
        $knowns[1] = $input;
        break;
      case 4:
        $knowns[4] = $input;
        break;
      case 3:
        $knowns[7] = $input;
        break;
      case 7:
        $knowns[8] = $input;
        break;
      case 5:
      case 6:
        $unknowns[] = $input;
        break;
    }
  }
  $knowns = array_map(function($k) { return str_split($k); }, $knowns);
  $unknowns = array_map(function($k) { return str_split($k); }, $unknowns);

  foreach ($unknowns as $k => $unknown) {
    if (count($unknown) == 5 && count(array_intersect($knowns[1], $unknown)) == 2) {
      $knowns[3] = $unknown;
      unset($unknowns[$k]);
    }
  }
  foreach ($unknowns as $k => $unknown) {
    if (count($unknown) == 6 && count(array_intersect($knowns[3], $unknown)) == 5) {
      $knowns[9] = $unknown;
      unset($unknowns[$k]);
    }
  }
  foreach ($unknowns as $k => $unknown) {
    if (count(array_intersect($knowns[1], $unknown)) == 2) {
      $knowns[0] = $unknown;
      unset($unknowns[$k]);
    }
  }
  foreach ($unknowns as $k => $unknown) {
    if (count($unknown) == 6) {
      $knowns[6] = $unknown;
      unset($unknowns[$k]);
    }
  }
  foreach ($unknowns as $k => $unknown) {
    if (count(array_intersect($knowns[9], $unknown)) == 5) {
      $knowns[5] = $unknown;
      unset($unknowns[$k]);
    }
  }
  $knowns[2] = array_pop($unknowns);

  ksort($knowns);
  return array_flip(array_map(function($k) { return implode('', $k); }, $knowns));
}
