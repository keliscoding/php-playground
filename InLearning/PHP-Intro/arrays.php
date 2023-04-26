<?php

/*
 * indexable arrays -> numbered keys
 * start at 0, basically a normal array
 *
 * associative arrays -> string as keys
 */

//indexable array
$colors = array('red', 'green', 'blue');

echo $colors[1] . PHP_EOL;

$colors[] = 'yellow';

print_r($colors);

// Associative Arrays

$home_towns = array(
    "Joe" => "Middletown, NY",
    "Erin" => "West Chester, PA",
    "Dave" => "Exton, PA",
);

print_r($home_towns);

$brothers = array(
    "Joe" => array(
        'age' => 34,
        'job' => 'teacher',
        'state' => 'PA',
        ),
    "Erin" => array(
        'age' => 33,
        'job' => 'photographer',
        'state' => 'NY',
    ),
    "Dave" => array(
        'age' => 32,
        'job' => 'logistics',
        'state' => 'NY',
    ),
);

print_r($brothers);
print_r($brothers["Dave"]["age"]);