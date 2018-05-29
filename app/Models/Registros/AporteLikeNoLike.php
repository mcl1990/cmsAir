<?php

namespace App\Models\Registros;

use Illuminate\Database\Eloquent\Model;
use App\Master;

class AporteLikeNoLike extends Master{
	
    protected $table = 'aportes_likes_no_likes';
    protected $class_name = 'AporteLikeNoLike';

    public function validate_save($atributos){
       
    }
}