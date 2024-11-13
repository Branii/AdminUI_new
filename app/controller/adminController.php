<?php

class adminController extends Controller {

    public function index(){
        $this->view('html/signin');
        $this->view->render();
    }

    public function home(){
        $this->view('html/home');
        $this->view->render();
    }

    public function signin(){
        $this->view('exec/signin');
        $this->view->render();
    }

    public function homedata($pageNumber,$limit){
        $this->view('exec/homedata',['page'=>$pageNumber,'limit'=>$limit]);
        $this->view->render();
    }

    public function search($searchKey,$pageNumber,$limit){
        $this->view('exec/search',data: ['searchkey' => $searchKey, 'page'=> $pageNumber,'limit'=> $limit]);
        $this->view->render();
    }

}