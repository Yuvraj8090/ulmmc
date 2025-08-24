<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NavbarItem extends Model
{
    protected $fillable = [
        'title',
        'title_hi',
        'slug',
        'parent_id',
        'is_dropdown',
        'order',
        'is_active',
        'route',
        'url',
        'icon',
         'is_footer', 
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(NavbarItem::class, 'parent_id');
    }
    // app/Models/NavbarItem.php



    public function children()
    {
        return $this->hasMany(NavbarItem::class, 'parent_id')->where('is_active', true)->orderBy('order');
    }

    public function getLinkAttribute(): string
    {
        return $this->route ? route($this->route) : ($this->url ?? '#');
    }
    public function roles()
{
    return $this->belongsToMany(Role::class);
}

}