<div class="col-12 mb-3" style="font-size:1.8em;font-weight:300"> Usuários </div>
<?php 
if($usersArray)
    foreach($usersArray as $user) {
?>
        <div class="col-3 search-container" style="height: 275px;cursor:pointer">
            <a style="text-decoration:none;color:inherit" href="<?php echo site_url('Profile/user/').$user->id ?>">
                <div class="insider" style="background: white;height: 100%;border-radius: 5px;border: 1px solid #efefef">
                    <div class="header" style="height: 60%;display: flex;align-content: center;justify-content: center;flex-wrap: wrap">
                        <div class="image-cointeiner w-100 text-center">
                            <?php 
                                $position = strpos($user->picture, 'assets');
                                if($position !== false) {
                            ?>
                                <img class="rounded-circle" height="60px" width="60px" src="<?php echo base_url().$user->picture ?>";>
                            <?php } else { ?>
                                <div style="
                                    height: 60px;
                                    width: 60px;
                                    background: #278bcb;
                                    border-radius: 100%;
                                    margin: auto;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    font-size: 2em;
                                    color: white;
                                ">
                                    <span><?php echo $user->name[0] ?></span>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="person-name text-center mt-2" style="width: 100%;font-weight: bold;line-height: 1em;font-size:.9em">
                            <?php echo $user->name; ?>
                        </div>
                        
                        <div class="person-info text-center" style="width: 100%;font-size: .9em;color: #a8a8a8">
                            <?php echo $user->friends.' amigos';?>
                        </div>
                    </div>

                    <div class="info" style="
                        height: 40%;
                        border-top: 1px solid #f9f9f9;
                        display: flex;
                        align-items: center;
                        ">
                        <div class="row w-100 mx-0">
                            <div class="col-6 text-center">
                                <div class="sencond-info-value" style="font-size: 1.5em">
                                    <?php echo $user->checkins; ?>
                                </div>
                                <div class="sencond-info-label"style="font-size:.8em;">
                                    checkins
                                </div>
                            </div>
                            <div class="col-6 text-center">
                                <div class="sencond-info-value" style="font-size: 1.5em">
                                    5
                                </div>
                                <div class="sencond-info-label"style="font-size:.8em;">
                                    badges
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php };?>