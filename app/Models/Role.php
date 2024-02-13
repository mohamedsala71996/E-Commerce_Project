<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
    use HasFactory;


    protected $fillable = ['name'];


   public function roleAbility() 
    {
        return $this->hasMany(RoleAbility::class);
    }

    public static function createWithAbilities(Request $request)
    {
        DB::beginTransaction();
        try {
        $role = static::create([
            'name' =>$request->name,
        ]);

        foreach ($request->abilities as $ability => $type) {
            $role->roleAbility()->create([
                'ability' => $ability,
                'type' => $type,
            ]);
        }
        DB::commit();
            
    } catch (\Exception $e) {
        DB::rollBack();
        throw $e;
    }
        return $role;
    }
    public function updateWithAbilities(Request $request, Role $role)
    {
        DB::beginTransaction();
        try {
        $role->update([
            'name' => $request->name,
        ]);

        foreach ($request->abilities as $key => $value) {
            $role->roleAbility()->updateOrCreate([
                'role_id' => $role->id,
                'ability' => $key,
            ], [

                'type' => $value,
            ]);
        }
        DB::commit();
            
    } catch (\Exception $e) {
        DB::rollBack();
        throw $e;
    }
    }



    
}
