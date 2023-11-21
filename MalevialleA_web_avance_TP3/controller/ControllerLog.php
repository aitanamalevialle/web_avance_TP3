<?php

RequirePage::model('CRUD');
RequirePage::model('Log');
RequirePage::model('User');
RequirePage::model('Privilege');

class ControllerLog extends Controller {

    public function __construct(){
        CheckSession::sessionAuth();

        if ($_SESSION['privilege'] != 1) {
            RequirePage::url('login');
            exit();
        }

    }
    
    public function index(){
        $log = new Log;
        $log->insertLog();
        $select = $log->select();
        return Twig::render('log/index.php', ['logs' => $select]);
    }

}

?>