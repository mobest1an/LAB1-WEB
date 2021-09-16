<?php

function check($x, $y, $r)
{
    if ($x >= 0 && $y >= 0 && (pow($x, 2) + pow($y, 2)) <= pow($r / 2, 2)) {
        return true;
    }

    if ($x <= 0 && $y <= 0 && $x >= -$r && $y >= -$r) {
        return true;
    }

    if ($x >= 0 && $y <= 0 && $y - $x >= (-$r / 2)) {
        return true;
    }

    return false;
}
