<?php

/*
function fetchAllProducts(){
	global $dbconnect;

	 try{
        $stmt  = $dbconnect->query("SELECT * FROM products");
        $products = $stmt->fetchALL();
      } catch (\PDOexception $e) {
          throw new \PDOexception($e->getMessage(), $e->getCode());
      };

      	return $products;
}	*/



function fetchAllProducts(){
  global $dbconnect;

   try{
        $stmt  = $dbconnect->query("SELECT * FROM products");
        $products = $stmt->fetchALL();
      } catch (\PDOexception $e) {
          throw new \PDOexception($e->getMessage(), $e->getCode());
      };

        return $products;
} 


function fetchAllUsers(){
  global $dbconnect;

  try{
        $stmt  = $dbconnect->query("SELECT * FROM users");
        $users = $stmt->fetchALL();
      } catch (\PDOexception $e) {
          throw new \PDOexception($e->getMessage(), $e->getCode());
      };

      return $users;


    }


 function createAjax($serverData){
  
    return jason_encode($serverData);

 }   


function deleteProduct($productId){
	
	global $dbconnect;

    try{
        $query = "DELETE FROM products WHERE id = :id;";
        $stmt  = $dbconnect->prepare($query);
        $stmt->bindValue(':id', $productId);
        $stmt->execute();
        } catch (\PDOexception $e) {
          throw new \PDOexception($e->getMessage(), (int) $e->getCode());
      };
    };


function deleteUser($userId){
   try{
        $query = "DELETE FROM users WHERE id = :id;";
        $stmt  = $dbconnect->prepare($query);
        $stmt->bindValue(':id', $userId);
        $stmt->execute();
        } catch (\PDOexception $e) {
          throw new \PDOexception($e->getMessage(), (int) $e->getCode());
      };

}


function printVariables($variable) {
      
      echo "<pre>";
      print_r($variable);
      echo "</pre>";

}



?>