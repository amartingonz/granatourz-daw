<?php

namespace Controllers;
use Lib\Pages;
use Models\Sancion;
use Models\Actividad;
use Services\SancionService;
use Utils\Utils;
use Services\ActividadService;


class SancionController{
    private SancionService $service;
    private Pages $pages;
    private Utils $utils;
    private ActividadService $servicep;

    public function __construct(){
        $this -> pages = new Pages();
        $this -> service = new SancionService();
        $this -> utils = new Utils();
        $this -> servicep = new ActividadService();
    }


    public function proponer_sancion(){
        // Esta función sirve para los usuarios que tengan rol de organizador y sirve para proponer a un usuario para sancion, luego los administrador podrán verlo.
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($this -> service -> proponer_sancion($_POST['data'])){
                $this -> pages -> render('layout/mensaje',["mensaje" => "Has propuesto la sanción correctamente"]);
            }else{
                $this -> pages -> render('layout/mensaje',["mensaje" => "Ha fallado la propuesta de sanción correctamente"]);
            }
        }
    }



    public function confirmar_sancion(){
        // Esta función sirve para que los administradores puedan confirmar las propuestas de sanción
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($this -> service -> confirmar_sancion($_POST['data'])){
                $this -> pages -> render('layout/mensaje',["mensaje" => "Usuario sancionado correctamente"]);
            }else{
                $this -> pages -> render('layout/mensaje',["mensaje" => "No se ha podido completar la sanción"]);
            }
        }else{
             // Agregar los renders faltantes
             $sanciones = $this -> service -> getAll();
             $this -> pages -> render('sanciones/ver_propuestas', ["sanciones" => $sanciones]);
        }
    }


    
}


?>