$(document).ready(init_product_page);
var facts_protected = false;
function init_product_page(){
  
  init_product_tabs();  
  //init_product_pictures();
}

function init_product_tabs(){
  $('#product_tabs .tabs .tabhead').bind('click',function(){
      $('#product_tabs .tabcontent').hide();
      var n = this.id.replace('tab_','');
      $('#tabcontent_' + n).show();      
      $('#product_tabs .tabs .tabhead').removeClass('selected');
      $(this).addClass('selected');
      
      if(this.id=='tab_supplement_facts' && !facts_protected ){
        protect_supplement_facts();
        facts_protected = true;
      }
      return false;
    }
  )
  $($('#product_tabs .tabs .tabhead')[0]).trigger('click');
}

/*
function init_product_pictures(){
  $('.pic_thumbs li .thumb_frame').bind('click',function(){
    
     // alert($(this).attr('medium'));
      $('#main_picture').attr('src',$(this).attr('medium'));
      $('#main_picture').attr('large',this);
      $('.pic_thumbs li .thumb_frame').removeClass('selected');
      $(this).addClass('selected');
      $('#bt_enlarge').attr('href',  this);     
      return false;
  });  
  
  

  $('#bt_enlarge').lightBox();
}
*/