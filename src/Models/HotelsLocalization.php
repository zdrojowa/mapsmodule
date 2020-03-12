<?php

namespace Selene\Modules\MapsModule\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class HotelsLocalization extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'full_name',
        'logo',
        'photo',
        'localization',
        'reservation',
        'reception',
        'status',
        'coordinates',
        'sell',
        'arrive',
        'street',
        'copyright'
    ];

    /**
     * @var string
     */
    protected $connection = 'mongodb';
}
