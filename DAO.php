<?php
require "Connexion.php";
class DAO extends Connexion{ 
       protected $table;     
       
       public function __construct($dsn,$user,$pass,$table) {     
           
        parent::__construct($dsn, $user, $pass);    
            $this->table = $table;   
         }       
          public function insert($data)    {   
                 $req="insert into ".$this->table." (";  
          
                
                    $columns=array_keys($data);
                    for($i=0;$i<count($columns);$i++){
                        if($i!==count($columns)-1){
                            $req.=$columns[$i]." , "; 
                         }else{
                            $req.=$columns[$i].")";
                         }
                    }
                    $values=array_values($data);
                    $req.=" values ( ";
                    for($i=0;$i<count($values);$i++){
                        if($i!==count($values)-1){
                           $req.="'".$values[$i]."' , "; 
                        }else{
                           $req.="'".$values[$i]."')";
                        }
                    }
                    
                 

               echo $req;

                             return parent::UDI($req);       
           }     


           public function update($data)    {    
                 $req="update ".$this->table." set ";    
                 $max=count($data);
                 $count=1;
                 $conditionColumn="";
                 $conditionValue="";
                  foreach($data as $key=>$value){
                      if($count==1){
                        $conditionColumn=$key;
                        $conditionValue=$value;

                      }else{
                      if($max!==$count){
                          $req.= $key." = '".$value." ', ";
                      }else{
                        $req.= $key." = '".$value." ' ";
                      }
                    }
                    $count++;
                  }
                  $req.=" where ".$conditionColumn ."='".$conditionValue." ' ";
                  echo $req;
                           return parent::UDI($req);    

                     } 
                    
                     public function delete($data)    { 
                       
                         
                             $req="delete from  ".$this->table." where ";
                             
                             foreach($data as $key=>$value){
                                 $req.=" ".$key."='".$value."'";
                                 break;
                             }
                                echo $req;
                             return parent::UDI($req);      
                        
                            }
                    public function select($conditions=null)    {     
                                   $req="select * from ".$this->table;
                                    if($conditions!=null){
                                        $req.=" where ";
                                        $max=count($conditions);
                                        $count=1;
                                        foreach($conditions as $key=>$value){
                                            if($count!==$max){
                                                $req.=$key."='".$value."', ";
                                            }else{
                                                $req.=$key."='".$value."' ";
                                            }
                                        }
                                    }
                                    echo $req;   
                                                    
                                          return parent::Select($req);
                                    }  






                        }
     

        //test                
     //   $dao=new DAO("mysql:host=localhost;dbname=gestion_bibliotheque","root","","dectionnaire");

       // $dao->insert(["code"=>"456","titre"=>"good time","langue"=>"english","nbr_def"=>"200"]);
        
       //  $arr=$dao->select(["auteur"=>"black eyed"]);
        // while($row=$arr->fetch()){
           //  echo $row["titre"];
         //}

?>