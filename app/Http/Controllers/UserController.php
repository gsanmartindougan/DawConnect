<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Notifications\Notifiable;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    use Notifiable;
    public function password(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $antigua = $request->antigua;
        $nueva1 = $request->nueva1;
        $nueva2 = $request->nueva2;
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

    public function avatar(Request $request)
    {
        //dd($request->avatar);
        $request->validate([
            'avatar' => 'required|file|max:2048',
        ], [
            'avatar.required' => 'Recuerda elegir un archivo.',
            'avatar.file' => 'El archivo debe ser un archivo válido.',
            'avatar.max' => 'El tamaño del archivo no debe exceder los 2MB.',
        ]);
        $image_name = auth()->user()->name . auth()->user()->id . '.png';
        $path = $request->avatar->storePubliclyAs('avatar', $image_name, 'public');
        $user = User::find(auth()->user()->id);
        $user->avatar = $path;
        $user->save();
        return response()->json([
            'success' => true,
            'mensaje' => '¡Avatar cambiado correctamente!',
        ]);
    }

    public function ban(Request $request)
    {
        $user = User::find($request->id);
        $user->ban = 1;
        $user->save();
        return response()->json([
            'success' => true,
            'mensaje' => '¡Usuario suspendido correctamente!',
        ]);
    }

    public function unban(Request $request)
    {
        $user = User::find($request->id);
        $user->ban = 0;
        $user->save();
        return response()->json([
            'success' => true,
            'mensaje' => '¡Usuario restaurado correctamente!',
        ]);
    }
}
