<body> 
    <!-- USER PROFILE -->
    <div class="container-fluid h-100">
        <div class="row">
            <!-- LEFT SIDEBAR -->
            <div class="col-3 h-100 user-sidebar py-4">
                <div class="row">
                    <div class="col-12 tex-center">
                        <div class="profile-picture">
                            <?php if($user->id == $_SESSION['id']) { ?> 
                                <input id="userPicProfileInput" type="file" style="display:none"></input>  
                                <?php } ?>
                            <?php 
                                if(file_exists('./'.$user->picture) && $_SESSION['id'] == $user->id) {
                                    echo "<img id='userPicProfile' src='".base_url().$user->picture."' alt='' style='cursor:pointer'>";
                                }
                                else if(file_exists('./'.$user->picture) && $_SESSION['id'] != $user->id) {
                                    echo "<img id='userPicProfile' src='".base_url().$user->picture."' alt=''>";
                                } else if (!file_exists('./'.$user->picture) && $_SESSION['id'] == $user->id) {
                                    echo 
                                        "<div id='userPicProfile' style='
                                            width: 100%;
                                            height: 100%;
                                            border-radius:100%;
                                            font-size:2.5em;
                                            color:#313131;
                                            display:flex;
                                            align-items:center;
                                            justify-content:center;
                                            cursor:pointer;
                                        '>" . $user->name[0] ."</div>";
                                }
                                else if (!file_exists('./'.$user->picture) && $_SESSION['id'] != $user->id) { 
                                    echo 
                                    "<div id='userPicProfile' style='
                                        width: 100%;
                                        height: 100%;
                                        border-radius:100%;
                                        font-size:2.5em;
                                        color:#313131;
                                        display:flex;
                                        align-items:center;
                                        justify-content:center;
                                    '>" . $user->name[0] ."</div>";
                                }
                            ?>
                        </div>
                    </div>
                    <div class="col-12 text-center user-name mt-2">
                        <?php echo $user->name ?>
                    </div>
                    <div class="col-12 px-4 mt-2 user-description">
                        <?php
                            if($user->description === '') {
                                if($user->id == $_SESSION['id']) {
                                    echo 
                                        "<div class='description-box'>
                                            <a id='userDescription'> Adicione uma descrição </a>
                                        </div>";
                                } else {
                                    echo "<span class='breakWord'> Esse usuário ainda não possui uma descrição </span>";
                                }

                            }
                            if($user->id == $_SESSION['id']) {
                                echo " 
                                    <a class='breakWord' id='userDescription'>".$user->description."</a>
                                ";
                            }
                            else echo "<span class='breakWord'>". $user->description; "</span>"
                        ?>
                    </div>
                    <div class="col-12 text-center mt-4">
                        <?php 
                            if($_SESSION['id'] != $user->id) {
                                if(!$friends) {
                                    echo '
                                    <button id="addFriend" class="white">
                                        Adicionar como amigo
                                    </button>';
                                }
                            } 
                        ?>
                        
                    </div>
                    <div class="friends col-12 mt-4">
                        <div class="row" id="friendsFromUser">
                            
                        </div>
                        <div class="row mt-2 mx-2">
                            <span style=" font-size: .9em; color: white;">
                            </span>
                        </div>
                    </div>

                </div>

            </div>

            <!-- CONTENT -->
            <div class="col-7 offset-3 content-container">
                <div class="row py-4 px-5">
                    <div class="col-12" style="">

                    </div>
                    <div class="col-12 content-box px-0" id="checkins-container">
                    </div>
                </div>
            </div>

            <!-- RIGHT SIDEBAR -->
            <div class="col-2 sidebar-right">
                <span class="title">
                    Badges
                </span>
                <ul class="list">
                    <li>Bem vindo</li>
                    <li>Bebendo no happy our</li>
                    <li>Ufa, hoje é sexta - feira</li>
                    <li>Expandindo horizontes</li>
                </ul>
                <span class="title">
                    Statistics
                </span>
                <ul class="list">
                    <li>Total : <?php echo $user->total_beers; ?></li>
                    <li>Beers : <?php echo $user->beer_counter; ?></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="overflow"></div>

    <div class="description-form-box" style="">
        <span style="font-size:.9em;text-transform:uppercase;font-weight:bold;">Adicionar descrição</span>
        <form id="description-form" class="mt-2">
            <textarea name="userDescription" rows="10" cols="45" style="border:1px solid #d4d4d4"></textarea>
            <button id="sendDescription" class="primary float-right mt-2"> Enviar </button>
            <button id="cancelDescription" class="secondary float-right mt-2 mr-2"> Cancelar </button>
        </form>
    </div>

    <div class="comment-form-box" style="padding:0;border:none; width:525px">
        
        <div class="comment-response-header d-flex align-items-center px-4" 
            style="
                witdh: 100%; 
                height:10%;
                border-top-left-radius: 15px;
                border-top-right-radius: 15px;
                border-bottom : 1px solid #efefef">
            <span style="font-size:.8em;text-transform:uppercase;line-height:1em;margin-bottom:-4px">Responder <?php echo $user->name; ?></span>
        </div>

        <div class="comment-response-body p-4" style="height: 45%;overflow-y:scroll">
            <div class="row mx-0">
                <div class="col-2 pl-0">
                    <img id="userImage" src="" style="border-radius:100%;height:50px;width:50px">
                </div>
                <div class="col-10 px-0">
                    <span id="userComment" style="font-size:.8em;"></span>
                </div>

            </div>
            
        </div>
        
        <div class="comment-response-footer px-4 py-2" 
            style="
                height: 45%; 
                background: #95c3e05c;
                border-bottom-left-radius : 4px;
                border-bottom-right-radius : 4px;">

            <form id="comment-form" class="mt-2">
                <textarea name="comment" rows="3" style="border:2px solid #b2d8ef; border-radius:5px;width:100%"></textarea>
                <input type="hidden" id="commentId" name="checkinId"></input>
                <input type="hidden" id="" name="userId" value="<?php echo $_SESSION['id'] ?>"></input>
                <button id="sendComment" class="primary float-right mt-3"> Enviar </button>
                <button id="cancelComment" class="secondary float-right mt-3 mr-2"> Cancelar </button>
            </form>
        </div>
        
        
    </div>

