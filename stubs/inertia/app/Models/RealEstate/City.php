<?php


use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = "cities";
    protected $fillable = ["name", "value", "posicao"];
}
