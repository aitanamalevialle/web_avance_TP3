<?php

RequirePage::model('CRUD');
RequirePage::model('Voyage');
RequirePage::library('Validation');

class ControllerVoyage extends controller {

    public function index(){
        $voyage = new Voyage;
        $select = $voyage->select();
        return Twig::render('voyage-index.php', ['voyages'=>$select]);
    }

    public function create(){
        CheckSession::sessionAuth();
        if($_SESSION['privilege'] == 1 || $_SESSION['privilege'] == 2){
        $voyage = new Voyage;
        $select = $voyage->select();
        return Twig::render('voyage-create.php', ['voyages'=>$select]);
        }
        RequirePage::url('login'); 
    }

    public function store(){
        $validation = new Validation;
        extract($_POST);
        $validation->name('destination')->value($destination)->max(45)->min(5);
/*         $validation->name('date depart')->value($date_depart)->pattern('date_dmy');
        $validation->name('date retour')->value($date_retour)->pattern('date_dmy'); */
        $validation->name('prix')->value($prix)->pattern('int');
        $validation->name('description')->value($description)->max(400)->min(5);

        if(!$validation->isSuccess()){
        $errors =  $validation->displayErrors();
        return Twig::render('voyage-create.php', ['errors' =>$errors, 'voyage' => $_POST]);
        exit();
        }

        $voyage = new Voyage;
        $insert = $voyage->insert($_POST);
        RequirePage::url('voyage/show/'.$insert);
    }

    public function show($id){
        $voyage = new Voyage;
        $selectId = $voyage->selectId($id);
        return Twig::render('voyage-show.php', ['voyage'=>$selectId]);
    }

    public function edit($id){
        $voyage = new Voyage;
        $selectId = $voyage->selectId($id);
        return Twig::render('voyage-edit.php', ['voyage'=>$selectId]);
    }

    public function update(){
        $validation = new Validation;
        extract($_POST);
        $validation->name('destination')->value($destination)->max(45)->min(5);
/*         $validation->name('date depart')->value($date_depart)->pattern('date_dmy');
        $validation->name('date retour')->value($date_retour)->pattern('date_dmy'); */
        $validation->name('prix')->value($prix)->pattern('int');
        $validation->name('description')->value($description)->max(400)->min(5);

        if(!$validation->isSuccess()){
        $errors =  $validation->displayErrors();
        return Twig::render('voyage-edit.php', ['errors' =>$errors, 'voyage' => $_POST]);
        exit();
        }

        $voyage = new Voyage;
        $update = $voyage->update($_POST);
        RequirePage::url('voyage/show/'.$_POST['id']);
    }

    public function destroy(){
        CheckSession::sessionAuth();

        if($_SESSION['privilege'] == 1){
            $voyage = new Voyage;
            $update = $voyage->delete($_POST['id']);
            RequirePage::url('voyage/index');
        }else{
            RequirePage::url('login');
        }

    }
    
}

?>