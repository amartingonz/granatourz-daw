<?php
    namespace Models;
    
    // CREAR LA CLASE USUARIOS

    class Usuarios{
        public function __construct(
            private int $id_usuario,
            private string $dni,
            private string $nombre,
            private string $apellidos,
            private string $email,
            private string $telefono,
            private string $password,
            private string $rol,
            private int $confirmado,
            private string $token
        )
        {}
            /**
             * Get the value of id
             */ 
            public function getId():int
            {
                        return $this->id_usuario;
            }

            /**
             * Set the value of id
             *
             * @return  self
             */ 
            public function setId(int $id)
            {
                        $this->id_usuario = $id;

                        return $this;
            }

            /**
             * Get the value of nombre
             */ 
            public function getNombre():string
            {
                        return $this->nombre;
            }

            /**
             * Set the value of nombre
             *
             * @return  self
             */ 
            public function setNombre(string $nombre)
            {
                        $this->nombre = $nombre;

                        return $this;
            }

            /**
             * Get the value of email
             */ 
            public function getEmail():string
            {
                        return $this->email;
            }

            /**
             * Set the value of email
             *
             * @return  self
             */ 
            public function setEmail(string $email)
            {
                        $this->email = $email;

                        return $this;
            }

            /**
             * Get the value of telefono
             */ 
            public function getTelefono()
            {
                        return $this->telefono;
            }

            /**
             * Set the value of telefono
             *
             * @return  self
             */ 
            public function setTelefono($telefono)
            {
                        $this->telefono = $telefono;

                        return $this;
            }
            
            /**
             * Get the value of password
             */ 
            public function getPassword():string
            {
                        return $this->password;
            }

            /**
             * Set the value of password
             *
             * @return  self
             */ 
            public function setPassword(string $password)
            {
                        $this->password = $password;

                        return $this;
            }

        

            /**
             * Get the value of rol
             */ 
            public function getRol():string
            {
                        return $this->rol;
            }

            /**
             * Set the value of rol
             *
             * @return  self
             */ 
            public function setRol(string $rol)
            {
                        $this->rol = $rol;

                        return $this;
            }

            
            /**
             * Get the value of token
             */ 
            public function getToken()
            {
                        return $this->token;
            }

            /**
             * Set the value of token
             *
             * @return  self
             */ 
            public function setToken($token)
            {
                        $this->token = $token;

                        return $this;
            }

            /**
             * Get the value of confirmado
             */ 
            public function getConfirmado()
            {
                        return $this->confirmado;
            }

            /**
             * Set the value of confirmado
             *
             * @return  self
             */ 
            public function setConfirmado($confirmado)
            {
                        $this->confirmado = $confirmado;

                        return $this;
            }
            public static function fromArray(array $data):Usuarios{
                return new Usuarios(
                    $data['id_usuario'] ?? '',
                    $data['dni'] ?? '',
                    $data['nombre'] ?? '',
                    $data['apellidos'] ?? '',
                    $data['email'] ?? '',
                    $data['telefono'] ?? '',
                    $data['password'] ?? '',
                    $data['fecha'] ?? '',
                    $data['rol'] ?? '',
                    $data['confirmado'] ?? '',
                    $data['token'] ?? '',
                );
            }

      

    }