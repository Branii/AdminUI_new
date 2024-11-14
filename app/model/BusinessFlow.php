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


    public static function getUserName($uid): String 
    { 
        return parent::selectOne("users", ["username"], ["uid" => $uid])['username']; 
    } 
 
    public static function getLottery($gameId): String 
    { 
        return parent::selectOne("game_type", ["name"], ["gt_id" => $gameId])['name']; 
    } 
 
    public static function getbetID($oder_ID, $beTable) 
    { 
        $betTable = Utils::getGameIdsByGameType()[$beTable]['bet_table']; 
         return  $result = parent::selectOne($betTable, ["bid"], ["bet_code" => $oder_ID])['bid'] ?? 1; 
    } 
 
 
}