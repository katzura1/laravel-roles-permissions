<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $filable = ['name', 'slug', 'type', 'id_parent', 'visible'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'visible' => 'boolean',
        'created_at' => 'datetime',
        'update_at' => 'datetime',
    ];

    public function child()
    {
        return $this->hasMany(Menu::class, 'id_parent', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'id_parent', 'id');
    }
}
