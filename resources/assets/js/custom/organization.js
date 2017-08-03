$(function(){
  /*CRUD (READ) FUNTIONS*/ 
  //Fetch All Organization data
  var organizations = $.get( "/organization")
    .done(function(response) {
      console.log(response);
    })
    .fail(function(error) {
      console.log( error );
    })
    

  // Setup - add a text input to each footer cell
    $('#organizations tfoot th').each( function () {
        var title = $(this).text().trim();
        if(title !== 'Action'){
          console.log(title);
          var className = 'search-filter';
          $(this).html( '<input type="text" class="form-control '+className+'return "  placeholder="Search  '+title+'" />' );
        }
        
    } );
 
    // DataTable
     table = $('#organizations').DataTable({
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

  /* END CRUD (READ) FUNTIONS*/

  /* CRUD (CREATE) FUNTIONS*/
  $('#addOrgranization').submit(function(event) {
    //Prevent the Form from submitting
    event.preventDefault();
    var form = $(this);
    removeFormErrors(form);
    $('input[type="submit"]').attr('disabled','disabled');
    //Fetching the Form datas
    var organization = {

      _token: form.find('input[name=_token]').val(),
      name: form.find('#name').val(),
      desc: form.find('#desc').val(),
      archive_id: form.find('#archive_id').val(),
      archive: form.find('#archive_id option:selected').text(),
      license: form.find('#license').val(),
      location: form.find('#location').val(),
      country: form.find('#country').val()
    };

    //Submitting the form data using axios
    
   $.ajax({
       type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
       url         : '/organization', // the url where we want to POST
       data        : organization, // our data object
       
   })
   // using the done promise callback
   .done(function(response) {

       // log data to the console so we can see
       console.log(response); 
       var rowNode = table
           .row.add( [ 
            organization.name, 
            organization.archive, 
            organization.location,
            organization.country,
            `<a href="javascript:void(0)" class="text-inverse pr-5" title="edit" data-target="#viewModal" data-toggle="modal" data-original-title="View" data-name="organization.name" data-desc="organization->desc">
                <i class="zmdi zmdi-eye txt-success"></i>
                </a>
                <a href="javascript:void(0)" class="text-inverse pr-5" title="edit" data-target="#editModal" data-toggle="modal" data-original-title="Edit" data-name="${organization.name}" data-desc="${organization.desc}">
                <i class="zmdi zmdi-edit txt-warning"></i>
                </a>
                <a href="javascript:void(0)" class="text-inverse sa-warning" title="" data-name="${organization.name}" data-toggle="tooltip" data-original-title="Delete">
                <i class="zmdi zmdi-delete txt-danger"></i>
                </a>`
            ] )
           .draw()
           .node();
        
       $( rowNode )
           .css( 'color', 'green' )
           .animate( { color: 'white' } );
       form.each(function(){
           this.reset();
       }); 
       swal({
            title:response.message.title,
            text: response.message.desc,
            timer: 3500,
            showConfirmButton: true
          });   
   })
   // here we will handle errors and validation messages
   .fail(function(data){
      if(data.status ===422){
        var errors = data.responseJSON;
        $.map(errors ,function(error, value){
          addErrorClass(value,error);
          console.log(value+' , '); 
          console.log(error); 

        })
        console.log(errors); 
      }
    })
   //Reset all form input and reenable submit
   .always(function() {
       $('input[type="submit"]').removeAttr('disabled');
       form.find('#name').focus();
     });
   
  });
  
  /* END CRUD (CREATE) FUNTIONS*/

  /*CRUD (UPDATE)*/
  if( $('#editModal').length > 0 ){
    $('#organizations tbody').on( 'click', 'i.zmdi-edit', function () {
       row = table.row( $(this).parents('tr') );
       rowNode = row.node();
    } );
    $('#editModal').on('show.bs.modal', function (event) {
      var edit = $(event.relatedTarget) // edit that triggered the modal
      var id = edit.data('id') // Extract info from data-* attributes
      var name = edit.data('name') // Extract info from data-* attributes
      var desc = edit.data('desc') // Extract info from data-* attributes
      var archive = edit.data('archive') // Extract info from data-* attributes
      var license = edit.data('license') // Extract info from data-* attributes
      var location = edit.data('location') // Extract info from data-* attributes
      var country = edit.data('country') // Extract info from data-* attributes
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this)
      modal.find('.modal-title').text('Edit ' + name)
      modal.find('.modal-body #id').val(id)
      modal.find('.modal-body #name').val(name)
      modal.find('.modal-body #desc').val(desc)
      modal.find('.modal-body #archive_id').val(archive)
      modal.find('.modal-body #license').val(license)
      modal.find('.modal-body #location').val(location)
      modal.find('.modal-body #country').val(country)
      console.log('You Selected' +id)
    })
    .submit(function(eventObj) {
      eventObj.preventDefault(); //prevent form from submitting
      var modal = $('#editModal');
      var _token = modal.find('.modal-body input[name=_token]').val();
      var _method = modal.find('.modal-body input[name=_method]').val();
      var id = modal.find('.modal-body #id').val();
      var ref=  modal.find('.modal-body #ref').val();
      var name = modal.find('.modal-body #name').val();
      var desc =  modal.find('.modal-body #desc').val();
      var archive = modal.find('.modal-body #archive_id').val();
      var license = modal.find('.modal-body #license').val();
      var location = modal.find('.modal-body #location').val();
      var country = modal.find('.modal-body #country').val();
      var organization = {
                  _token: _token,
                  _method : _method,
                  name: name,
                  desc : desc,
                  archive_id : archive,
                  license : license,
                  location : location,
                  country : country
                };
      //Send Update Request for the organization 
      $.ajax({
          type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
          url         : '/organization/'+id, // the url where we want to POST
          data        : organization, // our data object
          
      })
      .done(function (res) {
          console.log(res);
          message = res.message;
          $('#editModal').modal('hide');
          swal({
            title: message.title,
            text: message.desc,
            timer: 2500,
            showConfirmButton: true
          });
          
        })
      .fail(function (err) {
       swal({
          title: "Error!",
          text: "Organization could not be updated",
          timer: 3500,
          type: 'error',
          showConfirmButton: true
        });
        console.log(err);
        setTimeout(window.location.reload(), 4500)
      });
    });
  }
  /*END CRID (UPDATE)*/


  /*HELPER FUNTIONS*/
  function addErrorClass(inputId, error=''){
    var parent = $('#'+inputId).parent( ".form-group" );
    parent.addClass('has-error');
    parent.append('<span class ="help-block">'+ error+'</span>');

  }
  //Remove Any Existig Error 
  function removeFormErrors(form){
    form.find('.form-group').removeClass('has-error');
    form.find('.help-block').remove();
  }
  /* END HELPER FUNTIONS*/
});