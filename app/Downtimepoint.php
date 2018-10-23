<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Downtimepoint extends Model
{
    protected $guarded = ['id'];

    public function downtime(){
        return $this->belongsTo('App\Downtime');
    }

    public function getWordcountAttribute(){
        return str_word_count($this->text);
    }

    public function getResponseWordcountAttribute(){
        return str_word_count($this->response);
    }
}
