<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum EduTermsEnum: string
{
    use EnumTrait;
    case FirstTerm = "firstTerm";
    case SecondTerms = "secondTerm";
    case Scientific = "scientific";
    case Literary = "literary";
    case ScientificScience = "scientificScience";
    case ScientificMathematics = "scientificMathematics";

}
