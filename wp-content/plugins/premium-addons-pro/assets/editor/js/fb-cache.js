function clearCache(obj, type) {

    jQuery.ajax({
        type: "POST",
        url: settings.ajaxurl,
        dataType: "JSON",
        data: {
            action: "clear_reviews_data",
            security: settings.nonce,
            widgetID: jQuery(obj).closest("elementor-widget-premium-" + type + "-reviews")
        },
        success: function (res) {

        },
        error: function (err) {
            console.log(err);
        }
    });


}

function clearReviewsCache(obj) {
    console.log(elementorCommon.helpers.getUniqueId());
    if (!obj) return;

    var type = jQuery(obj).data("type"),
        widgetID = jQuery(obj).data("widgetid"),
        transient = null;

    switch (type) {
        case 'facebook':
            transient = 'papro_reviews_' + jQuery(obj).parents(".elementor-control-clear_cache").prevAll(".elementor-control-page_id").find("input").val() + widgetID;
            console.log(widgetID);
            break;

    }

    clearCache(obj, type);
}