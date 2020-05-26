<?php
	function redirect($location) {
	    header("Location: {$location}");
	    exit;
	}
    
    //fetch all
	function fetchAll() {
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

    // Fetch by id
    function fetchById($id) {
	    global $dbconnect;

	    try {
       
        $query = "
        SELECT * FROM users
        WHERE id = :id";

        $stmt = $dbconnect->prepare($query);
        $stmt->bindvalue(':id', $_SESSION['id']);
        $stmt->execute();
        
        $user = $stmt->fetch();
    } catch (\PDOException $e) {
      throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }

	    return $user;
	}

	//Fetch by Email
	function fetchByEmail($email) {
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

	//Delete
    function delete($id) {
    	global $dbconnect;
    	try {
	    $query = "
	      DELETE FROM users
	      WHERE id = :id;
	    ";

	    $stmt = $dbconnect->prepare($query);
	    $stmt->bindValue(':id', $_SESSION['id']);
	    $stmt->execute();
	  } catch (\PDOException $e) {
	    throw new \PDOException($e->getMessage(), (int) $e->getCode());
	  }
	  header('Location: login.php?logout');
	  exit;
    }
    
    //Register
	function register($userData) {
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
    function update($userData) {
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

?>