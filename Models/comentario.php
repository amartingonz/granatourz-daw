<?php

namespace Models;

// CREAR LA CLASE COMENTARIO

class Comentario{

    function __construct(
        private int $id_comentario,
        private int $id_usuario,
        private int $id_actividad,
        private string $url,
        private string $fecha,
        private string $texto,


    )
    {}

        public static function fromArray(array $data):Comentario{
                return new Comentario(
                    $data['id_comentario'] ?? '',
                    $data['id_usuario'] ?? '',
                    $data['id_actividad'] ?? '',
                    $data['url'] ?? '',
                    $data['fecha'] ?? '',
                    $data['texto'] ?? '',
                );
            }

        /**
         * Get the value of id_comentario
         */ 
        public function getId_comentario()
        {
                return $this->id_comentario;
        }

        /**
         * Set the value of id_comentario
         *
         * @return  self
         */ 
        public function setId_comentario($id_comentario)
        {
                $this->id_comentario = $id_comentario;

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
         * Get the value of url
         */ 
        public function getUrl()
        {
                return $this->url;
        }

        /**
         * Set the value of url
         *
         * @return  self
         */ 
        public function setUrl($url)
        {
                $this->url = $url;

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
         * Get the value of texto
         */ 
        public function getTexto()
        {
                return $this->texto;
        }

        /**
         * Set the value of texto
         *
         * @return  self
         */ 
        public function setTexto($texto)
        {
                $this->texto = $texto;

                return $this;
        }
    }


?>