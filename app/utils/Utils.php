

<?php 

class Utils extends MEDOOHelper{

public static function getGameIdsByGameType(): array 
    { 
        $res = parent::selectAll("gamestable_map", ["game_type", "draw_table", "bet_table", "draw_storage"]); 
        $mainData = []; 
        foreach ($res as $data) { 
            $mainData[$data['game_type']] = $data; 
        } 
        return $mainData; 
 
    }

}