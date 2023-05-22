<?php
    namespace Controllers;
    use Lib\Pages;
    use Models\Categoria;
    use Services\CategoriaService;

    
    class CategoriaController{
        private CategoriaService $service;
        private Pages $pages;

        public function __construct(){
            $this -> pages = new Pages();
            $this -> service = new CategoriaService();
        }

        public function crear_categoria()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $datos = $_POST['nombre'];
        $existe = $this->service->comprobarCategoria($datos);
        if (!$existe) {
            $this->service->crear_categoria($_POST['nombre']);
            $categorias = $this->listar_categorias();
            $_SESSION['categorias'] = $categorias;
            header("Location:" . $_ENV['BASE_URL']);
            $this->pages->render('layout/mensaje', ["mensaje" => "Categoría creada con éxito"]);
        } else {
            $this->pages->render("layout/mensaje", ["mensaje" => "La categoría ya existe"]);
        }
    } else {
        $this->pages->render('categorias/crear_categoria');
    }
}


        public function listar_categorias():?array{
            // Funcion para listar categorias.
            $categorias = $this-> service -> getAll();
            return $categorias;
        }

        
    }



    ?>