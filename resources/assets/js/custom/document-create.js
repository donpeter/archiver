$(function(){
  var newDocument = $('#addDocument');
  if (newDocument.length) {
    $("#files").fileinput();

    /*Prevent Multiple Form Submission*/
    newDocument.submit(function( event ) {
      $('[type=submit]').attr('disabled','disabled');
    });
  }
  
  /*Setup DateTimePicker Plugin*/
  $('.datetimepicker').datetimepicker({
      locale: document.documentElement.lang,
      format: 'DD/MM/YYYY'
  });

  if($(".select2").length){
    $(".select2").select2();
  }

   
   /*$.get('/documents', function(res){
      var documents = res.data;
      documents.forEach(function(item) {
        item.prepaired_on = moment(item.prepaired_on).format('DD-MM-YYYY');
      });
      $('#documents').DataTable( {
           "processing": true,
           "serverSide": false,
           "data": res.data,
           "columns": [
               { "data": "ref" },
               { "data": "title" },
               { "data": "sender" },
               { "data": "receiver" },
               { "data": "prepaired_on" },
               {
               "targets": 1,
               "data": null,
               "defaultContent": `
                   <a href="javascript:void(0)" class="text-inverse pr-5" title="view" data-target="tooltip" data-toggle="tooltip" data-original-title="View"

                     >
                   <i class="zmdi zmdi-eye txt-success"></i>
                   </a>
                   <a href="javascript:void(0)" class="text-inverse pr-5" title="edit" data-target="tooltip" data-toggle="tooltip" data-original-title="Edit" >
                   <i class="zmdi zmdi-edit txt-warning"></i>
                   </a>
                   <a href="javascript:void(0)" class="text-inverse sa-warning" data-toggle="tooltip" data-original-title="Delete">
                   <i class="zmdi zmdi-delete txt-danger"></i>
                   </a>
               `

           }
           ], 
           "dom": 'Bfrtip',
           "buttons": [
               'copy', 'csv', 'excel', 'pdf', 'print'
           ],
       } );
   });*/
  if ($('.dataTable').length >= 1) {
    // Format The Date 
    var dates = $('.dateTable');
    dates.each(function(index,item){
    console.log('Date : ', item.innerText);
    item.innerText = moment(item.innerText).format('DD-MM-YYYY');
    })

    /*
    * CRUD
    */

    // Setup - add a text input to each footer cell
     $('#documents tfoot th').each( function () {
         var title = $(this).text().trim();
         if(title !== 'Action'){
           var className = 'search-filter';
           $(this).html( '<input type="text" class="form-control '+className+'return "  placeholder="Search  '+title+'" />' );
         }      
     } );

     // DataTable
      table = $('#documents').DataTable({
                 dom: 'Bfrtip',
                 buttons: [
                     'copy', 'csv', 'excel', 'pdf', 'print'
                 ],
                 pageLength: 10,
             });

     // Apply the search
     table.columns().every( function () {
         var that = this;

         $( 'input', this.footer() ).on( 'keyup change', function () {
             if ( that.search() !== this.value ) {
                 that
                     .search( this.value )
                     .draw();
             }
         } );
     } );

    /* DOCUMENT SINGLE INSTANCE READ*/
    $(document).on('click','.sa-view',function(e){
        var viewDocument = $('#viewDocument');
        viewDocument.modal('show');
        var row = $(this).parents('tr');
        var id = row.data('id');
        console.log('Viewing: ',id);
        var doc;
        $.getJSON( "/document/"+id, function( res ) {
          doc = res.data;
          console.log(res);
          var imgsHtml = [];
          //Select The Modal 
         var viewModal = $('#viewDocument');
         viewModal.find('#docRef').text(doc.ref);
         viewModal.find('#docTitle').text(doc.title);
         viewModal.find('#docDesc').text(doc.desc);
         viewModal.find('#docUser').text(doc.user.name);
         viewModal.find('#docFolder').text(doc.folder.name);
         viewModal.find('#docTarget').text(doc.organization.name);
         viewModal.find('#docWritten').text(moment(doc.written_on).format('DD-MM-YYYY'));
         viewModal.find('#docSigned').text(moment(doc.signed_on).format('DD-MM-YYYY'));
         viewModal.find('#docCreated').text(moment(doc.created_at).format('DD-MM-YYYY'));
         $.each(doc.files, function(key, img) {
           imgsHtml.push(`
              <div class="col-md-4 single-img "  >
                <div class="img-preview">
                  <a  href="/upload/${img.slug}" data-lightbox="${doc.title }" data-title="${img.name }">
                    <img  src="/upload/${img.slug}" class="img-thumbnail" alt="${img.alt}" max-height="250">
                    <i class="zmdi zmdi-aspect-ratio-alt zmdi-hc-3x mdc-text-light-blue"></i>
                  </a>
                </div>
              </div>
            `);
         });
         viewModal.find('#docImages').hide().html(imgsHtml).fadeIn(2000);
        });

        viewDocument.find('#emailDocument').on('click', function () {
          var emailDocumentModal = $('#emailDocumentModal');
          emailDocumentModal.modal('show');
          viewDocument.modal('hide');

          /*Pre-Fill The Email Document Form*/
          emailDocumentModal.find('#to').val(doc.user.email);
          emailDocumentModal.find('#cc').val(doc.organization.email);
          emailDocumentModal.find('#emailSubject').val(doc.title);
          emailDocumentModal.find('#emailMessage').val(doc.desc);

          //Email The Document to the recipient 
          emailDocumentModal.find('#emailForm').submit(function (e) {
            e.preventDefault();
            $('button[type="submit"]').attr('disabled','disabled');


            var to = emailDocumentModal.find('#to').val();
            var cc = emailDocumentModal.find('#cc').val();
            //var bcc = emailDocumentModal.find('#bcc').val();
            var subject = emailDocumentModal.find('#emailSubject').val();
            var message = emailDocumentModal.find('#emailMessage').val();
            var _token = emailDocumentModal.find('input[name=_token]').val();

            var email = {
              _token: _token,
              to : to,
              cc: cc,
              subject: subject,
              message: message
            };

            axios.post('/document/'+id+'/email', email)
              .then(function (res) {
                console.log('Email Sent');
              })
              .catch(function (err) {//Listen For any possible error
                console.log('Error: Email Failed');
                  swal({
                   title: 'Message Not Delivered',
                   type: 'error',
                   text: 'Email was not sent successfully',
                   timer: 3500,
                   showConfirmButton: true
                  }); 
              });
              $('button[type="submit"]').removeAttr('disabled');
              swal({
                 title: 'Message Sent',
                 type: 'success',
                 text: 'Email successfully sent',
                 timer: 3500,
                 showConfirmButton: true
              });
          });

        })

    });
    /* END SINGLE INSTANCE READ */
    /* END CRUD (READ) FUNTIONS*/
    /* CRUD (DELETE) */

    $(document).on('click','#sa-warning,.sa-warning',function(e){
      var row = $(this).parents('tr');
      datas = table.row(row).data();
      var id = row.data('id');
      var ref = datas[0] //$(this).data('ref') // Extract info from data-* attributes
      var title = datas[1]// $(this).data('title') // Extract info from data-* attributes
      console.log("id: ",id);
      swal({   
           title: "Are you sure?",   
           text: "You will not be able to recover "+title+"!",   
           type: "warning",   
           showCancelButton: true,   
           confirmButtonColor: "red",   
           confirmButtonText: "Yes, delete it!",   
           closeOnConfirm: true,
           //showLoaderOnConfirm: true,
       }, function(){ 
           axios.delete('/document/'+id)
             .then(function (res) {
               console.log(res);
               swal({
                 title: res.data.title,
                 type: 'success',
                 text: res.data.message,
                 timer: 4500,
                 showConfirmButton: true
               }); 
               table.row( row )
                 .remove()
                 .draw();
               console.log(res.data.message );
             })
             .catch(function (err) {
                swal({
                  title: "Error!",
                  text: name +" Archive could not be deleted",
                  timer: 4500,
                  type: 'error',
                  showConfirmButton: true
                }); 
                setTimeout(window.location.reload(), 4500)
             }); 
       });

      return false;
    });
  }

   /* END CRUD (DELETE) */


});