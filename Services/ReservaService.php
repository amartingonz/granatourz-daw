<?php 
    namespace Services;
    use Repositories\ReservaRepository;

    class ReservaService{
            private ReservaRepository $repository;
        
            public function __construct(){
                $this->repository = new ReservaRepository();
            }

            public function comprobar_fecha_reserva($data){
                return $this -> repository -> comprobar_fecha_reserva($data);
            }

            public function comprobar_reserva($id_usuario,$id_actividad,$fecha_reserva){
                return $this -> repository -> comprobar_reserva($id_usuario,$id_actividad,$fecha_reserva);
            }

            public function realizar_reserva(array $data){
                //funcion que llama al metodo del repositorio realizar_reserva
                $this -> repository -> realizar_reserva($data);
            }
        
            public function cancelar_reserva(array $data){
                // Función que llama al metodo del repositorio para cancelar la reserva
                $this -> repository -> cancelar_reserva($data);
            }

            public function ultimoPedidoInsertado(){
                // funcion que llama al metodo del repositorio ultimopedidoinsertado devuelve el id del ultimo pedido
                return $this -> repository -> ultimoPedidoInsertado();
            }
           
            public function consultar_reservas($id):?array{
                // funcion que llama al metodo del repositorio consultar_pedidos
                return $this -> repository -> obtener_reservas_usuario_conectado($id);
            }

            public function sacarListadoAsistentes($id_actividad){
                //Funcion para llamar al metodo del repositorio sacarListadoAsistentes
                return $this -> repository -> sacarListadoAsistentes($id_actividad);
            }

            public function comprobarReservas($id_actividad){
                // Función para llamar al metodo del repositorio comprobarReservas
                return $this -> repository -> comprobarReservas($id_actividad);
            }
    }