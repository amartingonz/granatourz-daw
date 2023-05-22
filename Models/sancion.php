<?php

namespace Models;

// CREAR LA CLASE SANCIÓN

class Sancion{

    function __construct(
        private int $id_sancion,
        private string $id_usuario,
        private string $id_actividad,
        private string $motivo,
        private string $fecha,
        private int $estado,
    )
    {}

        public static function fromArray(array $data):Sancion{
                return new Sancion(
                    $data['id_sancion'] ?? '',
                    $data['id_usuario'] ?? '',
                    $data['id_actividad'] ?? '',
                    $data['motivo'] ?? '',
                    $data['fecha'] ?? '',
                    $data['estado'] ?? '',
                );
            }

        /**
         * Get the value of id_sancion
         */ 
        public function getId_sancion()
        {
                return $this->id_sancion;
        }

        /**
         * Set the value of id_sancion
         *
         * @return  self
         */ 
        public function setId_sancion($id_sancion)
        {
                $this->id_sancion = $id_sancion;

                return $this;
        }

     


        /**
         * Get the value of id_usuario
         */ 
        public function getId_usuario()
        {
                return $this->id_usuario;
        }

        /**
         * Set the value of id_usuario
         *
         * @return  self
         */ 
        public function setId_usuario($id_usuario)
        {
                $this->id_usuario = $id_usuario;

                return $this;
        }

        /**
         * Get the value of id_actividad
         */ 
        public function getId_actividad()
        {
                return $this->id_actividad;
        }

        /**
         * Set the value of id_actividad
         *
         * @return  self
         */ 
        public function setId_actividad($id_actividad)
        {
                $this->id_actividad = $id_actividad;

                return $this;
        }

        /**
         * Get the value of motivo
         */ 
        public function getMotivo()
        {
                return $this->motivo;
        }

        /**
         * Set the value of motivo
         *
         * @return  self
         */ 
        public function setMotivo($motivo)
        {
                $this->motivo = $motivo;

                return $this;
        }

        /**
         * Get the value of fecha
         */ 
        public function getFecha()
        {
                return $this->fecha;
        }

        /**
         * Set the value of fecha
         *
         * @return  self
         */ 
        public function setFecha($fecha)
        {
                $this->fecha = $fecha;

                return $this;
        }

        /**
         * Get the value of estado
         */ 
        public function getEstado()
        {
                return $this->estado;
        }

        /**
         * Set the value of estado
         *
         * @return  self
         */ 
        public function setEstado($estado)
        {
                $this->estado = $estado;

                return $this;
        }
}


?>