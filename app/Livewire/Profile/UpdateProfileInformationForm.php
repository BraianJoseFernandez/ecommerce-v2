<?php

namespace App\Livewire\Profile;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Laravel\Jetstream\Http\Livewire\UpdateProfileInformationForm as JetstreamUpdateProfileInformationForm;

class UpdateProfileInformationForm extends JetstreamUpdateProfileInformationForm
{
    /**
     * Update the user's profile information.
     *
     * @param  \Laravel\Fortify\Contracts\UpdatesUserProfileInformation  $updater
     * @return void
     */
    public function updateProfileInformation(UpdatesUserProfileInformation $updater)
    {
        $this->resetErrorBag();

        $updater->update(
            Auth::user(),
            $this->photo
                ? array_merge($this->state, ['photo' => $this->photo])
                : $this->state
        );

        // Limpiar la foto temporal después de guardar
        if (isset($this->photo)) {
            $this->photo = null;
        }

        $this->dispatch('saved');
        $this->dispatch('refresh-navigation-menu');
    }

    /**
     * Obtener la propiedad del usuario.
     * Se ejecuta cada vez que se accede a $this->user en la vista,
     * asegurando que siempre devuelva el usuario actualizado.
     *
     * @return mixed
     */
    public function getUserProperty()
    {
        return Auth::user();
    }
}

