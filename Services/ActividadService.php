<?php 
    namespace Services;
    use Repositories\ActividadRepository;

    class ActividadService{
            private ActividadRepository $repository;
        
            public function __construct(){
                $this->repository = new ActividadRepository();
            }
        
            public function crear_actividad(array $data):void {
                // Funcion para crear actividad que usa el metodo del repositorio crear_actividad, se le pasa un array de datos
                $this -> repository -> crear_actividad($data);
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
                // Funcion para listar actividades que usa el metodo del repositorio listarXcategorias, devuelve un array
                return $this -> repository -> listarXcategorias($data);

            }

            public function ver_carrito($cod):?array{
                
                return $this -> repository -> buscarActividad($cod);
            }

            public function sacarNombre($id):?array{
                return $this -> repository -> sacarNombre($id);
            }

            public function comprobarNombreActividad($nombre){
                return $this -> repository -> comprobarNombreActividad($nombre);
            }
            public function obtenerCapacidad($id){
                return $this -> repository -> obtenerCapacidad($id);
            }
            public function borrar_actividad($id):void{
                // Funcion para actualizar las actividades es decir las oculta poniendo la capacidad a 0.
                $this -> repository -> borrar_Actividad($id) ;
            }
        }
?>