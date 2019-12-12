
<?php 
if(isset($page)) echo '<div class="col-12 mb-3" style="font-size:1.8em;font-weight:300"> Checkins </div>';
if($checkins) {
    $counter=0;foreach($checkins as $checkin ) : ?>
<!-- CHECK IN -->
<div name="<?php echo $checkin->id; ?>" class="check-in col-12 <?php echo ($counter > 0) ? 'mt-4' : '' ?>">
    <div class="row mx-0">
        <div class="col-2">
            <div class="profile-picture">
            <?php 
                if(file_exists('./'.$checkin->userData->picture)) {
                    echo "<img class='userImage' id='' src='".base_url().$checkin->userData->picture."' alt=''>";
                } else {
                    echo "<div class='userImage' id='' style='
                            width: 100%;
                            height: 100%;
                            border-radius:100%;
                            font-size:1.5em;
                            color:#313131;
                            display:flex;
                            align-items:center;
                            justify-content:center;
                            border : 1px solid #efefef;
                        '>" . $checkin->userData->name[0] ."</div>";
                }
            ?>
            </div>
        </div>
        <div class="col-10">
            <div class="row">
                <div class="col-9">
                    <div class="row">
                        <div class="col-12 px-0">
                            <span class="user-name comment"> <?php echo $checkin->userData->name ?> </span>
                            <div class="rating d-block">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        
                        <div class="col-12 px-0 check-in-text mt-2 comment-description"><?php echo $checkin->comment ?></div>

                        <div class="col-12 px-0 mt-3">
                            <i class="fas fa-comments"></i>
                        </div>
                        
                    </div>
                    <div class="row">
                        <?php 
                        if(isset($checkin->comments[0])) { 
                            $counter2=0; 
                            foreach($checkin->comments as $comment): ?>
                            <div class="col-12 px-0 <?php echo ($counter2 > 0) ? '' : 'mt-3'; ?> comment">
                                <div class="row mx-0 py-2 px-1 border border-bottom-0 border-left-0 border-right-0 ">
                                    <div class="col-3 pl-0">
                                        <div class="profile-picture">
                                        <?php 
                                            if(file_exists('./'.$comment->userData->picture)) {
                                                echo "<img class='userImage' id='' src='".base_url().$comment->userData->picture."' alt=''>";
                                            } else {
                                                echo "<div class='userImage' id='' style='
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
                                        ?>
                                        </div>
                                    </div>

                                    <div class="col-9 pl-0 align-self-center">
                                        <span class="user-name w-100"> Someone </span>
                                        <span class="comment-text">
                                            <?php echo $comment->comment; ?>
                                        </span>
                                    </div>

                                    <div class="col-10 offset-2 pl-0">
                                        <!-- <i class="fas fa-thumbs-up"></i> -->
                                    </div>
                                </div>
                            </div>
                        <?php $counter2++;endforeach; }?>
                    </div>
                </div>
                <div class="col-3 beer-description">
                    <ul class="list-unstyled">
                        <li class="beer-name">
                            <?php echo $checkin->beerData->name ?>
                        </li>
                        <li class="beer-type">
                            <?php echo $checkin->beerData->type ?>
                        </li>
                        <li class="beer-strength">
                            <?php echo $checkin->beerData->alcoholicStrength ?>%
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $counter++;endforeach; ?>

<script>
    $(document).ready(function() {
        $('.fa-comments').click(function() {
            $('.overflow').toggleClass('active');
            $('.comment-form-box').toggleClass('active');

            var text = $(this).parent().siblings('.comment-description').text();
            var userImage = $(this).parents('.row.mx-0').children('.col-2').children('.profile-picture').children('.userImage').attr('src');
            var id = $(this).parents('.check-in').attr('name');

            $('#commentId').val(id);
            $('#userComment').text(text);
            $('#userImage').attr('src', userImage);
        });

        $('#sendComment').one('click', function(e) {
            e.preventDefault();
            form = $('#comment-form');
            var url = "<?php echo site_url('Profile/add_comment/'); ?>"
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(),
                dataType: "html",
                success: function(data) {
                    if(data === 'success') {
                        var url = "<?php echo site_url('Profile/get_checkouts/'.$user); ?>"
                        $.ajax({
                            type: "GET",
                            url: url,
                            dataType: "html",
                            success: function(data) {
                                $('#checkins-container').html(data);
                            }
                        });
                    }
                }
            });
            $('.overflow').toggleClass('active');
            $('.comment-form-box').toggleClass('active')
        })

        $('#cancelComment').click(function(e) {
            e.preventDefault();
            $('.overflow').removeClass('active');
            $('.comment-form-box').removeClass('active');
        })
    })
</script>
<?php } ?>
