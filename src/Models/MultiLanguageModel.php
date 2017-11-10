<?php

/**
 * Created by PhpStorm.
 * User: emillion
 * Date: 10/02/2017
 * Time: 2:02
 */

namespace Lionch\Multilingual\Models;

use Illuminate\Database\Eloquent\Model;
use Lionch\Multilingual\Helpers\HasMultiLanguageAttributes;

class MultilingualModel extends Model
{

    use HasMultiLanguageAttributes;

}
