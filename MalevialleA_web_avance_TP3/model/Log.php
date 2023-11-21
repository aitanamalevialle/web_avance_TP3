<?php

class Log extends CRUD {

    protected $table = 'log';
    protected $primaryKey = 'id';
    protected $fillable = ['adresse_IP', 'date_consultation', 'nom_utilisateur', 'page_visitee'];

    public function insertLog() {

        $log = [];
        $log['adresse_IP'] = $_SERVER['REMOTE_ADDR'];
        $log['date_consultation'] = date('Y-m-d H:i:s');
        $log['page_visitee'] = $_SERVER['REQUEST_URI'];

        if (isset($_SESSION['user_id'])) {
            $user = new User;
            $userInfo = $user->selectId($_SESSION['user_id']);
            $log['nom_utilisateur'] = $userInfo['username'];
        } else {
            $log['nom_utilisateur'] = 'guest';
        }
        
        $this->insert($log);
    }    
}

?>