<?php

namespace vektah\common;

class System
{
    public static function cpuCount()
    {
        if (is_file('/proc/cpuinfo')) {
            $cpuinfo = file_get_contents('/proc/cpuinfo');
            preg_match_all('/^processor/m', $cpuinfo, $matches);

            return count($matches[0]);
        } elseif ('WIN' == strtoupper(substr(PHP_OS, 0, 3))) {
            return intval(system('wmic cpu get NumberOfCores'));
        } else {
            $cpus = intval(system('sysctl -n hw.ncpu', $failure));

            if ($failure) {
                $cpus = 2;
            }

            return $cpus;
        }
    }
}
