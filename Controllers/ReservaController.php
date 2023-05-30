<?php

namespace Controllers;
use Lib\Pages;
use Models\Reserva;
use Models\Actividad;
use Services\ReservaService;
use Services\ActividadService;


class ReservaController{
    private ReservaService $service;
    private Pages $pages;
    private ActividadService $servicep;

    public function __construct(){
        $this -> pages = new Pages();
        $this -> service = new ReservaService();
        $this -> servicep = new ActividadService();
    }


    public function consultar_reservas(){
        // Función que llama al servicio para consultar las actividades de cada usuario pasándole la sesión del usuario actual,
        // y con el render muestra la vista con las actividades
        if (isset($_SESSION['id'])) {
            $reservas = $this->service->consultar_reservas($_SESSION['id']);
    
            if (empty($reservas)) {
                $this->pages->render('layout/mensaje', ["mensaje" => "No hay actividades reservadas."]);
            } else {
                $this->pages->render('reservas/mis_reservas', ['reservas' => $reservas]);
            }
        } else {
            $this->pages->render('layout/mensaje', ["mensaje" => "No hay actividades reservadas."]);
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
                $this -> pages -> render('layout/mensaje',["mensaje" => "Reserva realizada con éxito."]);
            }else{
                $this -> pages -> render('layout/mensaje',["mensaje" => "No hay plazas disponibles."]);

            }}
    }

    public function cancelar_reserva(){
        // Funcion encargada de anular la reserva desde la vista listado de los organizadores
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $datos = $_POST['data'];
            $this -> service -> cancelar_reserva($datos);
            $this -> pages -> render('layout/mensaje',["mensaje" => "Se ha anulado la reserva correctamente"]);
        }
    }

    public function cancelar_reserva_usuario(){
        // Funcion para anular la reserva desde la vista del propio usuario
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $datos = $_POST['data'];
            $this -> service -> cancelar_reserva_usuario($datos);
            $this -> pages -> render('layout/mensaje',["mensaje" => "Se ha anulado la reserva correctamente"]);
        }
    }

    public function sacarListadoAsistentes(){
        // Función para sacar el listado de asistentes de cada actividad
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_actividad = $_POST['data']['id_actividad'];
            $reservas = $this->service->comprobarReservas($id_actividad);
            if ($reservas) {
                $listado = $this->service->sacarListadoAsistentes($id_actividad);
                $this->pages->render('organizadores/ver_inscritos', ['listado' => $listado]);
               
            } else {
                $this->pages->render('layout/mensaje', ["mensaje" => "No hay usuarios inscritos."]);
                //header("Location: " . $_ENV['BASE_URL']);
                
            }
        }
    }
}



?>