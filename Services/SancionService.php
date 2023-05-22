<?php 
    namespace Services;
    use Repositories\SancionRepository;

    class SancionService{
            private SancionRepository $repository;
        
            public function __construct(){
                $this->repository = new SancionRepository();
            }

            public function proponer_sancion($data) {
                return $this -> repository -> proponer_sancion($data);
            }

            public function getAll(): ?array{
                return $this-> repository -> getAll();
            }
            public function confirmar_sancion($data) {
                return $this -> repository -> confirmar_sancion($data);
            }
    }