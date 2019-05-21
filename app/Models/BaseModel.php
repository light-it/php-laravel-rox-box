<?php

namespace App\Models;

use App\Traits\System\ModelHelper;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseModel
 * Base model for any inner models
 */
class BaseModel extends Model
{
    use ModelHelper;

}
