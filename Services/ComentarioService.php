<?php 
    namespace Services;
    use Repositories\ComentarioRepository;

    class ComentarioService{
            private ComentarioRepository $repository;
        
            public function __construct(){
                $this->repository = new ComentarioRepository();
            }
        
            public function crear_comentario($data){
                // Función que llama al metodo del repositorio crear_comentario
                return $this -> repository -> crear_comentario($data);
            }

            public function eliminar_comentario($id_comentario){
                // Función que llama al metodo del repositorio eliminar_comentario
                return $this -> repository -> eliminar_comentario($id_comentario);
            }

            public function getAll(): ?array{
                return $this-> repository -> getAll();
            }
    }