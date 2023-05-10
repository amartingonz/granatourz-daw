<?php

namespace Models;


class Actividad{

    function __construct(
        private int $id_actividad,
        private string $id_categoria,
        private string $id_usuario,
        private string $nombre,
        private string $duracion,
        private string $descripcion,
        private string $localizacion,
        private string $hora,
        private string $fecha,
        private string $capacidad,
        private string $url,
    )
    {}

        public static function fromArray(array $data):Actividad{
                return new Actividad(
                    $data['id_actividad'] ?? '',
                    $data['id_categoria'] ?? '',
                    $data['id_usuario'] ?? '',
                    $data['nombre'] ?? '',
                    $data['duracion'] ?? '',
                    $data['nombre'] ?? '',
                    $data['descripcion'] ?? '',
                    $data['localizacion'] ?? '',
                    $data['hora'] ?? '',
                    $data['fecha'] ?? '',
                    $data['capacidad'] ?? '',
                    $data['url'] ?? '',
                );
            }

            // public function getAll(): ?array{
            //     // DEVUELVE UN ARRAY DE PRODUCTOS
            //     $productos = [];
            //     $productos_datos = $this -> conexion -> extraer_todos();
            //     foreach($productos_datos as $datos){
            //         $productos[] = Productos::fromArray($datos);
            //     }
            //     return $productos;
            // }

       







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
         * Get the value of id_categoria
         */ 
        public function getId_categoria()
        {
                return $this->id_categoria;
        }

        /**
         * Set the value of id_categoria
         *
         * @return  self
         */ 
        public function setId_categoria($id_categoria)
        {
                $this->id_categoria = $id_categoria;

                return $this;
        }

        /**
         * Get the value of nombre
         */ 
        public function getNombre()
        {
                return $this->nombre;
        }

        /**
         * Set the value of nombre
         *
         * @return  self
         */ 
        public function setNombre($nombre)
        {
                $this->nombre = $nombre;

                return $this;
        }

        /**
         * Get the value of duracion
         */ 
        public function getDuracion()
        {
                return $this->duracion;
        }

        /**
         * Set the value of duracion
         *
         * @return  self
         */ 
        public function setDuracion($duracion)
        {
                $this->duracion = $duracion;

                return $this;
        }



        /**
         * Get the value of descripcion
         */ 
        public function getDescripcion()
        {
                return $this->descripcion;
        }

        /**
         * Set the value of descripcion
         *
         * @return  self
         */ 
        public function setDescripcion($descripcion)
        {
                $this->descripcion = $descripcion;

                return $this;
        }

        /**
         * Get the value of localizacion
         */ 
        public function getLocalizacion()
        {
                return $this->localizacion;
        }

        /**
         * Set the value of localizacion
         *
         * @return  self
         */ 
        public function setLocalizacion($localizacion)
        {
                $this->localizacion = $localizacion;

                return $this;
        }

      

        /**
         * Get the value of hora
         */ 
        public function getHora()
        {
                return $this->hora;
        }

        /**
         * Set the value of hora
         *
         * @return  self
         */ 
        public function setHora($hora)
        {
                $this->hora = $hora;

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
         * Get the value of capacidad
         */ 
        public function getCapacidad()
        {
                return $this->capacidad;
        }

        /**
         * Set the value of capacidad
         *
         * @return  self
         */ 
        public function setCapacidad($capacidad)
        {
                $this->capacidad = $capacidad;

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
}
?>