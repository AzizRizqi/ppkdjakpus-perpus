<?php

function getStatus($status)
{
    switch ($status) {
        case '1':
            $label =  "<span class='badge text-bg-primary badge-secondary'>sedang di pinjam</span>";
            break;
        case '2':
            $label = "<span class = 'badge text-bg-success badge-primary'>sudah di kembalikan</span>";
            break;

        default:
            $label = "";
            break;
    }
    return $label;
}
