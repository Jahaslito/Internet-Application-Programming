<?php

include("account.php");

 class User 
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
                return true;
            }
            return "The credentials do not match our records";
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function getData($pdo)
    {
        // var_dump($this->email);
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$this->email]);
        $row = $stmt->fetch();
        $this->setFullName($row['full_name']);
        $this->setEmail($row['email']);
        $this->setCityOfResidence($row['city_of_residence']);

    }

    public static function logout(){
        if ( isset($_SESSION['email']) ) {

            session_unset();
            header("Location: http://localhost/IAP/Views/login.html");
            die;
        }
        
    }

    public function changePassword($pdo, $oldPassword, $newPassword, $confirmPassword){
       
       try{

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$this->email]);
        $row = $stmt->fetch();

        if ( password_verify($oldPassword, $row['password'] ))
        {
            if ($newPassword == "" && $confirmPassword == ""){
                echo "Fill in the new password and comfirm password";
            }elseif($newPassword != $confirmPassword){
                echo "Password mismatch";
            }else{
                $passwordHash2 = password_hash($newPassword, PASSWORD_DEFAULT);
                $update = $pdo->prepare("UPDATE users SET password = $passwordHash2 WHERE email = ?");
                $update->execute([$this->email]);
            }
            }else{
            echo "Wrong old password";
        }
        }catch(PDOException $e){

            return $e->getMessage();
        }

    }


}
