<?php

namespace App\Livewire;

use App\Models\ModuleManage;
use App\Models\ModulePermission;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserModule extends Component
{

    public $name;
    public $email;
    public $number;
    public $email_verified_at;
    public $password;
    public $shop_id = null;
    public $ref_id;
    public $status = 'Active';
    public $mode = 'list';
    public $module_access = [];

    public $users;
    public $user_id;
    public $role_id = null;
    public $roles;
    public $module_manage;

    public function mount(){
        if (Auth::user()->user_role_id != 1) {
            $this->role_id = 3;
        }

        if (Auth::user()->user_role_id == 2) {
            $this->shop_id = Auth::user()->id;
        }
    }

    public function create(){
        $this->resetForm();
        $this->roles = UserRole::all();
        $this->module_manage = ModuleManage::where('is_visible', 1)->get();
        $this->mode = 'create';
    }

    public function render(){
        if (Auth::user()->user_role_id == 1) {
            $this->users = User::with('role')->orderBy('id', 'DESC')->get();
        }else{
            $this->users = User::where('shop_id', Auth::user()->id)->with('role')->orderBy('id', 'DESC')->get();
        }

        return view('livewire.user-module');
    }

    public function resetForm(){
        $this->user_id = '';
        $this->name = '';
        $this->email = '';
        $this->number = '';
        $this->password = '';
        $this->role_id = '';
        $this->status = 'Active';
    }


    public function store() {
        $this->validate([
            'name'       => 'required|string|min:2',
            'number'     => 'required|string|min:10|max:15|unique:users,number,'.($this->user_id ?? 'NULL'),
            'email'      => 'required|email|unique:users,email,' . ($this->user_id ?? 'NULL'),
            'status'     => 'required|in:Active,Inactive',
            'password'   => $this->user_id ? 'nullable|string|min:6' : 'required|string|min:6',
        ]);

        if ($this->role_id === '' || $this->role_id === null) {
            $this->role_id = Auth::user()->user_role_id == 1 ? null : 3;
        }

        if ($this->user_id) {
            $user = User::findOrFail($this->user_id);
            $user->update([
                'name'          => $this->name,
                'email'         => $this->email,
                'number'        => $this->number,
                'shop_id'       => $this->shop_id,
                'user_role_id'  => $this->role_id,
                'status'        => $this->status,
                'password'      => $this->password ? Hash::make($this->password) : $user->password,
            ]);
            $message = 'User updated successfully.';
        } else {
            $user = User::create([
                'name'          => $this->name,
                'email'         => $this->email,
                'user_role_id'  => $this->role_id,
                'shop_id'       => $this->shop_id,
                'number'        => $this->number,
                'status'        => $this->status,
                'password'      => Hash::make($this->password),
            ]);

            if ($user->user_role_id == 2) {
                $user->update([
                    'shop_id'       => $user->id,
                ]);
            }

            $message = 'User created successfully.';
        }
        if ($this->user_id) {
            DB::table('module_permissions')->where('user_id', $user->id)->delete();
        }
        foreach ($this->module_access as $module_id) {
            DB::table('module_permissions')->insert([
                'user_id'   => $user->id,
                'module_id' => $module_id,
            ]);
        }

        $this->resetForm();
        $this->mode = 'list';
        session()->flash('success', $message);
        return redirect()->route('users');
    }

    public function edit($id){
         $this->roles = UserRole::all();
        $this->module_manage = ModuleManage::where('is_visible', 1)->get();
        $user = User::findOrFail($id);
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->number = $user->number;
        $this->role_id = $user->user_role_id;
        $this->status = $user->status;
        $this->module_access = DB::table('module_permissions')
            ->where('user_id', $user->id)
            ->pluck('module_id')
            ->toArray();
        $this->mode = 'edit';
    }


}
