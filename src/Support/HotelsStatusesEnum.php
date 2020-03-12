<?php

namespace Selene\Modules\MapsModule\Support;

use MyCLabs\Enum\Enum;

class HotelsStatusesEnum extends Enum
{
    protected const MAIN = 'main';
    protected const IN_PROGRESS = 'in_progress';
    protected const COMPLETED = 'completed';
}
