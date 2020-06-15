<?php
	function redirect($location) {
	    header("Location: {$location}");
	    exit;
	}



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

    
    //fetch all users
	function fetchAllUsers() {
    	global $dbconnect;

        try {
			  $query = "SELECT * FROM users";
			  $stmt = $dbconnect->query($query);
			  $users = $stmt->fetchAll();
			} catch (\PDOException $e) {
			  throw new \PDOException($e->getMessage(), (int) $e->getCode());
			}
		return $users;
    }

    function fetchProductsById() {
        global $dbconnect;
        
        try {
            $query = "
                SELECT * FROM products
                WHERE id = :id
            ";

            $stmt = $dbconnect->prepare($query);
            $stmt->bindvalue(':id', $_POST['productId']);
            $stmt->execute();
            $product = $stmt->fetch();
        } catch (\PDOException $e) {
          throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }

        return $product;
    }

    // Fetch users by id

    function fetchUsersById($id) {
	    global $dbconnect;

	    try {
       
        $query = "
        SELECT * FROM users
        WHERE id = :id";

        $stmt = $dbconnect->prepare($query);
        $stmt->bindvalue(':id', $id);
        $stmt->execute();
        
        $user = $stmt->fetch();
    } catch (\PDOException $e) {
      throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }

	    return $user;
	}

	//Fetch  users by Email
	function fetchUsersByEmail($email) {
	    global $dbconnect;

	    try {
            $query = "
                SELECT * FROM users
                WHERE email = :email;
            ";

            $stmt = $dbconnect->prepare($query);
            $stmt->bindValue(':email', $email);
            $stmt->execute(); // returns true/false
            // fetch() fetches 1 record, fetchAll() fetches alla records 
            $user = $stmt->fetch(); // returns the user record if exists, else returns false
            } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
            }

	        return $user;
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

	//Delete
    function deleteMyUser($id) {
    	global $dbconnect;
    	try {
	    $query = "
	      DELETE FROM users
	      WHERE id = :id;
	    ";

	    $stmt = $dbconnect->prepare($query);
	    $stmt->bindValue(':id', $id);
	    $stmt->execute();
	  } catch (\PDOException $e) {
	    throw new \PDOException($e->getMessage(), (int) $e->getCode());
	  }
	  
    }


    function deleteUser($userId){
        global $dbconnect;

   try{
        $query = "DELETE FROM users WHERE id = :id;";
        $stmt  = $dbconnect->prepare($query);
        $stmt->bindValue(':id', $userId);
        $stmt->execute();
        } catch (\PDOexception $e) {
          throw new \PDOexception($e->getMessage(), (int) $e->getCode());
      };

}

    
    //Register
	function registerUser($userData) {
        global $dbconnect;
   
        try {
                $query = "
                    INSERT INTO users (first_name, last_name, email, password, phone, street, postal_code, city, country)
                    VALUES (:firstname, :lastname, :email, :password, :phone, :street, :postal_code, :city, :country);
                ";

                
                $stmt = $dbconnect->prepare($query);
                $stmt->bindValue(':firstname', $userData['firstname']);
                $stmt->bindValue(':lastname', $userData['lastname']);
                $stmt->bindValue(':email', $userData['email']);
                $stmt->bindValue(':password', password_hash($userData['password'], PASSWORD_BCRYPT));
                $stmt->bindValue(':phone', $userData['phone']);
                $stmt->bindValue(':street', $userData['street']);
                $stmt->bindValue(':postal_code', $userData['postalcode']);
                $stmt->bindValue(':city', $userData['city']);
                $stmt->bindValue(':country', $userData['password']);
                $result = $stmt->execute(); // returns true/false

                } catch(\PDOException $e) {
                    throw new \PDOException($e->getMessage(), (int) $e->getCode());
                }
                return $result;
            }
        
    //Update
    function updateUser($userData) {
		global $dbconnect;

		try {
                $query = "
                    UPDATE users
                    SET first_name = :firstname, last_name = :lastname, email = :email, password = :password, phone = :phone, street = :street, postal_code = :postal_code, city = :city, country = :country
                    WHERE id = :id
                ";

                $stmt = $dbconnect->prepare($query);
                $stmt->bindValue(':firstname', $userData['firstname']);
                $stmt->bindValue(':lastname', $userData['lastname']);
                $stmt->bindValue(':email', $userData['email']);
                $stmt->bindValue(':password', password_hash($userData['password'], PASSWORD_BCRYPT));
                $stmt->bindValue(':phone', $userData['phone']);
                $stmt->bindValue(':street', $userData['street']);
                $stmt->bindValue(':postal_code', $userData['postalcode']);
                $stmt->bindValue(':city', $userData['city']);
                $stmt->bindValue(':country', $userData['country']);
                $stmt->bindValue(':id', $userData['id']);
                $result = $stmt->execute(); // returns true/false
            } catch(\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int) $e->getCode());
            }

		    return $result;
		}


        function printVariables($variable) {
      
                  echo "<pre>";
                  print_r($variable);
                  echo "</pre>";

            }


?>