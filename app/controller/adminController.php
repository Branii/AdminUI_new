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

    // side bar datas

    public function transactiondata($pageNumber,$limit){
        $this->view('exec/businessflow',['page'=>$pageNumber,'limit'=>$limit, 'flag' => 'transactiondata']);
        $this->view->render();
    }

    public function gamebetdata($pageNumber,$limit){
        $this->view('exec/businessflow',['page'=>$pageNumber,'limit'=>$limit, 'flag' => 'gamebetdata']);
        $this->view->render();
    }

    public function lotterydata($pageNumber,$limit){
        $this->view('exec/businessflow',['page'=>$pageNumber,'limit'=>$limit, 'flag' => 'lotterydata']);
        $this->view->render();
    }

    public function filterusername($username){
        $this->view('exec/businessflow',['username'=>$username,'flag' => 'filterusername']);
        $this->view->render();
    }

    public function getOrderid(){
        $this->view('exec/businessflow',['flag' => 'getOrderid']);
        $this->view->render();
    }


    
}