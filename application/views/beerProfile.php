<body> 
    <!-- USER PROFILE -->
    <div class="container-fluid h-100">
        <div class="row">
            <!-- LEFT SIDEBAR -->
            <div class="col-3 h-100 user-sidebar py-4" style="background:white;">
                <div class="row">
                    <div class="col-12 tex-center">
                        <div class="profile-picture">
                            <?php 
                                echo 
                                "<div id='userPicProfile' style='
                                    background: #278ebe;
                                    width: 100%;
                                    height: 100%;
                                    border-radius:100%;
                                    font-size:2.5em;
                                    color:white;
                                    display:flex;
                                    align-items:center;
                                    justify-content:center;
                                '>" . $beer->name[0] ."</div>";
                            ?>
                        </div>
                    </div>
                    <div class="col-12 text-center user-name mt-2" style="color:#278ebe">
                        <?php echo $beer->name ?>
                    </div>
                    <div class="beer-rating mx-auto"></div>
                    <div class="col-12 text-center mt-2" style="color:#313131;font-size:.8em">
                        <div class="unique-checkins"></div>
                    </div>
                    <div class="col-12 text-center" style="color:#313131;font-size:.8em">
                        <div class="total-checkins"></div>
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
            <div class="col-9 offset-3 content-container">
                <div class="row py-4 px-5">
                    <div class="col-12" style="">

                    </div>
                    <div class="col-12 content-box px-0" id="checkins-container">
                    </div>
                </div>
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
            <span style="font-size:.8em;text-transform:uppercase;line-height:1em;margin-bottom:-4px">Responder <?php echo $beer->name; ?></span>
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

        loadCheckins();
        loadFriends();
        loadSolicitations();
        getData();

        function loadFriends() {
            var url = "<?php echo site_url('Beer/load_users/'.$beer->id) ?>";
            $.ajax({
                type: "GET",
                url: url,
                dataType: "html",
                success: function(data) {
                    $('#friendsFromUser').html(data);
                }
            });    
        }

        function getData() {
            var url = "<?php echo site_url('Beer/get_beer_data/'.$beer->id) ?>";
            $.ajax({
                type: "GET",
                url: url,
                dataType: "html",
                success: function(data) {
                    var data = JSON.parse(data);
                    $(".beer-rating").rateYo({
                        starWidth: '15px',
                        ratedFill: "#278bcb",
                        rating : data.rating,
                        readOnly: true,
                    });
                    $('.unique-checkins').html(data.uniqueCheckins + ' Checkins únicos');
                    $('.total-checkins').html(data.checkinCount + ' Checkins totais');
                }
            });    
        }

        function loadCheckins() {
            var url = "<?php echo site_url('Beer/get_checkins/'.$beer->id); ?>"
            $.ajax({
                type: "GET",
                url: url,
                dataType: "html",
                success: function(data) {
                    $('#checkins-container').html(data);
                }
            });
        }
        
    });
</script>
