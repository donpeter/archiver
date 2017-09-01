$(function(){
  /*CRUD (READ) FUNTIONS*/ 
  //Fetch All Organization data
  
    

  // Setup - add a text input to each footer cell
    $('#organizations tfoot th').each( function () {
        var title = $(this).text().trim();
        if(title !== 'Action'){
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

  /* CRUD (CREATE) */
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
      email: form.find('#email').val(),
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
    addNewRow(table, response.organization); //Add the newly created row to the Dataable
    form[0].reset(); //Reset the form
     swal({
          title:response.message.title,
          text: response.message.desc,
          timer: 3500,
          showConfirmButton: true
        });   
   })
   // here we will handle errors and validation messages
   .fail(function(err){
      console.log(err);
      if(err.status ===422){
        var errors = err.responseJSON;
        $.map(errors ,function(error, value){
          addErrorClass(value,error);
         // console.log(value+' , '); 
         // console.log(error); 

        }) 
      }else{
        setTimeout(window.location.reload(), 4500)
      }

    })
   //Reset all form input and reenable submit
   .always(function() {
       $('input[type="submit"]').removeAttr('disabled');
       form.find('#name').focus();
     });
   
  });
  
  /* END CRUD (CREATE) */

  /* CRUD (UPDATE) */
  if( $('#editModal').length > 0 ){
    $('#organizations tbody').on( 'click', 'i.zmdi-edit', function () {
     row = table.row( $(this).parents('tr') );    
      $('#editModal').on('show.bs.modal', function (event) {
        var edit = $(event.relatedTarget) // edit that triggered the modal
        var id = edit.data('id') // Extract info from data-* attributes
        var name = edit.data('name') // Extract info from data-* attributes
        var email = edit.data('email') // Extract info from data-* attributes
        var location = edit.data('location') // Extract info from data-* attributes
        var country = edit.data('country') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('Edit ' + name)
        modal.attr('current', id);
        console.log('ID: ',modal.attr('current') )
        modal.find('.modal-body #name').val(name)
        modal.find('.modal-body #email').val(email)
        modal.find('.modal-body #location').val(location)
        modal.find('.modal-body #country').val(country)
      })
      .submit(function(eventObj) {
        eventObj.preventDefault(); //prevent form from submitting
        eventObj.stopPropagation();
        console.log('updated');
        var modal = $('#editModal');
        modal.find("input[type=submit]").attr('disabled','disabled'); //Disable Mutiple Submittions

        var _token = modal.find('.modal-body input[name=_token]').val();
        var _method = modal.find('.modal-body input[name=_method]').val();
        var id = modal.attr('current') // Extract info from data-* attributes
        var name = modal.find('.modal-body #name').val();
        var email =  modal.find('.modal-body #email').val();
        var location = modal.find('.modal-body #location').val();
        var country = modal.find('.modal-body #country').val();
        var organization = {
                    _token: _token,
                    _method : _method,
                    name: name,
                    email : email,
                    location : location,
                    country : country
                  };
        //Send Update Request for the organization 
        console.log('Organization', organization);
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : '/organization/'+id, // the url where we want to POST
            data        : organization, // our data object
            
        })
        .done(function (res) {
           // console.log(res);
            row.remove().draw(); //Remove the Row from the dom
            addNewRow(table,res.data)
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
        })
        .always(function() {
          $("input[type=submit]").removeAttr('disabled'); //Disable Mutiple Submittions
        })
      });
    });
  }
  /* END CRID (UPDATE) */

  /* CRUD (DELETE) */

  $(document).on('click','#sa-warning,.sa-warning',function(e){
    var row = $(this).parents('tr');
    var id = $(this).data('id') // Extract info from data-* attributes
    var name = $(this).data('name') // Extract info from data-* attributes
    swal({   
          title: "Are you sure?",   
          text: "You will not be able to recover "+name+"!",   
          type: "warning",   
          showCancelButton: true,   
          confirmButtonColor: "red",   
          confirmButtonText: "Yes, delete it!",   
          closeOnConfirm: true,
          //showLoaderOnConfirm: true,
      }, function(){ 
          axios.delete('/organization/'+id)
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
                 text: name +" Archive Could Not Be Deleted",
                 timer: 4500,
                 type: 'error',
                 showConfirmButton: true
               }); 
               //setTimeout(window.location.reload(), 4500)
            });
          
      });

  return false;
  });

  /* END CRUD (DELETE) */


  /*HELPER FUNTIONS*/

  //Add adds a new Row
  function addNewRow(table, organization){
    var actionHtml = `
          <a href="javascript:void(0)" class="text-inverse pr-5" data-toggle="tooltip" title="View">
          <i class="zmdi zmdi-eye txt-success"></i>
          </a>
          <a href="javascript:void(0)" class="text-inverse pr-5" title="Edit" data-target="#editModal" data-toggle="modal"
           data-id="${organization.id}"
           data-name="${organization.name}" 
           data-email="${organization.email}"
           data-location="${organization.location}" 
           data-country="${organization.country}"
           >
          <i class="zmdi zmdi-edit txt-warning"></i>
          </a>`
    if(canDelete(organization,['staff']) ){
      actionHtml += `
      <a href="javascript:void(0)" class="text-inverse sa-warning" data-id="${organization.id}" data-name="${organization.name}" data-toggle="tooltip" title="Delete">
        <i class="zmdi zmdi-delete txt-danger"></i>
      </a>`;
    }
          
    var rowNode = table.row.add( [ 
         organization.name, 
         organization.email, 
         organization.location,
         organization.country,
         actionHtml
         ] )
        .draw()
        .node();
     
    $( rowNode )
        .css( 'color', 'green' )
        .animate( { color: 'white' } );
  }
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



