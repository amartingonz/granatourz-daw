<?php 
    namespace Services;
    use Repositories\ActividadRepository;

    class ActividadService{
            private ActividadRepository $repository;
        
            public function __construct(){
                $this->repository = new ActividadRepository();
            }
        
            public function crear_actividad(array $data):void {
                // Función para crear actividad que usa el metodo del repositorio crear_actividad, se le pasa un array de datos
                $this -> repository -> crear_actividad($data);
            }

            public function ver_actividad($id_actividad){
                // Función que llama al metodo del repositorio ver_actividad
                return $this -> repository -> ver_actividad($id_actividad);
            }
            
            public function sacarListadoActividades($id_usuario){
                // Función que llama al metodo del repositorio sacarListadoActividades
                return $this -> repository -> sacarListadoActividades($id_usuario);
            }

            public function getAll(): ?array{
                return $this-> repository -> getAll();
            }

            public function editar_actividad(array $data):void{
                // Funcion para editar actividad que usa el metodo del repositorio editar_actividad
                $this -> repository -> editar_actividad($data);
            }

            public function editarActividad(array $data):void{
                // Funcion para editar la actividad que usa el metodo del repositorio editarActividad (version 2 con 3 vistas)
                $this -> repository -> editarActividad($data);
            }

            public function comprobarActividad(string $actividad){
                //Funcion para llamar al metodo del repositorio para saber si existe la actividad en la Base de Datos
                return $this -> repository -> comprobarActividad($actividad);
            }

            public function listarXcategorias($data):? array{
                // Función para listar actividades que usa el metodo del repositorio listarXcategorias, devuelve un array
                return $this -> repository -> listarXcategorias($data);

            }

            public function sacarNombre($id):?array{
                // Función para llamar al metodo del repositorio sacarNombre
                return $this -> repository -> sacarNombre($id);
            }

            public function comprobarNombreActividad($nombre){
                // Función para comprobar el nombre de la actividad
                return $this -> repository -> comprobarNombreActividad($nombre);
            }
            
            public function obtenerCapacidad($id){
                // Función que llama al metodo del repositorio obtenerCapacidad
                return $this -> repository -> obtenerCapacidad($id);
            }
            public function borrar_actividad($id):void{
                // Funcion para actualizar las actividades es decir las oculta poniendo la capacidad a 0.
                $this -> repository -> borrar_Actividad($id) ;
            }
        }
?>