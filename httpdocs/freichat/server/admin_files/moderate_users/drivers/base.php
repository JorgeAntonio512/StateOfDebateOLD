<?php

class Moderation {

    public $db;
    public $db_prefix;
    public $host;
    public $client_db_name;
    public $username;
    public $password;
    public $row_username;
    public $row_userid;
    public $usertable;
    public $no_of_ret_users = 0;

    
    public function get_users($from,$no_of_records,$search='') {
        
       if($search != '') {
           $search = " WHERE u.".$this->row_username." LIKE  \"%$search%\" ";
       }
        
        $query = 'SELECT u.'.$this->row_username.' AS username, u.'.$this->row_userid.' AS id, f.no_of_messages, x.user_id
                    FROM '.$this->db_prefix.$this->usertable.' AS u
                    
                    LEFT JOIN (

                    SELECT v.from, COUNT( * ) no_of_messages
                    FROM frei_chat AS v
                    GROUP BY v.from
                    ) AS f ON f.from = u.'.$this->row_userid.'
                    
                    LEFT JOIN (

                    SELECT w.user_id
                    FROM frei_banned_users AS w
                    GROUP BY w.user_id
                    ) AS x ON x.user_id = u.'.$this->row_userid.'
                    '.$search.'
                    ORDER BY u.'.$this->row_userid.'   
                    LIMIT '.$from.','.$no_of_records;

        $obj = $this->db->query($query);
       //  echo $query;
        $result = $obj->fetchAll();
        $this->no_of_ret_users = count($result);
        
        return $result;
    }
    
   public function get_no_of_users($search) {
       
       if($search != '') {
           $search = " WHERE username LIKE  \"%$search%\" ";
       }

       $query = "SELECT COUNT( * ) FROM ".$this->db_prefix.$this->usertable.$search;
       $count = $this->db->query($query)->fetchAll();
       
       return $count[0][0];
   }
    
   
   public function set_db_data(){
       return false;
   }
    
}