<?php

if (!function_exists('generateToken')) {
    function generateToken(int $length): string
    {
        $digits = range(0, 9);
        shuffle($digits);

        $uniqueNumber = '';
        for ($i = 0; $i < $length; $i++) {
            $uniqueNumber .= $digits[$i];
        }

        return $uniqueNumber;
    }
}

if (!function_exists('checkPermission')) {
    function checkPermission(array $permissions): bool
    {
        dd($permissions);
        return true;
    }
}
