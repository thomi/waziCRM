<?php


/**
 * Generates secure pseudo-random integers.
 * @return string
 */
function generate()
{
    return random_int(1000000, 9999999);
}