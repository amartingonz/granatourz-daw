<?php 
    namespace Services;
    use Repositories\ReservaRepository;

    class ReservaService{
            private ReservaRepository $repository;
        
            public function __construct(){
                $this->repository = new ReservaRepository();
            }

            public function comprobar_reserva($data){
                $this -> repository -> comprobar_reserva($data);
            }

            public function realizar_reserva(array $data){
                //funcion que llama al metodo del repositorio realizar_reserva
                $this -> repository -> realizar_reserva($data);
            }
        
            public function ultimoPedidoInsertado(){
                // funcion que llama al metodo del repositorio ultimopedidoinsertado devuelve el id del ultimo pedido
                return $this -> repository -> ultimoPedidoInsertado();
            }
           
            public function consultar_pedidos($id):?array{
                // funcion que llama al metodo del repositorio consultar_pedidos
                return $this -> repository -> consultar_pedidos($id);
            }
        }
    