<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ProfilePhotoController extends Controller
{
    /**
     * Mostrar la foto de perfil del usuario.
     *
     * @param  User  $user
     * @return StreamedResponse
     */
    public function show(User $user)
    {
        if (!$user->profile_photo_path) {
            abort(404, 'Foto de perfil no encontrada');
        }

        $file = storage_path('app/public/' . $user->profile_photo_path);

        if (!file_exists($file)) {
            abort(404, 'Foto de perfil no encontrada');
        }

        return response()->file($file, [
            'Content-Type' => mime_content_type($file),
            'Cache-Control' => 'no-cache, no-store, must-revalidate, public',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ]);
    }
}
