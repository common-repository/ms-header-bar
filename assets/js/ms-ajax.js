function setCookie(thisElm) {
    var data = {
      action: 'cookie_info',
      security : ciAjax.security,
    };
    
    jQuery.post(ciAjax.ajaxurl, data, function(response) {});
    jQuery('#cn_sec').hide();
    jQuery('body').css('overflow', 'initial');
    jQuery('.hide_links').css('display', 'none');
}