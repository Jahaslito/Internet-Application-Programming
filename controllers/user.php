<?php

include("account.php");

 class User implements Account
{        //properties  

    protected $email;
    protected $password;
    protected $fullName;
    protected $city_of_residence;
    //class constructor       
    function __construct($email, $password)
    {
        // $this->fullName = $fullName;
        $this->email = $email;
        // $this->city_of_residence = $city_of_residence;
        $this->password = $password;
    }
  
    //full name setter       
    public function setFullName($name)
    {
        $this->fullName = $name;
    }
    //full name getter    
    public function getFullName()
    {
        return $this->fullName;
    }
 
    public function getEmail()
    {
        return $this->email;
    } 
    public function setEmail($email)
    {
        $this->email = $email;
    }
    //full name getter    
    public function getCityOfResidence()
    {
        return $this->city_of_residence;
    } 
    public function setCityOfResidence($city_of_residence)
    {
        $this->city_of_residence = $city_of_residence;
    }
   
    /**        * Create a new user        
     * * @param Object PDO Database connection handle       
     *  * @return String success or failure message        */      
      public function register($pdo)
    {
        $passwordHash = password_hash($this->password, PASSWORD_DEFAULT);
        try {
            $stmt = $pdo->prepare("INSERT INTO users (full_name, email, city_of_residence, password) VALUES(?,?,?,?)");
            $stmt->execute([$this->getFullName(), $this->email, $this->city_of_residence, $passwordHash]);
            return "Registration was successiful";
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    /**        * Check if a user entered a correct username and password        * @param Object PDO Database connection handle        * @return String success or failure message        */     
       public function login($pdo)
    {
        try {
            echo $this->email;
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
            $stmt->execute([$this->email]);
            $row = $stmt->fetch();
            var_dump($row);
            if ($row == null) {
                return "This account does not exist";
            }
            if (password_verify($this->password, $row['password'])) {
                $_SESSION['email']=$row['email'];
                return "<h1>Full Name => ".$row['full_name']."</h1>";
            }
            return "Your username or password is not correct";
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public static function logout($pdo){


    }
    public function changePassword($pdo,$newPassword,$oldPassword){
        
    }
}

