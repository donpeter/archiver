
$(function(){
  /*CRUD (READ) FUNTIONS*/ 
  //Fetch All user data
  
    

  // Setup - add a text input to each footer cell
    $('#users tfoot th').each( function () {
        var title = $(this).text().trim();
        if(title !== 'Action'){
          var className = 'search-filter';
          $(this).html( '<input type="text" class="form-control '+className+'return "  placeholder="Search  '+title+'" />' );
        }
        
    } );
 
    // DataTable
     table = $('#users').DataTable();
 
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
  $('#addUser').submit(function(event) {
    //Prevent the Form from submitting
    event.preventDefault();
    var form = $(this);
    removeFormErrors(form);
    $('input[type="submit"]').attr('disabled','disabled');
    //Fetching the Form datas
    var user = {

      _token: form.find('input[name=_token]').val(),
      name: form.find('#name').val(),
      email: form.find('#email').val(),
      username: form.find('#username').val(),
      password: form.find('#password').val(),
      password_confirmation: form.find('#password_confirmation').val(),
      role: form.find('#role').val()
    };
    console.log('New User' ,user);
    //Submitting the form data using axios
    
   $.ajax({
       type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
       url         : '/user', // the url where we want to POST
       data        : user, // our data object
       
   })
   // using the done promise callback
   .done(function(response) {
    console.log(response);
    addNewRow(table, response.user); //Add the newly created row to the Dataable
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
    $('#users tbody').on( 'click', 'i.zmdi-edit', function () {
     row = table.row( $(this).parents('tr') );    
      $('#editModal').on('show.bs.modal', function (event) {
        var data = row.data(); //Extract Row dats @ret Array
        var edit = $(event.relatedTarget) // edit that triggered the modal
        var id = edit.data('id') // Extract info from data-* attributes
        var name = data[0];
        var role = data[3];
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('Edit ' + name)
        modal.find('form')[0].reset();
        modal.attr('current', id);

        // Fill The Edit Form With Users Information
        modal.find('.modal-body #name').val(name)
        modal.find('.modal-body #role').val(role)
      })
      .submit(function(eventObj) {
        eventObj.preventDefault(); //prevent form from submitting
        console.log('updated');
        var modal = $('#editModal');
        modal.find("input[type=submit]").attr('disabled','disabled'); //Disable Mutiple Submittions

        var _token = modal.find('.modal-body input[name=_token]').val();
        var _method = modal.find('.modal-body input[name=_method]').val();
        var id = modal.attr('current') // Extract info from data-* attributes
        var name = modal.find('.modal-body #name').val();
        var email =  modal.find('.modal-body #email').val();
        var password =  modal.find('.modal-body #password').val();
        var password_confirmation = modal.find('.modal-body #password_confirmation').val();
        var role = modal.find('.modal-body #role').val();
        var user = {
                    _token: _token,
                    _method : _method,
                    name: name,
                    email : email,
                    password : password,
                    password_confirmation : password_confirmation,
                    role : role
                  };

        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : '/user/'+id, // the url where we want to POST
            data        : user, // our data object
            
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
            text: "User could not be updated",
            timer: 3500,
            type: 'error',
            showConfirmButton: true
          });
          console.log('User Error:' ,err);
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

  $(document).on('click','.sa-delete',function(e){
    //var row = $(this).parents('tr');
    var row = table.row( $(this).parents('tr') );    
    var id = $(this).data('id'); // Extract info from data-* attributes
    var name = row.data()[0]; // Extract info from data-* attributes
    swal({   
          title: "Are you sure?",   
          text: "Do you want to move "+name+" to Trash!",   
          type: "warning",   
          showCancelButton: true,   
          confirmButtonColor: "red",   
          confirmButtonText: "Yes, trash user!",   
          closeOnConfirm: true,
          //showLoaderOnConfirm: true,
      }, function(){ 
          axios.delete('/user/'+id)
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

  /* END CRUD (DELETE) */

  /* CRUD (RESTORE) */

  $(document).on('click','.sa-restore',function(e){
    e.preventDefault();
    //var row = $(this).parents('tr');
    var row = table.row( $(this).parents('tr') );    
    var id = $(this).data('id'); // Extract info from data-* attributes
    var name = row.data()[0]; // Extract info from data-* attributes
    swal({   
          title: "Are you sure?",   
          text: "You're about to restore "+name+"!",   
          type: "info",   
          showCancelButton: true,   
          confirmButtonColor: "green",   
          confirmButtonText: "Yes, restore user!",   
          closeOnConfirm: true,
          //showLoaderOnConfirm: true,
      }, function(){ 
          $.get('/trash/user/'+id+'/restore')
            .done(function (res) {
              console.log(res);
              swal({
                title: res.title,
                type: 'success',
                text: res.message,
                timer: 1800,
                showConfirmButton: true
              }); 
              table.row( row )
                .remove()
                .draw();
            })
            .fail(function (err) {
               swal({
                 title: "Error!",
                 text: name +" User could not be restored",
                 timer: 1800,
                 type: 'error',
                 showConfirmButton: true
               }); 
               setTimeout(window.location.reload(), 1900)
            });
          
      });

  return false;
  });

  /* END CRUD (RESTORE) */

  /*HELPER FUNTIONS*/

  //Add adds a new Row
  function addNewRow(table, user){
    var rowNode = table
        .row.add( [ 
         user.name, 
         user.email, 
         user.username,
         user.role,
         `<a href="/user/${user.id}/documents" class="text-inverse pr-5" data-toggle="tooltip" title="View">
             <i class="zmdi zmdi-eye txt-success"></i>
             </a>
             <a href="javascript:void(0)" class="text-inverse pr-5" title="Edit" data-target="#editModal" data-toggle="modal" data-id="${user.id}" >
             <i class="zmdi zmdi-edit txt-warning"></i>
             </a>
             <a href="javascript:void(0)" class="text-inverse sa-warning" data-id="${user.id}" data-toggle="tooltip" title="Delete">
             <i class="zmdi zmdi-delete txt-danger"></i>
             </a>`
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