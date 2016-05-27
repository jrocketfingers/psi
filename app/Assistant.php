<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assistant extends Model
{
    protected $fillable = [
        'id',
    ];

    public static function isAssistant($id) {
        $assistant = Assistant::find($id);
        if($assistant) {
            return true;
        } else {
            return false;
        }
    }
}