<script>
    $('document').ready(function() {

        loadCheckouts();
        loadFriends();
        loadSolicitations();

        $('#sendDescription').click(function(e) {
            e.preventDefault();
            form = $('#description-form');
            var url = "<?php echo site_url('Profile/update_description/'.$user->id); ?>"
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(),
                dataType: "html",
                success: function(data) {
                    data = JSON.parse(data)
                    $('#userDescription').text(data.val);
                }
            });
            $('.overflow').toggleClass('active');
            $('.description-form-box').toggleClass('active')
        });
        
        function loadCheckouts() {
            var url = "<?php echo site_url('Profile/get_checkouts/'.$user->id); ?>"
            $.ajax({
                type: "GET",
                url: url,
                dataType: "html",
                success: function(data) {
                    $('#checkins-container').html(data);
                }
            });
        }

        $('#userDescription').click(function() {
            $('.overflow').toggleClass('active');
            $('.description-form-box').toggleClass('active')
        })

        $('#cancelDescription').click(function(e) {
            e.preventDefault();
            $('.overflow').toggleClass('active');
            $('.description-form-box').toggleClass('active')
        });

        $('#addFriend').click(function(e) {
            var url = "<?php echo site_url('Profile/add_friend/'.$user->id); ?>"
            $.ajax({
                type: "POST",
                url: url,
                dataType: "html",
                success: function(data) {
                    data = JSON.parse(data);
                    if(data === 'success'){
                        alert('Solicitação enviada');
                        $('#addFriend').remove();
                    } 
                }
            });
        });

        function loadFriends() {
            var url = "<?php echo site_url('Profile/load_friends/'.$user->id) ?>";
            $.ajax({
                type: "GET",
                url: url,
                dataType: "html",
                success: function(data) {
                    console.log(data);
                    $('#friendsFromUser').html(data);
                }
            });    
        }
        
    });
</script>
