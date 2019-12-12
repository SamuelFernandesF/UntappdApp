module.exports = function () {
    return {
        loadCheckouts : function() {
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
    }
    
}