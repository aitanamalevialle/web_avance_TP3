<?php
RequirePage::model('CRUD');
RequirePage::model('User');
RequirePage::model('Privilege');
RequirePage::library('Validation');

class ControllerUser extends controller {

    public function __construct(){
        CheckSession::sessionAuth();

        if($_SESSION['privilege'] != 1) {
            RequirePage::url('login');
            exit();
        }

    }

    public function index(){
        $user = new user;
        $select = $user->select('username');
        $privilege = new Privilege;
        $i=0;

        foreach($select as $user){
             $selectId = $privilege->selectId($user['privilege_id']);
             $select[$i]['privilege']= $selectId['privilege'];
             $i++;
        }

        return Twig::render('user/index.php', ['users'=>$select]);
    }

    public function create(){ 
        $privilege = new Privilege;
        $select = $privilege->select('privilege');
        return Twig::render('user/create.php', ['privileges' => $select]);
    }

    public function store(){
        $validation = new Validation;
        extract($_POST);
        $validation->name('utilisateur')->value($username)->max(50)->required()->pattern('email');
        $validation->name('mot de passe')->value($password)->max(20)->min(6);
        $validation->name('privilege')->value($privilege_id)->required();

        if(!$validation->isSuccess()){
            $errors =  $validation->displayErrors();
            $privilege = new Privilege;
            $select = $privilege->select('privilege');
         return Twig::render('user/create.php', ['errors' =>$errors, 'privileges' => $select, 'user' => $_POST]);
         exit();
        }

        $user = new user;
        $options = [
            'cost' => 10
        ];
        $salt = "H3@_l?a";
        $passwordSalt = $_POST['password'].$salt;
        $_POST['password'] =  password_hash($passwordSalt, PASSWORD_BCRYPT, $options);
        $insert = $user->insert($_POST);
        RequirePage::url('user');
    }

}

?>