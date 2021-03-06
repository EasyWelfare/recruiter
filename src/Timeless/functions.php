<?php

namespace Timeless;

function clock($clock = null)
{
    global $__2852bec4cda046fca0e5e21dc007935c;
    $__2852bec4cda046fca0e5e21dc007935c =
        $clock ?: (
            $__2852bec4cda046fca0e5e21dc007935c ?: new Clock()
        );
    return $__2852bec4cda046fca0e5e21dc007935c;
}

function now()
{
    return clock()->now();
}

function millisecond($numberOf)
{
    return milliseconds($numberOf);
}

function milliseconds($numberOf)
{
    return new Interval($numberOf);
}

function second($numberOf)
{
    return seconds($numberOf);
}

function seconds($numberOf)
{
    return new Interval($numberOf * Interval::MILLISECONDS_IN_SECONDS);
}

function minute($numberOf)
{
    return minutes($numberOf);
}

function minutes($numberOf)
{
    return new Interval($numberOf * Interval::MILLISECONDS_IN_MINUTES);
}

function hour($numberOf)
{
    return hours($numberOf);
}

function hours($numberOf)
{
    return new Interval($numberOf * Interval::MILLISECONDS_IN_HOURS);
}

function day($numberOf)
{
    return days($numberOf);
}

function days($numberOf)
{
    return new Interval($numberOf * Interval::MILLISECONDS_IN_DAYS);
}

function week($numberOf)
{
    return weeks($numberOf);
}

function weeks($numberOf)
{
    return new Interval($numberOf * Interval::MILLISECONDS_IN_WEEKS);
}

function month($numberOf)
{
    return months($numberOf);
}

function months($numberOf)
{
    return new Interval($numberOf * Interval::MILLISECONDS_IN_MONTHS);
}

function year($numberOf)
{
    return years($numberOf);
}

function years($numberOf)
{
    return new Interval($numberOf * Interval::MILLISECONDS_IN_YEARS);
}

function fromDateInterval(\DateInterval $interval)
{
    $seconds = (string) $interval->s;
    if ($interval->i) {
        $seconds = bcadd($seconds, bcmul((string) $interval->i, '60'));
    }
    if ($interval->h) {
        $seconds = bcadd($seconds, bcmul((string) $interval->h, '3600'));
    }
    if ($interval->d) {
        $seconds = bcadd($seconds, bcmul((string) $interval->d, '86400'));
    }
    if ($interval->m) {
        $seconds = bcadd($seconds, bcmul((string) $interval->m, '2629740'));
    }
    if ($interval->y) {
        $seconds = bcadd($seconds, bcmul((string) $interval->y, '31556874'));
    }

    return seconds($seconds);
}
