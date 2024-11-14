<?php 

class BusinessFlow extends MEDOOHelper{


    public static function FetchTrsansactionData($page, $limit): array 
    { 
        $startpoint = ($page * $limit) - $limit; 
        $data = parent::query( 
            "SELECT transaction.*, COALESCE(users.username, 'N/A') AS username FROM transaction   
            JOIN users ON users.uid = transaction.uid  ORDER BY trans_id DESC LIMIT :offset, :limit", 
            ['offset' => $startpoint, 'limit' => $limit] 
        ); 
        $totalRecords  = parent::count('transaction');
        $trasationIds = array_column($data,'order_id');
        return ['data' => $data, 'total' => $totalRecords, 'transactionIds' => $trasationIds];
    } 



    public static function filterusername(string $username){
        $data = parent::query("SELECT username FROM users WHERE username LIKE :username ORDER BY username ASC",['username' => "%{$username}%"]);
        return $data;
    }


    public static function getOrderid(){
        $data = parent::query("SELECT order_type FROM transaction  ORDER BY trans_id ASC");
        return $data;
    }
 
 
 
}