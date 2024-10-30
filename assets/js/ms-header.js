(function($) {
        $(document).ready(function(){
            if($('.ms-header-bar').length){
              $('.ms-header-bar').each(function(){
                var header_id = $(this).attr('data-postid');
                var current_hd = $(this);
                var current_header = msh_header_data[header_id];
                if($.isEmptyObject(current_header)==false){
                     var header_height = parseInt($('.ms-header-bar').height());
                     if(current_header['position']=='top'){
                         var headerbar = '<div class="ms-top-header-bar ms-top-header-bar-whole"></div>';
                         $('body').prepend(headerbar);
                         if($('.ms-header-counter').length && $( window ).width()<500){
                            header_height = header_height + 75;
                         }
                         $('.ms-top-header-bar').css('height',header_height+'px');
                      }
                      $('.ms-header-close').css('height',header_height);
                }

              if($('.ms-header-counter').length){
                header_timerfn(header_id);
              }
              $('.ms-header-callback-input').find('input[name=header_callback_submit]').on('click',function(){
                    $('.ms-header-bar-content').hide();
                    $('.ms-header-callback-success').show();
                    setTimeout(function(){ 
                        $(this).closest('.ms-header-bar').slideToggle();
                            if(('.ms-top-header-bar').length){
                                $('.ms-top-header-bar').slideToggle();
                            }
                         }, 3000);
                })
               $('.ms-header-form-input').find('input[name=header_form_submit]').on('click',function(){
                    $('.ms-header-bar-content').hide();
                    $('.ms-header-form-success').show();
                    setTimeout(function(){ 
                        $(this).closest('.ms-header-bar').slideToggle();
                        if(('.ms-top-header-bar').length){
                            $('.ms-top-header-bar').slideToggle();
                        }
                         }, 3000);
                })
               current_hd.on('click','.ms-header-close',function(){
                    current_hd.slideToggle();

                    if($('.ms-top-header-bar').length&&current_header['position']=='top'){
                        $('.ms-top-header-bar').slideToggle();
                    }
               })
               var headerbar_show = '';
               $.each(current_header.screen_size,function(screnkey, screenvalue){
                if(screenvalue=="all"){
                    headerbar_show = 1;
                    return false;
                }else{
                    headerbar_show = false;
                    if(screenvalue=='220' && $( window ).width()<400){
                        showheader_bar(header_id);
                    }
                    if(screenvalue=='320' && ($( window ).width()<800 && $( window ).width()>400)){
                        showheader_bar(header_id);
                    }
                    if(screenvalue=='768' && $( window ).width()>800){
                       showheader_bar(header_id);
                    }
                }
            });
            if(headerbar_show){
               showheader_bar(header_id);
            }
        })
        }            
          
});

function showheader_bar(postid){
    var delaytime =  parseInt(msh_header_data[postid].time);
    setTimeout(function(){
                     if(msh_header_data[postid]['position']=='top'){
                        $('.ms-top-header-bar').slideToggle();
                     }
                    $('#ms-header-'+postid).slideToggle();
                },delaytime);
}



function header_timerfn(selector) {
                var currentDate = new Date();
                var futureDate  = new Date(
                                            msh_header_data[selector].expire_year,
                                            msh_header_data[selector].expire_month,
                                            msh_header_data[selector].expire_days,
                                            msh_header_data[selector].expire_hours,
                                            msh_header_data[selector].expire_min,
                                            msh_header_data[selector].expire_sec
                                        );

                var diff = futureDate.getTime() / 1000 - currentDate.getTime() / 1000;

                clock = $('.ms-header-clock-'+selector).FlipClock(diff, {

                    clockFace: 'DailyCounter',

                    countdown: true

                }); 
}

})(jQuery);