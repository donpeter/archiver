$(function(){
  if ($('#files').length) {
    $("#files").fileinput();
  }
  
  $('.datetimepicker').datetimepicker({
      locale: document.documentElement.lang,
      format: 'DD/MM/YYYY'
  });
  if($(".select2").length){
    $(".select2").select2();
  }

});