<?php

class CategoriesController extends AppController {
    public $components = array('Session');
    public function index(){
        $this->set("framework", "CakePHP");
        $data = $this->Category->find("all");
        $this->set("categories", $data);

    }
    public function add()
    {
       if($this->request->is('post')){
           $this->Category->create();
           if($this->Category->save($this->request->data)){
               $this->Session->setFlash("The category has been saved");
               $this->redirect('index');
           };
       }
    }
    public function view($id)
    {
        $data = $this->Category->findById($id);
        $this->set("category", $data);
    }
}