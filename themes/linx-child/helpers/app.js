jQuery(document).ready(function($) {
    // Your code here
    $('.infinite-scroll-course-button.button').on('click', function(event) {
        // We will do our magic here soon!
        cat       = $(event.target).parent().parent().attr('class');
        paged     = $(event.target).data('paged');
        max_pages = $(event.target).data('max-pages');

        // increase current page number by +1;
        paged = parseInt(paged);
        paged++;

        data = {cat, paged};

        function callback(res) {

            console.log(res);

            cls = `.posts-wrapper-4-${cat}`;            console.log(cls);

            $(cls).append(res);

            $(event.target).data('paged', paged);

            max_pages = parseInt(max_pages);
            if(paged >= max_pages) {
                $('.infinite-scroll-course-action').remove();
            }
        }

        ajax_send_req(
            /*type:     */'post',
            /*dataType: */'html',
            /*action:   */'course_data_fetch',
            /*data:     */data,
            /*callback: */callback
        );

    });
});




