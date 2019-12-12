<html>
    <div class="second-nav" style="">
        <div class="row w-100">
            <div class="col-3"></div>
            <div class="col-7 h-100">
                <ul class="list-unstyled list-inline mb-0 h-100 text-center d-flex align-items-center justify-content-center">
                    <li id="userFilter" class="list-inline-item px-2 active"> Usuários </li>
                    <li id="beerFilter" class="list-inline-item px-2"> Cervejas </li>
                    <li id="pubFilter" class="list-inline-item px-2"> Cervejarias </li>
                    <li id="checkinFilter" class="list-inline-item px-2"> Checkins </li>
                </ul>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
    <!-- USER PROFILE -->
    <div class="container-fluid py-3" style="margin-top:120px;background:#f2f2f2;min-height:calc(100vh - 120px);">
        <div class="row justify-content-center">
            <div class="col-12" style="max-width:80%;margin-auto">
                <div id="searchContent" class="row mx-0">
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            
            setTimeout(() => {
                $( "#userFilter" ).trigger( "click" );    
            }, 10);
            
            function changeActive(target) {
                if($('#userFilter').hasClass('active')) $('#userFilter').removeClass('active');
                if($('#beerFilter').hasClass('active')) $('#beerFilter').removeClass('active')
                if($('#pubFilter').hasClass('active')) $('#pubFilter').removeClass('active')
                if($('#checkinFilter').hasClass('active')) $('#checkinFilter').removeClass('active')
                $(target).addClass('active');
            }

            $('#userFilter').click(function(e) {
                var url = "<?php echo site_url('Search/user_filter/') ?>";
                $.ajax({
                    type: "POST",
                    data: { search : "<?php echo $_GET['search']; ?>" },
                    url: url,
                    dataType: "html",
                    success: function(data) {
                        $('#searchContent').html(data);
                        changeActive('#userFilter');
                    }
                }); 
            });

            $('#beerFilter').click(function(e) {
                var url = "<?php echo site_url('Search/beer_filter/') ?>";
                $.ajax({
                    type: "POST",
                    data: { search : "<?php echo $_GET['search']; ?>" },
                    url: url,
                    dataType: "html",
                    success: function(data) {
                        $('#searchContent').html(data);
                        changeActive('#beerFilter');
                    }
                }); 
            });

            $('#pubFilter').click(function(e) {
                var url = "<?php echo site_url('Search/pub_filter/') ?>";
                $.ajax({
                    type: "POST",
                    data: { search : "<?php echo $_GET['search']; ?>" },
                    url: url,
                    dataType: "html",
                    success: function(data) {
                        $('#searchContent').html(data);
                        changeActive('#pubFilter');
                    }
                }); 
            });

            $('#checkinFilter').click(function(e) {
                var url = "<?php echo site_url('Search/checkin_filter/') ?>";
                $.ajax({
                    type: "POST",
                    data: { search : "<?php echo $_GET['search']; ?>" },
                    url: url,
                    dataType: "html",
                    success: function(data) {
                        $('#searchContent').html(data);
                        changeActive('#checkinFilter');
                    }
                }); 
            });

        })
    </script>

</body>

</html>