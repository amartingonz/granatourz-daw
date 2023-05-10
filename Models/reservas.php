<?php

namespace Models;

// CREAR LA CLASE RESERVA

class Reserva{

    function __construct(
        private int $id_reserva,
        private string $id_usuario,
        private string $id_actividad,
        private string $fecha_reserva,
    )
    {}

        public static function fromArray(array $data):Reserva{
                return new Reserva(
                    $data['id_reserva'] ?? '',
                    $data['id_usuario'] ?? '',
                    $data['id_actividad'] ?? '',
                    $data['fecha_reserva'] ?? '',
                );
            }
    }


?>