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

    // public function transactdata($pageNumber,$limit){
    //     $this->view('exec/businessflow',['page'=>$pageNumber,'limit'=>$limit, 'flag' => 'account_transactions']);
    //     $this->view->render();
    // }

}