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
    function turnCentimeterToFoot(int $cm): string
    {
        return number_format(round($cm * 0.032808399, 1), 1, '\'');
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

if (!function_exists('split_paragraph')) {
    function split_paragraph($paragraph, $smaller_font_size_ratio = 0.8, $second_half_max_length = 50) {
        // minimize the paragraph
        $paragraph = substr($paragraph, 0, 120);

        $words = explode(' ', $paragraph);
        $half = round(count($words) / 2);

        $first_half = implode(' ', array_slice($words, 0, $half));
        $second_half = implode(' ', array_slice($words, $half));

        $second_half = substr($second_half, 0, $second_half_max_length);

        $first_half_length = strlen($first_half);
        $second_half_length = strlen($second_half);

        $font_size_ratio = $second_half_length / $first_half_length * $smaller_font_size_ratio;

        $output = "$first_half" . "<br><span >$second_half ...</span>";

        return $output;
    }
}
