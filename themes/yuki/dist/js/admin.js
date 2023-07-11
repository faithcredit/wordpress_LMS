(() => {
    var __webpack_exports__ = {};
    jQuery((function($) {
        $(".yuki-theme-notice .yuki-notice-dismiss").click((function() {
            var $notice = $(this).parents(".notice");
            var dismiss_url = $notice.attr("data-dismiss-url");
            if (dismiss_url) {
                $.ajax({
                    url: dismiss_url,
                    complete: function complete() {
                        $notice.hide();
                    }
                });
            }
        }));
    }));
})();