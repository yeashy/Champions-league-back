<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class Stages extends Enum
{
    const GroupStage1 = 'Group Stage, Round 1';
    const GroupStage2 = 'Group Stage, Round 2';
    const GroupStage3 = 'Group Stage, Round 3';
    const GroupStage4 = 'Group Stage, Round 4';
    const GroupStage5 = 'Group Stage, Round 5';
    const GroupStage6 = 'Group Stage, Round 6';
    const FirstRound = 'Knockout, First Round';
    const QuaterFinal = 'Knockout, Quaterfinals';
    const SemiFinal = 'Knockout, Semifinals';
    const Final = 'Knockout, Final';
    const Winner = 'Winner';
}
