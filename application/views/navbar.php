
<html>

    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css">

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

    </head>

    <script>
        loadSolicitations();

        function confirmSolicitation(id) {
            var url = "<?php echo site_url('Profile/confirm_solicitation/')?>";
            $.ajax({
                type: "POST",
                data : {
                    add : id,
                    page : '-1',
                },
                url: url,
                dataType: "html",
                success: function(data) {
                    $('#friendsFromUser').html(data);
                    loadSolicitations();
                }
            });
        }

        function loadSolicitations() {
            var url = "<?php echo site_url('Profile/load_solicitations/') ?>";
            $.ajax({
                type: "GET",
                url: url,
                dataType: "html",
                success: function(data) {
                    $('#userSolicitations').html(data);
                }
            }); 
        }

        $(document).ready(function() {
            $('.add-user').click(function(e) {
                $(this).children('.dropdown-container').toggleClass('active');
                $(this).children('.arrow-up').toggleClass('active');
            });

            $('.fa-search').click(function(e) {
                if($('input[name="search"]').val() === '') {
                    alert('Por favor digite algo na busca');
                } else {
                    var url = "<?php echo site_url('Search') ?>";
                    window.location = url + '?search=' + $('input[name="search"]').val();
                }
            });
        })

    </script>
<body>
<!-- NAVBAR -->
<div class="navbar p-0">
    <div class="row mx-0 h-100 w-100 align-items-center">
        <!-- USER PROFILE -->
        <div class="col-3 px-0 h-100">
            <div class="row w-100 mx-0 h-100">
                <div class="col-3 px-0 d-flex align-items-center justify-content-center" style="border-right:1px solid #f8f8f8;height:100%">
                    <a href="<?php echo base_url().'Profile/user/'.$_SESSION['id']; ?>">
                        <?php 
                            $position = strpos($_SESSION['picture'], 'assets');
                            if($position !== false) {
                        ?>
                            <img class="rounded-circle" height="30px" width="30px" src="<?php echo base_url().$_SESSION['picture'] ?>";>
                        <?php } else { ?>
                            
                            <div style="
                                height: 30px;
                                width: 30px;
                                background: #278bcb;
                                border-radius: 100%;
                                margin: auto;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                font-size: 1em;
                                color: white;
                            ">
                                <span><?php echo $_SESSION['name'][0]; ?></span>
                            </div>
                        <?php } ?>
                    </a>
                </div>

                <div class="col-8 d-flex align-items-center h-100">
                    <ul class="list-inline list-unstyled mb-0">
                        <li class="list-inline-item" style="color : #278bcb; margin-left:10px;cursor:pointer"> 
                            <i class="fas fa-fw fa-bell"></i>     
                        </li>
                        
                        <li class="list-inline-item add-user" style="color : #278bcb; margin-left:10px;cursor:pointer;position:relative"> 
                            <i class="fas fa-fw fa-user-plus"></i>
                            <div class="arrow-up"></div>
                            <div class="dropdown-container">
                                <div class="row mx-0" id="userSolicitations">
                                </div>
                            </div>
                        </li>

                        <li class="list-inline-item" style="color : #278bcb; margin-left:10px;cursor:pointer"> 
                            <a href="<?php echo base_url() ?>login/logout"><i class="fas fa-fw fa-sign-out-alt"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            
        </div>

        <!-- SEARCH PANEL -->
        <div class="col-7">
            <div class="position-relative" style="width:55%;margin:auto">
                <input name="search" class="search" type="text" placeholder="Procure por uma cerveja, usuário, ou bar." style="width:100%;font-size:.8em">
                <div style="position:absolute;top:11px;right:15px;">
                    <i style="color: #313131; cursor:pointer" class="fas fa-search"></i>
                </div>
            </div>
        </div>
        
        <div class="col-2 text-right">
        </div>
        
    </div>
</div>