<?php

function getDureeAvecDateTime($datetime){
    $date = new DateTime($datetime);
    $now = new DateTime('next hour');
    $diff = $now->diff($date);
    if($diff->y){
        return $diff->format('%y an').(($diff->y > 1)?'s':'');
    }else if($diff->m){
        return $diff->format('%m mois');
    }else if($diff->d){
        return $diff->format('%d jour').(($diff->d > 1)?'s':'');
    }else if($diff->h){
        return $diff->format('%h heure').(($diff->h > 1)?'s':'');
    }else if($diff->i){
        return $diff->format('%i minute').(($diff->i > 1)?'s':'');
    }else{
        return $diff->format('%s seconde').(($diff->s > 1)?'s':'');
    }
}