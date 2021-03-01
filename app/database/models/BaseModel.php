<?php

namespace app\database\models;

use app\traits\Read;
use app\traits\Create;
use app\traits\Delete;
use app\traits\Update;
use app\traits\Paginate;
use app\traits\Connection;

abstract class BaseModel
{

    use Create, Read, Update, Delete, Paginate, Connection;

}