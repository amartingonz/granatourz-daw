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


    
    // public function enviar_email($email,$precio_total,$n_pedido,$datos,$productos){
    //     // Funcion que lleva al render de enviar email pasandole los parametros para rellenarlos con los datos que se piden
    //     $this -> pages -> render('principal/enviar_email',["email" => $email,"precio_total" => $precio_total, "n_pedido" => $n_pedido, "datos" => $datos, "productos" => $productos]);
    // }

    public function consultar_reservas(){
        // Funcion que llama al servicio para consutar las actividades de cada usuario pasandole la sesion del usuario actual, y con el render muestra la vista con las actividades
        if (isset($_SESSION['id'])) {
            $reservas = $this->service->consultar_reservas($_SESSION['id']);
            $this -> pages -> render('reservas/mis_reservas',['reservas' => $reservas]);
        }else{
            $this -> pages -> render('layout/mensaje',["mensaje" => "No hay actividades reservadas."]);
        }
    }


    public function realizar_reserva(){
        // Funcion que realiza la reserva, comprueba si hay plazas disponibles y si no tienes otra actividad el mismo dia.
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $datos = $_POST['data'];
            $plazas = $this -> servicep -> obtenerCapacidad($_POST['data']['id_actividad']);
        
            $id_usuario = $datos['id_usuario'];
            $id_actividad = $datos['id_actividad'];
            $fecha_reserva = $this -> service -> comprobar_fecha_reserva($datos);
            
            if($plazas > 0 && !$this -> service -> comprobar_reserva($id_usuario,$id_actividad,$fecha_reserva)){
                $this -> service -> realizar_reserva($datos);
            }else{
                $this -> pages -> render('layout/mensaje',["mensaje" => "No hay plazas disponibles."]);

            }}
    }
}



?>