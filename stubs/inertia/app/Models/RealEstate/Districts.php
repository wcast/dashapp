<?php


use Illuminate\Database\Eloquent\Model;

class Districts extends Model
{
    protected $table = "districts";
    protected $fillable = ["name", "value", "posicao","cidade"];
}
