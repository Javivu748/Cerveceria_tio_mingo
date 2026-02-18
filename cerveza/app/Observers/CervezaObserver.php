<?php

namespace App\Observers;

use App\Models\Cerveza;
use App\Services\TelegramService;

class CervezaObserver
{
    protected $telegram;

    // Inyectamos el servicio de Telegram
    public function __construct(TelegramService $telegram)
    {
        $this->telegram = $telegram;
    }

    // Se ejecuta cuando se crea una nueva cerveza
    public function created(Cerveza $cerveza)
    {
        // Notificamos al admin de la nueva cerveza
        $this->telegram->notifyNewBeer($cerveza);
    }

    // Se ejecuta cuando se actualiza una cerveza
    public function updated(Cerveza $cerveza)
    {
        // Aquí guardamos los cambios detectados
        $cambios = [];

        // Campos que queremos vigilar
        $campos = [
            'name'       => 'Nombre',
            'precio_eur' => 'Precio',
            'formato'    => 'Formato',
            'capacidad'  => 'Capacidad',
        ];

        // Recorremos cada campo para ver si cambió
        foreach ($campos as $campo => $etiqueta) {
            if ($cerveza->isDirty($campo)) {
                $antes   = $cerveza->getOriginal($campo);
                $despues = $cerveza->$campo;

                // Formateamos el precio si corresponde
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

        // Si el precio bajó, notificamos oferta a todos los usuarios
        if ($cerveza->isDirty('precio_eur')) {
            $precioAnterior = $cerveza->getOriginal('precio_eur');
            $precioNuevo    = $cerveza->precio_eur;

            if ($precioNuevo < $precioAnterior) {
                $this->telegram->notifyAllUsersOffer($cerveza, $precioAnterior);
            }
        }
    }

    // Se ejecuta cuando se elimina una cerveza
    public function deleted(Cerveza $cerveza)
    {
        // Notificamos al admin de la eliminación
        $this->telegram->notifyBeerDeleted($cerveza);
    }
}
