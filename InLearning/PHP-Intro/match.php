<?php

// match

$x = 0;

$result = match($x) {
    1 => '$x is 1',
    2 => '$x is 2',
    default => '$x is neither 1 nor 2',
};

echo $result;