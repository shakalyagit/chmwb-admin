<?php

namespace App\Providers;

use App\Models\ModuleManage;
use App\Models\ModulePermission;
use App\Models\UserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('user_role', function () {
            return UserRole::find(Auth::user()->user_role_id);
        });
    }

    /**
     * Bootstrap any application services.
     */


    // public function boot(): void {
    //     View::composer('*', function ($view) {
    //         if (Auth::check()) {
    //             $userId = Auth::id();

    //             $parentModules = ModuleManage::whereNull('parent_menu')
    //                 ->where('is_visible', 1)
    //                 ->orderBy('order_by')
    //                 ->get();

    //             foreach ($parentModules as $parent) {

    //                 $children = ModuleManage::join(
    //                         'module_permissions',
    //                         'module_permissions.module_id', '=', 'module_manages.id'
    //                     )
    //                     ->where('module_manages.parent_menu', $parent->id)
    //                     ->where('module_manages.is_visible', 1)
    //                     ->where('module_permissions.user_id', $userId)
    //                     ->orderBy('module_manages.order_by')
    //                     ->select('module_manages.*')
    //                     ->get();

    //                 $parent->children = $children;
    //             }

    //             $accessibleParents = $parentModules->filter(function ($parent) use ($userId) {
    //                 $hasSelf = ModuleManage::join(
    //                         'module_permissions',
    //                         'module_permissions.module_id', '=', 'module_manages.id'
    //                     )
    //                     ->whereNull('module_manages.parent_menu')
    //                     ->where('module_manages.id', $parent->id)
    //                     ->where('module_manages.is_visible', 1)
    //                     ->where('module_permissions.user_id', $userId)
    //                     ->exists();

    //                 return $hasSelf || $parent->children->count() > 0;
    //             });

    //             $view->with([
    //                 'menus' => $accessibleParents
    //             ]);
    //         }
    //     });
    // }


    public function boot(): void {
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $userId = Auth::id();

                // Get all visible parent menus (parent_menu is NULL)
                $parentModules = ModuleManage::whereNull('parent_menu')
                    ->where('is_visible', 1)
                    ->orderBy('order_by')
                    ->get();

                foreach ($parentModules as $parent) {
                    // Child menu e parent_menu er value hobe parent->name (not id)
                    $children = ModuleManage::join(
                            'module_permissions',
                            'module_permissions.module_id', '=', 'module_manages.id'
                        )
                        ->where('module_manages.parent_menu', $parent->name) // <- changed from $parent->id
                        ->where('module_manages.is_visible', 1)
                        ->where('module_permissions.user_id', $userId)
                        ->orderBy('module_manages.order_by')
                        ->select('module_manages.*')
                        ->get();

                    $parent->children = $children;
                }

                // Parent menu er access check, child thakle parent show hobe
                $accessibleParents = $parentModules->filter(function ($parent) use ($userId) {
                    $hasSelf = ModuleManage::join(
                            'module_permissions',
                            'module_permissions.module_id', '=', 'module_manages.id'
                        )
                        ->whereNull('module_manages.parent_menu')
                        ->where('module_manages.id', $parent->id)
                        ->where('module_manages.is_visible', 1)
                        ->where('module_permissions.user_id', $userId)
                        ->exists();

                    return $hasSelf || $parent->children->count() > 0;
                });

                $view->with([
                    'menus' => $accessibleParents
                ]);
            }
        });
    }



}
