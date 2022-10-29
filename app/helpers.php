<?php

use Illuminate\Support\Str;

if (!function_exists('getExceptionTraceAsString')) {
    function getExceptionTraceAsString(Throwable $exception): string
    {
        $rtn = "";
        $count = 0;
        foreach ($exception->getTrace() as $frame) {
            $args = "";
            if (isset($frame['args'])) {
                $args = [];
                foreach ($frame['args'] as $arg) {
                    if (is_string($arg)) {
                        $args[] = "'" . $arg . "'";
                    } elseif (is_array($arg)) {
                        $args[] = "Array";
                    } elseif (is_null($arg)) {
                        $args[] = 'NULL';
                    } elseif (is_bool($arg)) {
                        $args[] = ($arg) ? "true" : "false";
                    } elseif (is_object($arg)) {
                        $args[] = get_class($arg);
                    } elseif (is_resource($arg)) {
                        $args[] = get_resource_type($arg);
                    } else {
                        $args[] = $arg;
                    }
                }
                $args = join(", ", $args);
            }
            $rtn .= sprintf(
                "#%s %s(%s): %s(%s)\n",
                $count,
                $frame['file'] ?? 'unknown file',
                $frame['line'] ?? 'unknown line',
                isset($frame['class']) ? $frame['class'] . $frame['type'] . Arr::get($frame,
                        'function') : Arr::get($frame, 'function'),
                $args
            );
            $count++;
        }

        return Str::limit($rtn, 4000);
    }
}

if (!function_exists('turnCentimeterToFoot')) {
    function turnCentimeterToFoot(int $cm): float
    {
        return round($cm * 0.032808399, 1);
    }
}

if (!function_exists('turnKilogramToLbs')) {
    function turnKilogramToLbs(int $kg): float
    {
        return round($kg * 2.2046244202);
    }
}

if (!function_exists('getPercentage')) {
    function getPercentage(float $full, $number): float
    {
        if ($full > 0) {
            return round($number * 100 / $full, 2);
        }

        return 0;
    }
}