<?php
class Connexion extends PDO{
    public function __construct($dsn, $user,$pass) {     
            parent::__construct($dsn,$user,$pass); 
            } 
     public function UDI($req)     { 
                                 return parent::exec($req)  ;           
                                }     
     public function Select($req)     {
                                  return parent::query($req);    
                                                
                }
}




?>