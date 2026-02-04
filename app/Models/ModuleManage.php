<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleManage extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'parent_menu', 'route_name', 'icon_class', 'is_visible', 'order_by'];

    public function children()
    {
        return $this->hasMany(ModuleManage::class, 'parent_menu', 'name')
                    ->where('is_visible', 1)
                    ->orderBy('order_by');
    }
    public function childrenWithPermission($permissionModuleIds)
    {
        return $this->hasMany(ModuleManage::class, 'parent_menu', 'name')
                    ->whereIn('id', $permissionModuleIds)
                    ->where('is_visible', 1)
                    ->orderBy('order_by');
    }
}
