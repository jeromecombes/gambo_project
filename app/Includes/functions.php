<?php

function cmp_countDesc($a,$b) {
    if ($a['type'] == $b['type']) {
        if ($a['count'] == $b['count']) {
            return 0;
        } else {
            return ($a['count'] > $b['count']) ? -1 : 1;
        }
    }
    return ($a['type'] > $b['type']) ? -1 : 1;
}
