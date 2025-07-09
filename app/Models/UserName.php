<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserName extends Model
{
    protected $fillable = ['name', 'address'];

    public static function findById($id)
    {
        return self::find($id);
    }

    public static function findWithFallback($id)
    {
        return self::find($id) ?? null;
    }

    public static function searchByName($name)
    {
        return self::where('name', 'like', '%' . $name . '%')->get();
    }

    public static function hasAddress()
    {
        return self::whereNotNull('address')->get();
    }
}
