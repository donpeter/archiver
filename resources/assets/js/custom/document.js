require('./../../bower/eonasdan-bootstrap-datetimepicker/src/js/bootstrap-datetimepicker')
require('./../../bower/bootstrap-fileinput/js/fileinput.min')
lightbox = require('lightbox2')

$(function(){
  console.log('Documents js Loaded');
  if ($('#files').length) {
    $("#files").fileinput();
  }
  
  $('.datetimepicker').datetimepicker({
      locale: 'en',
      format: 'DD/MM/YYYY'
  });
  if($(".select2").length){
    $(".select2").select2();
  }
  lightbox.option({
      'wrapAround': true,
      'showImageNumberLabel': true
    });

});