<div class="new-check-in">
    <img height="20px" width="25px" src="<?php echo base_url(); ?>assets/icons/paper-plane.svg" alt="">
</div>

<div class="checkin-card" style="">

<div class="form-card">
    <div class="row mx-0" style="height: 425px;">
        <div class="col-6 h-100 left">
            <div>
                <span style="font-size: 1.6em;">
                    Olá, Samuel
                </span>
                <span style="
                    width: 100%;
                    display: block; 
                    font-size: .9em;">
                    Nessa tela você pode fazer seu checkin. Ele é composto por 3 etapas, primeiro irá cadastrar sua cerveja, depois cadastrará
                    a cervejaria em que está bebendo e por fim o comentário que deseja adicionar.
                </span>
            </div>
            <button id="closeModal" class="primary" style="background: #5eb4ea">
                Cancelar
            </button>
        </div>
        <div class="col-6 right">
            <div class="form-header">
                <div class="row">
                    <div id="beer-header" class="col-4 active">Cerveja</div>
                    <div id="pub-header" class="col-4 ">Cervejaria</div>
                    <div id="checkin-header" class="col-4">Comentário</div>
                </div>
            </div>
            <div class="form-body p-4">
                
                <form id="beer-container" class="form-container active">
                    <label class="form-group">
                        <select id="beerSelector" class="styled-select form-selector">
                            <option value="0" hidden> Selecione sua cerveja </option>
                            <option value="new"> Nova cerveja </option>
                            <?php  
                                foreach($beers as $beer): 
                                    echo '<option value="'.$beer->id.'">'.$beer->name.'</option>';
                                endforeach;
                            ?>
                        </select>
                        <div class="select-placeholder">Cerveja</div>
                    </label>
                    <div class="hidden-form">
                        <label class="form-group">
                            <input name="name" id="beerName" type="text" class="styled-input" disabled>
                            <div class="input-placeholder active">Nome</div>
                        </label>
                        <div class="row">
                            <div class="col-8">
                                <label class="form-group">
                                    <select name="type" id="beerType" class="styled-select" disabled>
                                        <option value='Altbier'> Altbier </option>
                                        <option value='Amber ale' > Amber ale </option>
                                        <option value="Barley wine"> Barley wine </option>
                                    </select>
                                    <div class="select-placeholder">Tipo</div>
                                </label>
                            </div>
                            <div class="col-4 pl-0">
                                <input name="alcoholicStrength" id="alcoholicStrength" type="text" class="styled-input" disabled>
                                <div class="input-placeholder active">Teor</div>
                            </div>
                        </div>
                    </div>
                    <button id="beer-button" class="primary" style="
                                position: absolute;
                                bottom: 18;
                                right: 35px;
                                font-weight: bold;
                            ">
                        Próximo
                    </button>
                </form>


                <form id="pub-container" class="form-container">
                    
                    <label class="form-group">
                        <select id="pubSelector" class="styled-select form-selector">
                            <option value="0" hidden> Selecione sua cervejaria </option>
                            <option value="new"> Nova cervejaria </option>
                            <?php  
                                foreach($pubs as $pub): 
                                    echo '<option value="'.$pub->id.'">'.$pub->name.'</option>';
                                endforeach;
                            ?>
                        </select>
                        <div class="select-placeholder">Cervejaria</div>
                    </label>
                    
                    <div class="hidden-form">
                        <label class="form-group">
                            <input name="name" id="pubName" type="text" class="styled-input" disabled>
                            <div class="input-placeholder active">Nome</div>
                        </label>
                        
                        <div class="row">
                            <div class="col-8">
                                <label class="form-group">
                                    <select name="type" id="pubType" class="styled-select" disabled>
                                        <option> Ruim </option>
                                        <option> Bem bosta </option>
                                        <option value="0"> Prefiro brahma </option>
                                    </select>
                                    <div class="select-placeholder">Tipo</div>
                                </label>
                            </div>
                            <div class="col-4 pl-0">
                                <input name="state" id="pubState" type="text" class="styled-input" disabled>
                                <div class="input-placeholder active">Estado</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <label class="form-group">
                                    <input name="city" id="pubCity" type="text" class="styled-input" disabled>
                                    <div class="input-placeholder active">Cidade</div>
                                </label>
                            </div>
                            <div class="col-4 pl-0">
                                <input name="country" id="pubCountry" type="text" class="styled-input" disabled>
                                <div class="input-placeholder active">País</div>
                            </div>
                        </div>
                                
                        <button id="pub-button" class="primary" style="
                            position: absolute; bottom: 18; right: 30px; font-weight: bold;
                        ">
                            Próximo
                        </button>

                        <button id="pub-back-button" class="primary" style="
                                position: absolute;
                                bottom: 18;
                                left: 35px;
                                font-weight: bold;
                                background : #ccc;
                                color: #212121;
                                border: #ccc;
                            ">
                            Anterior
                        </button>

                    </div>
                </form>

                <form id="checkin-container" class="form-container">
                    
                    <div class="hidden-form">
                        <label class="form-group">
                            <textarea rows="6" name="comment" id="comment" type="text" class="styled-input" style="border: 1px solid #efefef"></textarea>
                            <div class="input-placeholder active">Comentário</div>
                        </label>
                        
                        <label class="form-group">
                            <div class=" active" style="color: #278bcb;
                                font-size: .7em;
                                text-transform: uppercase;
                                font-weight: bold;">
                                Avalie sua experiência
                            </div>
                            <div id="rateYo"></div>
                        </label>

                        <input type='hidden' name="beerId">
                        <input type='hidden' name="pubId">
                        <input type='hidden' name="userId" value="<?php echo $_SESSION['id']; ?>">
                                
                        <button id="checkin-button" class="primary" style="
                            position: absolute; bottom: 18; right: 35px; font-weight: bold;
                        ">
                            Finalizar Checkin
                        </button>

                        <button id="checkin-back-button" class="primary" style="
                                position: absolute;
                                bottom: 18;
                                left: 35px;
                                font-weight: bold;
                                background : #ccc;
                                color: #212121;
                                border: #ccc;
                            ">
                            Anterior
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        const controlClick = function (element, target) {
            const targetElement = $('.' + target);
            if (targetElement.hasClass('hidden')) {
                targetElement.addClass('active');
                targetElement.removeClass('hidden');
            }
            else {
                targetElement.addClass('hidden');
                targetElement.removeClass('active');
            }
        }
        
        $('#navbar-dropdown-close').click(() => controlClick($(this), 'dropdown-container'));

        $('.new-check-in').click(function () {
            $('.overflow').toggleClass('active')
            $('.checkin-card').toggleClass('active')
            $('.form-card').toggleClass('active')
        })

        $('#closeModal').click(function () {
            $('.overflow').toggleClass('active')
            $('.checkin-card').toggleClass('active')
            $('.form-card').toggleClass('active')
        })

        $('#userPicProfile').click(function() {
            $("input[type=file]").trigger("click");
        })

        $('#userPicProfileInput').change(function(e) {
            var form = new FormData();
            form.append("file", $(this)[0].files[0]);

            var url = "<?php echo site_url('Profile/update_picture/'.$user->id); ?>"

            $.ajax({
                url: url,
                cache: false,
                contentType: false,
                processData: false,
                data: form,
                type: 'post',
                success: function(data) {
                    data = JSON.parse(data);
                    var path = "<?php echo base_url()?>"+data.path
                    $('#userPicProfile').attr('src', path)
                }
            });
        })

        $('#beerSelector').change(function() {
            if($(this).val() === 'new') {
                $('#beerName').prop('disabled', false);
                $('#beerType').prop('disabled', false);
                $('#alcoholicStrength').prop('disabled', false);

                $('#beerName').val('');
                $('#beerType').val('');
                $('#alcoholicStrength').val('');
            } else {
                $('#beerName').prop('disabled', true);
                $('#beerType').prop('disabled', true);
                $('#alcoholicStrength').prop('disabled', true);

                var selectedBeer = $('#beerSelector').val();
                var url = "<?php echo site_url('Beer/beerData'); ?>"
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {beer : selectedBeer},
                    dataType: "html",
                    success: function(data) {
                        data = JSON.parse(data)
                        $('#beerName').val(data.name);
                        $('#beerType').val(data.type);
                        $('#alcoholicStrength').val(data.alcoholicStrength);
                    }
                });
            }
        })

        $('#pubSelector').change(function() {
            if($(this).val() === 'new') {
                $('#pubName').prop('disabled', false);
                $('#pubCity').prop('disabled', false);
                $('#pubCountry').prop('disabled', false);
                $('#pubState').prop('disabled', false);
                $('#pubType').prop('disabled', false);

                $('#pubName').val('');
                $('#pubCity').val('');
                $('#pubCountry').val('');
                $('#pubState').val('');
                $('#pubType').val('');

            } else {
                $('#pubName').prop('disabled', true);
                $('#pubCity').prop('disabled', true);
                $('#pubCountry').prop('disabled', true);
                $('#pubState').prop('disabled', true);
                $('#pubType').prop('disabled', true);
                
                var selectedPub = $('#pubSelector').val();
                var url = "<?php echo site_url('pub/pubData'); ?>"
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {pub : selectedPub},
                    dataType: "html",
                    success: function(data) {
                        data = JSON.parse(data)
                        $('#pubName').val(data.name);
                        $('#pubCity').val(data.city);
                        $('#pubCountry').val(data.country);
                        $('#pubState').val(data.state);
                        $('#pubType').val(data.type);
                    }
                });
            }
        })

        $('#beer-button').click(function(e) {
            e.preventDefault(e);
            if($('#beerSelector').val() === 'new') { 

                form = $('#beer-container');
                var url = "<?php echo site_url('Beer/save'); ?>"
                
                var send = true;

                send = ($('#beer-container input[name="name"]').val() === '') ? false : true ;
                send = ($('#beer-container select[name="type"]').val() === '') ? false : true ;
                send = ($('#beer-container input[name="alcoholicStrength"]').val() === '') ? false : true ;

                if(send) {
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: form.serialize(),
                        dataType: "html",
                        success: function(data) {
                            data = JSON.parse(data)
                            console.log(data);
                            if(data.response === 'true') {
                                
                                $('#beerSelector').append($('<option>', {
                                    value : data.beer.id,
                                    text : data.beer.name
                                }));

                                $('#beerSelector').val(data.beer.id).trigger('change');

                                $('input[name="beerId"]').val(data.beer.id);
                                $('#beer-header').removeClass('active');
                                $('#pub-header').addClass('active');
                                $('#beer-container').removeClass('active');
                                $('#pub-container').addClass('active');

                            }
                        }
                    });
                } else {
                    alert('Preencha todos os campos');
                }
            } else if($('#beerSelector').val() != '0') {
                $('#beer-header').removeClass('active');
                $('#pub-header').addClass('active');
                $('#beer-container').removeClass('active');
                $('#pub-container').addClass('active');
                $('input[name="beerId"]').val($('#beerSelector').val())
            } else {
                alert('Selecione sua cerveja')
            }
        }); 

        $('#pub-button').click(function(e){
            e.preventDefault(e);
            
            if($('#pubSelector').val() === 'new') { 

                form = $('#pub-container');
                var url = "<?php echo site_url('Pub/save'); ?>"
                
                var send = true;

                if ($('#pub-container input[name="name"]').val() === '') send = false ;
                if ($('#pub-container select[name="type"]').val() === '') send = false ;
                if ($('#pub-container input[name="state"]').val() === '') send = false ;
                if ($('#pub-container input[name="city"]').val() === '') send = false ;
                if ($('#pub-container input[name="country"]').val() === '') send = false ;
                
                if(send) {
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: form.serialize(),
                        dataType: "html",
                        success: function(data) {
                            data = JSON.parse(data)
                            if(data.response === 'true') {

                                $('#pubSelector').append($('<option>', {
                                    value : data.pub.id,
                                    text : data.pub.name
                                }));

                                $('#pubSelector').val(data.pub.id).trigger('change');

                                $('input[name="pubId"]').val(data.pub.id);
                                $('#pub-header').removeClass('active');
                                $('#checkin-header').addClass('active');
                                $('#pub-container').removeClass('active');
                                $('#checkin-container').addClass('active');
                                $('input[name="pubId"]').val($('#pubSelector').val())
                            }
                        }
                    });
                } else {
                    alert('Preencha todos os campos');
                }
            } else if($('#pubSelector').val() != '0') {
                $('#pub-header').removeClass('active');
                $('#checkin-header').addClass('active');
                $('#pub-container').removeClass('active');
                $('#checkin-container').addClass('active');
                $('input[name="pubId"]').val($('#pubSelector').val())
            } else {
                alert('Selecione sua cerveja')
            }
        });

        $('#pub-back-button').click(function(e) {
            e.preventDefault(e);
            $('#pub-header').removeClass('active');
            $('#beer-header').addClass('active');
            $('#pub-container').removeClass('active');
            $('#beer-container').addClass('active');
        });

        $('#checkin-back-button').click(function(e) {
            e.preventDefault(e);
            $('#checkin-header').removeClass('active');
            $('#pub-header').addClass('active');
            $('#checkin-container').removeClass('active');
            $('#pub-container').addClass('active');
        });

        $('#checkin-button').click(function(e){
            e.preventDefault();
            
            form = $('#checkin-container');
            var url = "<?php echo site_url('Checkin/save'); ?>"

            data = form.serializeArray();
            data.push({name : 'rating', value : $('#rateYo').rateYo("rating")});

            var send = true;
            
            console.log($('#checkin-container textarea[name="comment"]').val())
            if ($('#checkin-container textarea[name="comment"]').val() === '') send = false ;
            
            if(send) {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: data,
                    dataType: "html",
                    success: function(data) {
                        data = JSON.parse(data)
                        console.log(data);
                        if(data.response === 'true') {
                            $('.overflow').toggleClass('active')
                            $('.checkin-card').toggleClass('active')
                            $('.form-card').toggleClass('active')
                        }
                    }
                });
            } else {
                alert('Preencha todos os campos');
            }
        });
            
        $("#rateYo").rateYo({
            starWidth: '15px',
            ratedFill: "#707bf3"
        });

    })
</script>


</body>

</html>