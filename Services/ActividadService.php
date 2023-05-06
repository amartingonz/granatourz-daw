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

            public function borrar_actividad($id):void{
                // Funcion para borrar productos que usa el metodo del repositorio borrar_productos
                $this -> repository -> borrar_Actividad($id) ;
            }
        }
?>