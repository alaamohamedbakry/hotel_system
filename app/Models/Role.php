<?php
namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public static function createWithPermissions(Request $request)
    {
        DB::beginTransaction();
        try {
            $role = self::create(['name' => $request->post('name')]);

            foreach ($request->post('premissions', []) as $premission => $value) {
                RolePremission::create([
                    'role_id' => $role->id,
                    'premission' => $premission,
                    'type' => $value
                ]);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return $role;
    }

    public function updateWithPermissions(Request $request)
    {
        DB::beginTransaction();
        try {
            $this->update(['name' => $request->post('name')]);

            foreach ($request->post('premissions', []) as $premission => $value) {
                RolePremission::updateOrCreate(
                    ['role_id' => $this->id, 'premission' => $premission],
                    ['type' => $value]
                );
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return $this;
    }



    public function permissions()
    {
        return $this->hasMany(RolePremission::class, 'role_id', 'id');
    }

}
