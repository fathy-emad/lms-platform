<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum QuestionTypeEnum: string
{
    //Do not miss if add any type here add it in database table bank_question on QuestionTypeEnum column

    use EnumTrait;

    case Choose = 'choose';
}
