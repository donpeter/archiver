$(document).ready(function() {
 
    // DataTable 
     table = $('#folders').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ],
                    pageLength: 6,
                });
     var folder_id;
  //Edit
  if( $('#editModal').length > 0 ){
    $('#editModal').on('show.bs.modal', function (event) {
      var edit = $(event.relatedTarget) // edit that triggered the modal
      folder_id = edit.data('id'); // Extract info from data-* attributes
      var ref = edit.data('ref'); // Extract info from data-* attributes
      console.log('folder_d', edit);
      var name = edit.data('name'); // Extract info from data-* attributes
      var desc = edit.data('desc'); // Extract info from data-* attributes
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this);
      // modal.find('.modal-title').text('New message to ' + recipient)
      modal.find('.modal-body #ref').val(ref);
      modal.find('.modal-body #name').val(name);
      modal.find('.modal-body #desc').val(desc);
    })
    .submit(function(eventObj) {
      eventObj.preventDefault(); //prevent form from submitting
      $('button[type="submit"]').attr('disabled','disabled');

      var modal = $('#editModal');
      var ref=  modal.find('.modal-body #ref').val();
      var name = modal.find('.modal-body #name').val();
      var desc =  modal.find('.modal-body #desc').val();
      var _token =  modal.find('.modal-body input[name=_token]').val();
      var data = {
                  _token: _token,
                  ref:ref,
                  name: name,
                  desc : desc
                };
      //Update The folder
      axios.patch('/folder/'+folder_id,data)
            .then(function (res) {
                console.log(res.data);
                $('button[type="submit"]').removeAttr('disabled');
                $('#editModal').modal('hide');
                swal({
                  title: "Updated!",
                  text: "Folder has been successfully updated",
                  timer: 2500,
                  showConfirmButton: true
                });
                //Refresh Page after Edit
                setTimeout(function() {
                    location.reload();
                }, 3000)
                
              })
              .catch(function (err) {
                $('button[type="submit"]').removeAttr('disabled');
               swal({
                  title: "Error!",
                  text: "Folder could not be updated",
                  timer: 2500,
                  type: 'error',
                  showConfirmButton: true
                });
               console.log(err);
            });
    });
  }

  //Deleting an  folder
  $('#sa-warning,.sa-warning').on('click',function(e){
    var row = $(this).parents('tr');
    var id = $(this).data('id') // Extract info from data-* attributes
    var name = $(this).data('name') // Extract info from data-* attributes
    swal({   
          title: "Are you sure?",   
          text: "You will not be able to recover "+name+"!",   
          type: "warning",   
          showCancelButton: true,   
          confirmButtonColor: "#fec107",   
          confirmButtonText: "Yes, delete it!",   
          closeOnConfirm: true,
          //showLoaderOnConfirm: true,
      }, function(){ 
          axios.delete('/folder/'+id)
                .then(function (res) {
                  swal({
                  title: res.data.title,
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
                     text: name +" folder could not be deleted",
                     timer: 4500,
                     type: 'error',
                     showConfirmButton: true
                   }); 
                   console.log(err);
                });
          
      });

  return false;
  });
});