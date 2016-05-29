<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assistant extends Model
{
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'user_id',
    ];

    public static function isAssistant($id) {
        $assistant = Assistant::find($id);
        if($assistant) {
            return true;
        } else {
            return false;
        }
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
