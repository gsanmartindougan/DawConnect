<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;
use App\Models\Posts;
use App\Models\Aviso;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $unreadNotifications = $user->unreadNotifications()->take(10)->get();
        $cuenta = $user->unreadNotifications()->get();
        $cuenta = $cuenta->count();
        $updatedNotificationsHtml = '<div class="p-1">';
        foreach ($unreadNotifications as $notification) {
            if(isset($notification->data['post_id'])){
                $updatedNotificationsHtml .= '<a href="' . route('mark-as-read-show', ['post_id' => $notification->data['post_id'], 'not_id' => $notification->id])  . '" class="dropdown-item d-flex align-items-center py-2">';
                $updatedNotificationsHtml .= '<div class="wd-30 ht-30 d-flex align-items-center justify-content-center me-3 icono_comentario"></div>';
                $updatedNotificationsHtml .= '<div class="flex-grow-1 me-2">';
                $updatedNotificationsHtml .= '<span class="text-justify">' . ($notification->data['autor'] ?? 'sin autor') . ' ha escrito un nuevo comentario.</span><br>';
                $updatedNotificationsHtml .= '<span class="tx-12 text-muted">' . ($notification->data['post'] ?? 'sin título') . '</span><br>';
            }
            if(isset($notification->data['aviso_id'])){
                $updatedNotificationsHtml .= '<a href="' . route('mark-as-read-show-aviso', ['aviso_id' => $notification->data['aviso_id'], 'not_id' => $notification->id])  . '" class="dropdown-item d-flex align-items-center py-2">';
                $updatedNotificationsHtml .= '<div class="wd-30 ht-30 d-flex align-items-center justify-content-center me-3 icono_aviso"></div>';
                $updatedNotificationsHtml .= '<div class="flex-grow-1 me-2">';
                $updatedNotificationsHtml .= '<span class="text-justify">' . ($notification->data['autor'] ?? 'sin autor') . ' ha creado un nuevo aviso.</span><br>';
                $updatedNotificationsHtml .= '<span class="tx-12 text-muted">' . ($notification->data['aviso'] ?? 'sin título') . '</span><br>';
            }


            $created_at = \Carbon\Carbon::parse($notification->created_at);
            $minutes_difference = $created_at->diffForHumans();
            $updatedNotificationsHtml .= '<span class="tx-12 text-muted">' . $minutes_difference . '</span>';

            $updatedNotificationsHtml .= '</div>';

            $updatedNotificationsHtml .= '</a>';
        }
        $updatedNotificationsHtml .= '</div>';
        if($unreadNotifications->count() == 0){
            $updatedNotificationsHtml = '<p class="text-center">Nada nuevo</p>';
        }

        return response()->json([
            'unreadNotifications' => $updatedNotificationsHtml,
            'cuenta' => $cuenta,
        ]);
    }

    public function markAsReadAll(){
        $user = auth()->user();
        if($user) {
            $notificaciones = $user->unreadNotifications;
            foreach($notificaciones as $notificacion){
                $notificacion->markAsRead();
            }
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function markAsReadShow($post_id, $not_id){
        $user = auth()->user();
        $notificacion = $user->notifications()->where('id', $not_id)->first();

        if($notificacion){
            $notificacion->markAsRead();
            $post = Posts::with('user')->find($post_id);
            $comments = Comment::where('post_id', $post_id)->paginate(5);
            return view('pages.post.show', compact('post', 'comments'));
        }else{
            return redirect()->back();
        }
    }

    public function markAsReadShowAviso($aviso_id, $not_id){
        $user = auth()->user();
        $notificacion = $user->notifications()->where('id', $not_id)->first();

        if($notificacion){
            $notificacion->markAsRead();
            $aviso = Aviso::with('user')->find($aviso_id);
            return view('pages.avisos.show', compact('aviso'));
        }else{
            return redirect()->back();
        }
    }
}
