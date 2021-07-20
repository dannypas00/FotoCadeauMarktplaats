<?php


namespace App\Models;


use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class Model extends \Illuminate\Database\Eloquent\Model
{
    /**
     * @var int|null $created_by User id of the last user that updated this model
     */
    public $created_by;

    public static function boot() {
        parent::boot();
        // Set the model's created_by entry to the creating user's id, or null if no user is authenticated
        static::creating(function (Model $model) {
            $user = Auth::user();
            $model->created_by = $user->id ?? null;
        });
    }
}