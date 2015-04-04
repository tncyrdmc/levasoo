<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Utente
 *
 * @author user
 */
class Utente {
    private     $id;
    private     $nome;
    private     $cognome;
    private     $email;
    private     $username;
    private     $password;
    private     $lastlogin;
    private     $autenticato;
    private     $access;

    public function  __construct($id=0)
    {
        $this->id = $id;
        $this->nome = "";
        $this->cognome = "";
        $this->email = "";
        $this->username = "";
        $this->password = "";
        $this->setAutenticated(false);
        $this->access = new Access();
    }

    public function getId()
    {
         return $this->id;
    }

    public function setNome($nome)
    {
         $this->nome = $nome;
    }

    public function getNome()
    {
         return $this->nome;
    }

    public function setCognome($cognome)
    {
         $this->cognome = $cognome;
    }

    public function getCognome()
    {
         return $this->cognome;
    }

    public function setEmail($email)
    {
         $this->email = $email;
    }

    public function getEmail()
    {
         return $this->email;
    }

    public function setUsername($uname)
    {
         $this->username = $uname;
    }

    public function getUsername()
    {
         return $this->username;
    }

    public function setPassword($pwd)
    {
         $this->password = $pwd;
    }

    public function getPassword()
    {
         return $this->password;
    }

    public function getLastLogin()
    {
         return $this->lastlogin;
    }

    public function setAutenticated($aut)
    {
         $this->autenticato = $aut;
    }

    public function isAutenticated()
    {
         return $this->autenticato;
    }

    public function login()
    {
       $dbAcc      = $this->access;
       //***
       $dbQuery = " SELECT id, nome, cognome, email ";
       $dbQuery.= " FROM   utenti ";
       $dbQuery.= " WHERE  username = '".$this->username."' ";
       $dbQuery.= " AND    password = '".base64_encode($this->password)."' ";
       //***
       //Verifica autenticazione utente
       $risult = $dbAcc->select($dbQuery);
       $this->setAutenticated(count($risult) === 1);
       if ($this->autenticato)
       {
           $this->id        = $risult[0]['id'];
           $this->nome      = $risult[0]['nome'];
           $this->cognome   = $risult[0]['cognome'];
           $this->email     = $risult[0]['email'];
           $this->setLoginTime();
       }
    }

    public function logout()
    {
      Session::destroyObj(Session::UTENTE);
    }
    
    public function save()
    {
        $dbAcc = $this->access;
        $query  = " INSERT INTO utenti ( ";
        $query .= " nome, cognome, email, username, password ";
        $query .= " ) VALUE ( ";
        $query .= "'".$this->nome."', ";
        $query .= "'".$this->cognome."', ";
        $query .= "'".$this->email."', ";
        $query .= "'".$this->username."', ";
        $query .= "'".base64_encode($this->password)."') ";
        //***
        $this->id = $dbAcc->insert($query);
        return $this->id;
    }
    
    public function update()
    {
        $dbAcc = $this->access;
        $query  = " UPDATE utenti SET ";
        $query .= " nome = '".$this->nome."', ";
        $query .= " cognome = '".$this->cognome."', ";
        $query .= " email = '".$this->email."', ";
        $query .= " username = '".$this->username."', ";
        $query .= " password = '".base64_encode($this->password)."' ";
        $query .= " WHERE ";
        $query .= " id = ".$this->id;
        //***
        return $dbAcc->update($query);
    }
    
    public function getForgottenPassword()
    {
       $dbAcc      = $this->access;
       //***
       $dbQuery = " SELECT password ";
       $dbQuery.= " FROM   utenti ";
       $dbQuery.= " WHERE  email = '".$this->email."' ";
       //***
       $risult = $dbAcc->select($dbQuery);
       return $risult?base64_decode($risult[0]['password']):'';
    }

    private function setLoginTime() 
    {
        $dt = new DateTime();
        $this->lastlogin = $dt->format('Y-m-d H:i:s');
        $dbAcc = $this->access;
        $query  = " UPDATE utenti SET ";
        $query .= " lastlogin = '".$dt->format('Y-m-d H:i:s')."' ";
        $query .= " WHERE ";
        $query .= " id = ".$this->id;
        //***
        return $dbAcc->update($query);
    }
 
    public function getAvatarImage() {
      return '../view/box/img/avatar.png';
    }
}
?>