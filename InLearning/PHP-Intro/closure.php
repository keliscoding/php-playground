<?php

$names = array('Joe', 'Erin', 'Teresa', 'Louis');
usort($names, function ($a, $b) {
    return $a[1] <=> $b[1]; // greater than, less than and equal to all in one shot.
});

echo print_r($names);