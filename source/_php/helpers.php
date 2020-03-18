<?php

function estimate_read_time($content, $wordsPerMinute=200, $minutesOnly=false, $abbreviated=true, $suffix='read') {
    $wordCount = str_word_count(strip_tags($content));

    $WordsPerMinute = (int) $wordsPerMinute;
    if( $wordsPerMinute <= 0 ) {
        $WordsPerMinute = 200;
    }

    $minutes = floor($wordCount / $wordsPerMinute);
    $seconds = floor($wordCount % $wordsPerMinute / ($wordsPerMinute / 60));

    if( $minutesOnly === true && $minutes > 0 ) {
        if($seconds >= 30){
            $minutes++;
        }
    }

    if($abbreviated === true) {
        $strMinutes = 'min';
        $strSeconds = 'sec';
    } else {
        $strMinutes = ($minutes == 1) ? "minute" : "minutes";
        $strSeconds = ($seconds == 1) ? "second" : "seconds";
    }

    if($minutes == 0){
        $returnString = "{$seconds} {$strSeconds}";
    } elseif($minutesOnly === true) {
        $returnString = "{$minutes} {$strMinutes}";
    } else {
        $returnString = "{$minutes} {$strMinutes}, {$seconds} {$strSeconds}";
    }

    if( is_string($suffix) && !empty(trim($suffix))) {
        $returnString .= ' ' . trim($suffix);
    }

    return $returnString;
}