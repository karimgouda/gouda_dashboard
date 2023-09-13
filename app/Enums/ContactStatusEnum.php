<?php


namespace App\Enums;

use App\Enums\EnumUtils;

enum ContactStatusEnum: string
{
    use EnumUtils;

    case NEW      = 'new';
    case VIEWED     = 'viewed';
    case INPROGRESS = 'in_progress';
    case DONE       = 'done';

}
