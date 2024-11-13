<?php 

class Model extends MEDOOHelper{

    public static function authenticate($email, $password){
        $res = parent::selectOne("admin_tbl",'*',['email'=> $email]);
        if(!empty($res) && password_verify($password, $res['password'])){
            return [
                'type' => 'success',
                'message'=> 'sign in successful',
                'email' => $email,
                'role' => $res['role'],
                'Oauth' => $res['status'] == 'on' ? '../admin/Oauth' : 'Off',
                'url' => '../admin/home'
            ];
        }else{
            return [
                'type' => 'error',
                'message'=> 'Wrong email or password'
            ];
        }
    }

    public static function getAllUsers($page, $limit) {
        $startpoint = ($page * $limit) - $limit;
        $data = parent::query(
            "SELECT uid, username, nickname, user_email, user_dob, user_contact, company, agent, balance, rebate FROM users LIMIT :offset, :limit",
            ['offset' => $startpoint, 'limit' => $limit]
        );
        $totalRecords  = parent::count('users');
        return ['data' => $data, 'total' => $totalRecords];
    }

    public static function searchUser($searchKey,$page,$limit) {
        $offset = ($page - 1) * $limit;
    
        // Fetch the paginated user data
        $data = parent::query(
            "SELECT uid, username, nickname, user_email, user_dob, user_contact, company, agent, balance, rebate FROM users 
             WHERE username LIKE :username 
             LIMIT {$limit} OFFSET {$offset}",
            ["username" => "%{$searchKey}%"]
        );
    
        // Fetch the total count of users matching the search criteria
        $totalCount = parent::query(
            "SELECT uid, username, nickname, user_email, user_dob, user_contact, company, agent, balance, rebate FROM users 
             WHERE username LIKE :username ",["username" => "%{$searchKey}%"]
        );
    
        // Return paginated data along with the total count
        return ['data' => $data, 'total' => count($totalCount)];
    }


}