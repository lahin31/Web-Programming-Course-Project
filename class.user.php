<?php
class USER
{
    private $db;

    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }

    public function register($name,$uname,$email,$upass,$cpass)
    {
       try
       {
           $new_password = password_hash($upass, PASSWORD_DEFAULT);

           $stmt = $this->db->prepare("INSERT INTO user_signup(Name,User_Name,Email,Password,Confirm_Password)
                                                       VALUES(:name, :uname, :email, :upass, :cpass)");

           $stmt->bindparam(":name", $name);
           $stmt->bindparam(":uname", $uname);
           $stmt->bindparam(":email", $email);
           $stmt->bindparam(":upass", $new_password);
           $stmt->bindparam(":cpass", $new_password);
           $stmt->execute();

           return $stmt;
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
    }

    public function login($uname,$upass)
    {
       try
       {
          $stmt = $this->db->prepare("SELECT * FROM user_signup WHERE User_Name=:uname LIMIT 1");
          $stmt->execute(array(':uname'=>$uname));
          $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
          if($stmt->rowCount() > 0)
          {
             if(password_verify($upass, $userRow['Password']))
             {
                $_SESSION['user_session'] = $userRow['id'];
                return true;
             }
             else
             {
                return false;
             }
          }
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }

   public function is_loggedin()
   {
      if(isset($_SESSION['user_session']))
      {
         return true;
      }
   }

   public function redirect($url)
   {
       header("Location: $url");
   }

   public function logout()
   {
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
   }
}
?>
