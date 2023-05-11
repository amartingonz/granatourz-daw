<?php

namespace Controllers;
use Lib\Pages;
use Models\Reserva;
use Models\Actividad;
use Services\ReservaService;
use Utils\Utils;
use Services\ActividadService;


class ReservaController{
    private ReservaService $service;
    private Pages $pages;
    private Utils $utils;
    private ActividadService $servicep;

    public function __construct(){
        $this -> pages = new Pages();
        $this -> service = new ReservaService();
        $this -> utils = new Utils();
        $this -> servicep = new ActividadService();
    }


    // public function comprobarPedido(){
    //     // Funcion para comprobar que el usuario ha iniciado sesion.
    //     if(isset($_SESSION['usuario']) || isset($_SESSION['admin'])){
    //         if(count($_SESSION['carrito']) == 0){
    //             $this -> pages -> render('layout/mensaje',["mensaje" => "Debes tener productos para poder realizar el pedido"]);
    //         }else{
    //             $this -> pages -> render('pedidos/crear_pedido');
    //         }
    //     }else{
    //         $this -> pages -> render('layout/mensaje',["mensaje" => "Debes iniciar sesión para poder procesar tu pedido."]);
    //     }
    // }

    // public function enviar_email($email,$precio_total,$n_pedido,$datos,$productos){
    //     // Funcion que lleva al render de enviar email pasandole los parametros para rellenarlos con los datos que se piden
    //     $this -> pages -> render('principal/enviar_email',["email" => $email,"precio_total" => $precio_total, "n_pedido" => $n_pedido, "datos" => $datos, "productos" => $productos]);
    // }

//     public function consultar_pedidos(){
//         // Funcion que llama al servicio para consutar los pedidos de cada usuario pasandole la sesion del usuario actual, y con el render muestra la vista con los pedidos
//         $pedidos = $this -> service -> consultar_pedidos($_SESSION['id']);
//         $this -> pages -> render('pedidos/mis_pedidos',['pedidos' => $pedidos]);
//     }


    public function realizar_reserva(){
        // Funcion que crea el pedido, y la linea de pedido, además se envia el email si se ha introducido correctamente todo.
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $datos = $_POST['data'];
            
            $plazas = $this -> servicep -> obtenerCapacidad($_POST['data']['id_actividad']);
            if($plazas > 0 && $this -> service -> comprobar_reserva($datos)){
                $this -> service -> realizar_reserva($datos);
            }else{
                    $this -> pages -> render('layout/mensaje',["mensaje" => "No hay plazas disponibles."]);

            }



}
    }}



?>