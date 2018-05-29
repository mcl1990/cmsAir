<?php

namespace App\Models\Widgets;

use Illuminate\Database\Eloquent\Model;
use App\Master;
use Validator;

class Widget extends Master{
	
    protected $table = 'widgets';
    protected $class_name = 'Widget';
}