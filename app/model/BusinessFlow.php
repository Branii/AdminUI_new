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
        return ['data' => $data, 'total' => $totalRecords];
    } 

    public static function FilterTrsansactionDataSubQuery($username ='', $orderid='', $ordertype='', $from='', $to=''){
        $conditions = [];

        if (!empty($username) && $username != 'all') {
            $conditions['transaction.uid'] = $username;
        }
    
        if (!empty($orderid) && $orderid != 'all') {
            $conditions['transaction.order_id'] = $orderid;
        }
    
        if (!empty($ordertype) && $ordertype != 'all') {
            $conditions['transaction.order_type'] = $ordertype;
        }
    
        if ($from != '' && $to != '') {
            $conditions['transaction.date_created[<>]'] = [$from, $to];
        } elseif ($from != '') {
            $conditions['transaction.date_created[>=]'] = $from;
        } elseif ($to != '') {
            $conditions['transaction.date_created[<=]'] = $to;
        }
    
        return $conditions;
    }

    public static function FilterTrsansactionData($page, $limit, $username, $orderid, $ordertype, $startdate, $enddate) 
    { 

        $whereConditions = self::FilterTrsansactionDataSubQuery($username, $orderid, $ordertype, $startdate,$enddate);
        $startpoint = ($page * $limit) - $limit; 
        $data = parent::selectAll("transaction",'*',[
            "AND" => $whereConditions,
            "ORDER" => ["transaction.trans_id" => "DESC"],
            "LIMIT" => [$startpoint, $limit]
        ]); 
        $lastQuery = MedooOrm::openLink()->log();
        $totalRecords  = parent::selectAll('transaction','*',     [
            'AND' => $whereConditions]);
        return ['data' => $data, 'total' => count($totalRecords), 'sql' => $lastQuery[0]];
    } 

    public static function filterusername(string $username){
        $data = parent::query("SELECT uid,username FROM users WHERE username LIKE :username ORDER BY username ASC",['username' => "%{$username}%"]);
        return $data;
    }

    public static function getUsernameById(string $userId){
        $data = parent::query("SELECT username FROM users WHERE uid = :uid",['uid' => $userId])[0]['username'];
        return $data;
    }
 
}
