<?php

namespace App\Observers;

use App\Models\Cerveza;
use App\Services\TelegramService;

class CervezaObserver
{
    protected $telegram;

    public function __construct(TelegramService $telegram)
    {
        $this->telegram = $telegram;
    }

    /**
     * Cuando se CREA una cerveza nueva → notifica al admin
     */
    public function created(Cerveza $cerveza)
    {
        $this->telegram->notifyNewBeer($cerveza);
    }

    /**
     * Cuando se EDITA una cerveza → notifica al admin con los cambios
     */
    public function updated(Cerveza $cerveza)
    {
        $cambios = [];

        // Campos que vigilamos
        $campos = [
            'name'       => 'Nombre',
            'precio_eur' => 'Precio',
            'formato'    => 'Formato',
            'capacidad'  => 'Capacidad',
        ];

        foreach ($campos as $campo => $etiqueta) {
            if ($cerveza->isDirty($campo)) {
                $antes   = $cerveza->getOriginal($campo);
                $despues = $cerveza->$campo;

                $cambios[$etiqueta] = [
                    'antes'   => $campo === 'precio_eur'
                                    ? '€' . number_format($antes, 2)
                                    : $antes,
                    'despues' => $campo === 'precio_eur'
                                    ? '€' . number_format($despues, 2)
                                    : $despues,
                ];
            }
        }

        // Notificar al admin si hubo cambios
        if (!empty($cambios)) {
            $this->telegram->notifyBeerEdited($cerveza, $cambios);
        }

        // Si el precio BAJÓ → notificar oferta a todos los usuarios suscritos
        if ($cerveza->isDirty('precio_eur')) {
            $precioAnterior = $cerveza->getOriginal('precio_eur');
            $precioNuevo    = $cerveza->precio_eur;

            if ($precioNuevo < $precioAnterior) {
                $this->telegram->notifyAllUsersOffer($cerveza, $precioAnterior);
            }
        }
    }

    /**
     * Cuando se ELIMINA una cerveza → notifica al admin
     */
    public function deleted(Cerveza $cerveza)
    {
        $this->telegram->notifyBeerDeleted($cerveza);
    }
}