<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Economica" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css">

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>

<body style="background : #278bcb;overflow: hidden;">

    <div class="container-fluid h-100">

        <div class="checkin-card-2 d-flex" >
            <div class="form-card-2">
                <div class="row mx-0 login-form-body" style="">
                    <div class="col-5 right order-1">
                        <div class="p-4 login-form-header">
                                <span class="Untappd">
                                UNTAPPD
                            </span>
                            <span class="drink">
                                DRINK
                            </span>
                            <span class="socially">
                                SOCIALLY
                            </span>
                            <div class="row mx-0">
                                <div class="line-draw">
                                </div>
                                <div class="line-draw" style="
                                    height: 4px;
                                    width: 5px;
                                    margin-left: 2px;
                                    background: #278bcb;
                                    margin-top: 40px;
                                ">
                                </div>
                            </div>
                        </div>
                        <div class="form-body p-4 mt-4">
                            <div id="beer-container" class="form-container active">
                                
                                <form id="login-form" class="login-form">
                                    <label class="form-group">
                                        <input required name="username" type="text" class="styled-input">
                                        <div class="input-placeholder active">USERNAME</div>
                                    </label>
                                    <label class="form-group">
                                        <input required name="password" type="password" class="styled-input">
                                        <div class="input-placeholder active">Password</div>
                                    </label>
                                </form>

                                <form id="signup-form" class="signup-form hidden">
                                    <label class="form-group">
                                        <input required name="username" type="text" class="styled-input">
                                        <div class="input-placeholder active">Nome</div>
                                    </label>
                                    <label class="form-group">
                                        <input required name="password" type="password" class="styled-input">
                                        <div class="input-placeholder active">Password</div>
                                    </label>
                                    <label class="form-group">
                                        <input required name="email" type="email" class="styled-input">
                                        <div class="input-placeholder active">Email</div>
                                    </label>
                                </form>
                                
                            </div>
                            
                        </div>
                        
                        
                        <div class="form-type-text">Ainda não é cadastrado? Crie sua conta</div>
                        <div class="button-container">
                            <button id="login-form-button" class="primary login">
                                Enviar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        $(document).ready(function() {
            $('.form-type-text').click(function() {
                if($(this).text() === 'Ainda não é cadastrado? Crie sua conta') {
                    $('.login-form').addClass('hidden');
                    setTimeout(() => {
                        $('.login-form').addClass('d-none');
                        $('.signup-form').removeClass('d-none');    
                        $('.signup-form').removeClass('hidden');    
                        $('.form-type-text').text('Já é cadastrado? Faça seu login');
                    }, 500);
                } else {
                    $('.signup-form').addClass('hidden');
                    setTimeout(() => {
                        $('.signup-form').addClass('d-none');
                        $('.login-form').removeClass('d-none');    
                        $('.login-form').removeClass('hidden');    
                        $('.form-type-text').text('Ainda não é cadastrado? Crie sua conta');
                    }, 500);
                }
            });

            $('#login-form-button').click(function() {

                let form, url;

                if($('.form-type-text').text() === 'Ainda não é cadastrado? Crie sua conta') {
                    form = $('#login-form');
                    url = "<?php echo site_url('Login/login_method'); ?>"
                } else {
                    form = $('#signup-form');
                    url = "<?php echo site_url('Login/signup'); ?>"
                }

                const data = form.serialize();
                const userInformations = data.split('&');
                let uncompletedSignup = false;
                userInformations.forEach((str) => {
                    if(str === 'username=' || str === 'password=' || str === 'email=') uncompletedSignup = true;
                });

                if(form.attr('id') === 'signup-form') {
                    (uncompletedSignup) ? alert('por favor preencha todos os campos') : makeRequest(data, url);
                } 
                else makeRequest(data, url);
            });
        }) 

        function makeRequest(data, url) {
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                dataType: "html",
                success: function(data){
                    data = JSON.parse(data);
                    if(data.response != 'false') window.location.href = "http://localhost/Untappd/Profile/user/"+data.user.id;
                    else alert('Informações incorretas');
                },
                error : function(data) { console.log(data); }
            });
        }

    </script>
</body>
</html>