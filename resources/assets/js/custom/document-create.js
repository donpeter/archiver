$(function(){
  var IMGPATH = 'https://s3.us-east-2.amazonaws.com/lefkebelediyesi/'

    var newDocument = $('#addDocument');
    if (newDocument.length) {
        $("#files").fileinput({
          allowedFileExtensions: ["jpg", "jpeg", "gif", "png"],
          browseClass: "btn btn-success",
          browseLabel: "Pick Image",
          browseIcon: "<i class=\"glyphicon glyphicon-picture\"></i> ",
          removeClass: "btn btn-danger",
          removeLabel: "Delete",
          removeIcon: "<i class=\"glyphicon glyphicon-trash\"></i> ",
          uploadClass: "btn btn-info hide",

          uploadUrl: '/',
        });

        /*Prevent Multiple Form Submission*/
        newDocument.submit(function( event ) {
          $('[type=submit]').attr('disabled','disabled');
        });
    }
  
    /*Setup DateTimePicker Plugin*/
    $('.datetimepicker').datetimepicker({
        locale: document.documentElement.lang,
        format: 'DD/MM/YYYY',
        defaultDate: moment.now()
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
            item.innerText = moment(item.innerText).format('DD-MM-YYYY');
        })

        /*
        * CRUD
        */

        // Setup - add a text input to each footer cell
         $('#documents tfoot th').each( function () {

             var title = $(this).text().trim().toLowerCase();
             var id  =$(this).data('name') ? $(this).data('name').trim().toLowerCase() + 's' : '';
             if(title !== 'action'){
               var className = 'search-filter';
               $(this).html( '<input type="text" class="form-control '+className+'return "  placeholder="Search  '+title+'" id="'+id +'" />' );
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
            var viewDocumentModal = $('#viewDocumentModal');
            viewDocumentModal.modal('show');
            var row = $(this).parents('tr');
            var id = row.data('id');
            var doc;
            $.getJSON( "/document/"+id, function( res ) {
              doc = res.data;
              var imgsHtml = [];
              //Select The Modal 
             viewDocumentModal.find('#docRef').text(doc.ref);
             viewDocumentModal.find('#docTitle').text(doc.title);
             viewDocumentModal.find('#docDesc').text(doc.desc);
             viewDocumentModal.find('#docUser').text(doc.user.name);
             viewDocumentModal.find('#docFolder').text(doc.folder.name);
             viewDocumentModal.find('#docTarget').text(doc.organization.name);
             viewDocumentModal.find('#docWritten').text(moment(doc.written_on).format('DD-MM-YYYY'));
             viewDocumentModal.find('#docSigned').text(moment(doc.signed_on).format('DD-MM-YYYY'));
             viewDocumentModal.find('#docCreated').text(moment(doc.created_at).format('DD-MM-YYYY'));
             $.each(doc.files, function(key, img) {
               imgsHtml.push(`
                  <div class="col-md-4 single-img "  >
                    <div class="img-preview">
                      <a  href="${IMGPATH}${img.slug}" data-lightbox="${doc.title }" data-title="${img.name }">
                        <img  src="${IMGPATH}${img.slug}" class="img-thumbnail" alt="${img.alt}" max-height="250">
                        <i class="zmdi zmdi-aspect-ratio-alt zmdi-hc-3x mdc-text-light-blue"></i>
                      </a>
                    </div>
                  </div>
                `);
             });
             viewDocumentModal.find('#docImages').hide().html(imgsHtml).fadeIn(2000);
            });

            /*Email Document */
            viewDocumentModal.find('#emailDocument').on('click', function () {
              var emailDocumentModal = $('#emailDocumentModal');
              emailDocumentModal.modal('show');
              viewDocumentModal.modal('hide');

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
                setTimeout(emailDocumentModal.modal('hide'),1500);
                axios.post('/document/'+id+'/email', email)
                  .then(function (res) {
                    swal({
                       title: 'Message Sent',
                       type: 'success',
                       text: 'Email successfully sent',
                       timer: 3500,
                       showConfirmButton: true
                    });
                    $('button[type="submit"]').removeAttr('disabled');
                  })
                  .catch(function (err) {//Listen For any possible error
                        console.log('Email Error',err);
                        swal({
                            title: 'Message Not Delivered',
                            type: 'error',
                            text: 'Email was not sent successfully',
                            timer: 3500,
                            showConfirmButton: true
                        }); 
                        $('button[type="submit"]').removeAttr('disabled');

                  });
                  
              });
            })
            /*End Email Document */
        });
        /* END SINGLE INSTANCE READ */
        /* END CRUD (READ) FUNTIONS*/

        /*CRUD (UPDATE)*/
        $(document).on('click','.sa-edit',function(e){
            var editDocumentModal = $('#editDocumentModal');
            editDocumentModal.modal('show');
            var row = $(this).parents('tr');
            var id = row.data('id');
            var doc;
            $.getJSON( "/document/"+id, function( res ) {
              doc = res.data;
              $('#updateDocument').attr('action','/document/'+doc.id)
              var imgsHtml = [];
              //Select The Modal 
             var editDocumentModal = $('#editDocumentModal');
             editDocumentModal.find('input[name=ref]').val(doc.ref);
             editDocumentModal.find('input[name=title]').val(doc.title);
             editDocumentModal.find('textarea[name=desc]').val(doc.desc);
             editDocumentModal.find('select[name=type]').val(doc.type);
             //editDocumentModal.find('input[name=user_id]').val(doc.user.name);
             editDocumentModal.find('select[name=folder_id]').val(doc.folder_id);
             editDocumentModal.find('select[name=organization_id]').val(doc.organization_id);
             editDocumentModal.find('input[name=written_on]').val(moment(doc.written_on).format('DD/MM/YYYY'));
             editDocumentModal.find('input[name=signed_on]').val(moment(doc.signed_on).format('DD/MM/YYYY'));
             var imgsHtml;
              $.each(doc.files, function(key, img) {
               imgsHtml.push(`
                  <div class="col-md-4 single-img "  >
                    <div class="img-preview">
                      <span data-img=${img.id}>  
                        <img  src="${IMGPATH}${img.slug}" class="img-thumbnail" alt="${img.alt}" max-height="250">
                        <i class="zmdi zmdi-delete zmdi-hc-3x mdc-text-red-700"></i>
                      </span>
                    </div>
                  </div>
                `);
             });
             editDocumentModal.find('#editDocImages').hide().html(imgsHtml).fadeIn(2000);

             /*emailDocumentModal.find('#updateDocument').submit(function (e) {
               //e.preventDefault;
               $(this).find('button[type=submit]').attr('disabled','disabled');


             })*/

            });

            // Delete Sinle Image 
            $(document).on('click','.single-img .zmdi-delete',function(e){
              var imgSpan = $(this).parent()
              var img = $(imgSpan).data('img');
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
                  axios.delete('/file/'+img).then(function(res){
                    $(imgSpan).hide('slow');
                  })
                  .catch(function(err) {
                    console.log(err);
                    swal({
                      title: "Error!",
                      text: "Unable to delete file",
                      timer: 4500,
                      type: 'error',
                      showConfirmButton: true
                    }); 
                    setTimeout(window.location.reload(), 4500);
                  });
               });
              

            });


        });

        /* CRUD (DELETE) */
        $(document).on('click','.sa-delete',function(e){
          var row = $(this).parents('tr');
          datas = table.row(row).data();
          var id = row.data('id');
          var ref = datas[0] //$(this).data('ref') // Extract info from data-* attributes
          var title = datas[1]// $(this).data('title') // Extract info from data-* attributes
          swal({   
               title: "Are you sure?",   
               text: "You are about to delete  "+title+"!",   
               type: "warning",   
               showCancelButton: true,   
               confirmButtonColor: "red",   
               confirmButtonText: "Yes, delete it!",   
               closeOnConfirm: true,
               //showLoaderOnConfirm: true,
           }, function(){ 
               axios.delete('/document/'+id)
                 .then(function (res) {
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
                 })
                 .catch(function (err) {
                    console.log(err);
                    swal({
                      title: "Error!",
                      text: name +" could not be DELETED",
                      timer: 4500,
                      type: 'error',
                      showConfirmButton: true
                    }); 
                    setTimeout(window.location.reload(), 4500);
                 }); 
           });

          return false;
        });
        /* END CRUD (DELETE) */

        /* CRUD (RESTORE) */
        $(document).on('click','.sa-restore',function(e){
          var row = $(this).parents('tr');
          datas = table.row(row).data();
          var id = row.data('id');
          var ref = datas[0] //$(this).data('ref') // Extract info from data-* attributes
          var title = datas[1]// $(this).data('title') // Extract info from data-* attributes
          swal({   
               title: "Are you sure?",   
               text: "Do you want to restore"+title+"!",   
               type: "info",   
               showCancelButton: true,   
               confirmButtonColor: "#05AF4B",   
               confirmButtonText: "Yes, restore it!",   
               closeOnConfirm: true,
               //showLoaderOnConfirm: true,
           }, function(){ 
               axios.get('/trash/document/'+id+'/restore')
                 .then(function (res) {
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
                 })
                 .catch(function (err) {
                    console.log(err);
                    swal({
                      title: "Error!",
                      text: name +" Documet could not be restored",
                      timer: 4500,
                      type: 'error',
                      showConfirmButton: true
                    }); 
                    setTimeout(window.location.reload(), 4500);
                 }); 
           });

          return false;
        });
        /* END CRUD (RESTORE) */


        /*Fliter Datatable*/

        var dataTableFilters = $('#dataTableFilters');
        

        //Filter base on Document Organization
        dataTableFilters.find('#organization').change( function () {
            $('tfoot #organizations')
              .val(this.value)
              .keyup();;
        });

        //Filter base on Document Owner
        dataTableFilters.find('#user').change( function () {
            $('tfoot #users')
              .val(this.value)
              .keyup();;
        });

        //Filter base on Document Folder
        dataTableFilters.find('#folder').change( function () {
            $('tfoot #folders')
              .val(this.value)
              .keyup();;
        });

        //Filter base on Document Type Incoming or Outgoing
        dataTableFilters.find('#type').change( function () {
            $('tfoot #types')
              .val(this.value)
              .keyup();;
        });

        //Reset Fliter
        dataTableFilters.find('#resetFilters').click( function () {
            $('tfoot input').val('').keyup();
        });
        
        
        //Filter base on Document Folder
        // dataTableFilters.find('#organization').change( function () {
        //     var organization = this.value;

        //     var filteredData = table
        //         .column( 2 )
        //         .data()
        //         .filter( function ( value, index ) {
        //             return value == organization ? true : false;
        //         } );
        // });

        //Filter base on Document Organization
        // dataTableFilters.find('#organization').change( function () {
        //     var organization = this.value;
        //     table
        //         .column( 2 )
        //         .search( this.value )
        //         .draw();
        // });
    }else{
      /* CRUD (Add Organization) */
      $('#addOrgranization').submit(function(event) {
        //Prevent the Form from submitting
        event.preventDefault();
        var form = $(this);
        removeFormErrors(form);
        $('input[type="submit"]').attr('disabled','disabled');
        //Fetching the Form datas
        var organization = {

          _token: form.find('input[name=_token]').val(),
          name: form.find('input[name=name]').val(),
          email: form.find('input[name=email]').val(),
          location: form.find('input[name=location]').val(),
          country: form.find('input[name=country]').val()
        };

        //Submitting the form data using axios
        
       $.ajax({
           type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
           url         : '/organization', // the url where we want to POST
           data        : organization, // our data object
           
       })
       .done(function(response) {
        addOption('organization_id', response.organization.name, response.organization.id);
        form[0].reset(); //Reset the form
        $('#addOrganizationModal').modal('hide');
         swal({
              title:response.message.title.toUpperCase(),
              text: response.message.desc,
              timer: 1500,
              showConfirmButton: true
            });   

       })
       // here we will handle errors and validation messages
       .fail(function(err){
          console.log(err);
          if(err.status ===422){
            var errors = err.responseJSON;
            $.map(errors ,function(error, value){
              addErrorClass('#addOrgranization',value,error);
            }) 
          }else{
            setTimeout(window.location.reload(), 4500)
          }

        })
       //Reset all form input and reenable submit
       .always(function() {
           $('input[type="submit"]').removeAttr('disabled');
         });
       
      });
      
      /* END CRUD (Add Organization) */

      /* CRUD (Add Folder) */
      $('#addFolder').submit(function(event) {
        //Prevent the Form from submitting
        event.preventDefault();
        var form = $(this);
        removeFormErrors(form);
        $('input[type="submit"]').attr('disabled','disabled');
        //Fetching the Form datas
        var folder = {

          _token: form.find('input[name=_token]').val(),
          name: form.find('input[name=name]').val(),
          ref: form.find('input[name=ref]').val(),
          desc: form.find('input[name=desc]').val(),
        };

        //Submitting the form data using axios
        
       $.ajax({
           type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
           url         : '/folder', // the url where we want to POST
           data        : folder, // our data object
           
       })
       .done(function(response) {
        console.log(response);
        addOption('folder_id', response.folder.name, response.folder.id);
        form[0].reset(); //Reset the form
        $('#addFolderModal').modal('hide');   
         swal({
              title:response.message.title.toUpperCase(),
              text: response.message.desc,
              timer: 1500,
              showConfirmButton: true
            });
       })
       // here we will handle errors and validation messages
       .fail(function(err){
          console.log(err);
          if(err.status ===422){
            var errors = err.responseJSON;
            $.map(errors ,function(error, value){
              addErrorClass('#addFolder',value,error);
            }) 
          }else{
            setTimeout(window.location.reload(), 4500)
          }

        })
       //Reset all form input and reenable submit
       .always(function() {
           $('input[type="submit"]').removeAttr('disabled');
         });
       
      });
      
      /* END CRUD (Add Folder) */
    }

});


function addErrorClass(ref,inputId, error=''){
  var parent = $(ref +' #'+inputId).parent( ".form-group" );
  parent.addClass('has-error');
  parent.append('<span class ="help-block">'+ error+'</span>');

}
//Remove Any Existig Error 
function removeFormErrors(form){
  form.find('.form-group').removeClass('has-error');
  form.find('.help-block').remove();
}
/* END HELPER FUNTIONS*/

function addOption(id, name, value) {
  var select = document.getElementById(id);
  if (select) {
    var options = select.options;
    var option = new Option(name, value);

    try{
      select.add(option, options[0]);
    }catch (err){
      select.add(option,0);
    }
    select.options[0].selected=true;
  }
 
}