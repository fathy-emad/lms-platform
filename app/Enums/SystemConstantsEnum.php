<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum SystemConstantsEnum: string
{
    use EnumTrait;

    //Do not miss if add new enum add it to database

    case StageEnumTable = "StageEnumTable";
    case SubjectEnumTable = "SubjectEnumTable";
    case YearEnumTable = "YearEnumTable";
    case CurriculumEnumTable = "CurriculumEnumTable";
    case BranchEnumTable = "BranchEnumTable";
    case ChapterEnumTable = "ChapterEnumTable";
    case LessonEnumTable = "LessonEnumTable";
    case TermEnumTable = "TermEnumTable";
    case TypeEnumTable = "TypeEnumTable";
    case NamePrefixEnumTable = "NamePrefixEnumTable";
}
