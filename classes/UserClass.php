<?php
require_once 'BaseClass.php';

enum Role{
    case Admin;
    case Editor;
    case Viewer;
}
class User extends BaseModel {
    public $name;
    public $email;
    public $password;
    public Role $role;
    
    public function __construct($name,$email, $password,Role $role = Role::Viewer) {
        $this->name= $name;
        $this->email= $email;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        $this->role= $role;
        $this->setTimestamps();
    }
}



    // function toArray() {
    //     return [
    //         'id'=> $this->id,
    //         'name'=> $this->name,
    //         'email'=> $this->email,
    //         'role'=> $this->role->value,
    //         'created_at' => $this->created_at,
    //         'updated_at' => $this->updated_at,
    //     ];
    // }


// جربي دي يا الاء متنسيش بعد ال enum
// $user = new User('alaa', 'alaa@gmail.com', '1234', Role::Admin);

// $user = new User('perter', 'spidy@gmail.com', '1234', 'SpiderMan'); // Error!

