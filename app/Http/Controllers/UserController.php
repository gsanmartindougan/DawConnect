<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\User;

class UserController extends Controller
{
    //
    public function password(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $antigua = $request->antigua;
        $nueva1 = $request->nueva1;
        $nueva2 = $request->nueva2;
/*         $contrasenas = [
            $antigua,
            $user->password,
            $nueva1,
            $nueva2
        ];*/
        //dd($request);
        if (Hash::check($antigua, auth()->user()->password) && ($nueva1 == $nueva2)) {
            $user->password = Hash::make($nueva1);
            $user->save();
            return response()->json([
                'success' => true,
                'mensaje' => '¡Contraseña cambiada correctamente!',
            ]);
        }else{
            return response()->json([
                'success' => false,
                'mensaje_error' => '¡Algo ha salido mal!',
            ]);
        }
    }
}
