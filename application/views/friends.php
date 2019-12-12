<?php 
    if($userFriends) {
        foreach($userFriends as $friend) {
            if(isset($friend->newFriend)) {
                echo ' <div class="col-3 px-0" style="background:white"><a href="'.base_url().'Profile/user/'.$friend->newFriend->id.'" style="text-decoration:none;">';
                if(file_exists('./'.$friend->newFriend->picture)) {
                    echo '<img width="100%" height="65px" src="'.base_url().$friend->newFriend->picture.'" style="cursor:pointer">';
                } 
                else { 
                    echo 
                    "<div style='
                        width: 100%;
                        height:65px;
                        border-radius:100%;
                        font-size:2.5em;
                        color:#313131;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        cursor:pointer;
                    '>" . $friend->newFriend->name[0] ."</div>";
                }
                echo '</a></div>';
            } else {
                echo ' <div class="col-3 px-0" style="background:white"><a href="'.base_url().'Profile/user/'.$friend->id.'" style="text-decoration:none;">';
                if(file_exists('./'.$friend->picture)) {
                    echo '<img width="100%" height="65px" src="'.base_url().$friend->picture.'" style="cursor:pointer">';
                } 
                else { 
                    echo 
                    "<div style='
                        width: 100%;
                        height:65px;
                        border-radius:100%;
                        font-size:2.5em;
                        color:#313131;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        cursor:pointer;
                    '>" . $friend->name[0] ."</div>";
                }
                echo '</a></div>';
            }
        }
    }
?>