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

$uniques = 0;
$unique_lengths = [ 2, 4, 3, 7 ];

foreach ($input as $line) {
  list($inputs, $outputs) = explode(' | ', $line);
  $inputs = explode(' ', $inputs);
  $outputs = explode(' ', $outputs);

  $uniques += count(array_filter($outputs, function($i) use ($unique_lengths) {
    return in_array(strlen($i), $unique_lengths);
  }));
}

printf("There are a total of %d unique outputs in the data\n", $uniques);