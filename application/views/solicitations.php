<?php                                    
    if(($receivedSolicitations)) {
        foreach($receivedSolicitations as $friendSolicitation) :
            if($friendSolicitation->status == 0) :    
    ?>
        <div class="col-12 py-2" style="background: #efefef;">
            <div class="row mx-0">
                <div class="col-2 d-flex align-items-center px-0">
                    <?php 
                        if(file_exists('./'.$friendSolicitation->user1->picture)) {
                            echo "<img height='30px' width='30px' src='".base_url().$friendSolicitation->user1->picture."' alt='' style='border-radius:100%'>";
                        } 
                        else { 
                            echo 
                            "<div style='
                                width: 30px;
                                height: 30px;
                                border-radius:100%;
                                font-size:1.5em;
                                color:#313131;
                                display:flex;
                                align-items:center;
                                justify-content:center;
                                background:white;
                            '>" . $friendSolicitation->user1->name[0] ."</div>";
                        }
                    ?>
                </div>
                <div class="col-10 pl-2 pr-0 d-flex align-items-center" style="flex-wrap:wrap; align-content:center">
                    <div>Nova solicitação de amizade</div>
                    <div>
                        <a href="javascript:void(0)" onClick="confirmSolicitation(<?php echo $friendSolicitation->user1->id ?>);"> Aceitar </a>
                    </div>
                </div>
            </div>
        </div>
        <?php        
            endif;
        endforeach;
    } 
    else {
        echo 
        '
            <div class="col-12 p-2" style="background:#efefef">Nenhuma solicitação de amizade</div>
        ';
    }
    ?>