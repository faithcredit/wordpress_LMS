(function($){

    $('#pluginops_imglib_dataUpdater').on('click', function(e){
        e.preventDefault();

        $.ajax({
            url: db_updater_req_url.admin_ajax,
            type: 'POST',
            data: {},
            success: function(response){
                response = JSON.parse(response);
                if(response.result === 'success'){
                    console.log('success');
                    $('.pluginopsDbUpdateNotice').css('display','none');
                }
                console.log(response);
            },
        }).fail(function(error) {
            console.log(error);
        })
        .always(function() {
            console.log("complete");
        });	

    });

})(jQuery);