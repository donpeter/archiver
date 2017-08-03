$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#archives tfoot th').each( function () {
        var title = $(this).text();
        if(title != 'Action')
        var className = 'search-filter';
        $(this).html( '<input type="text" class="form-control '+className+'return "  placeholder="Search  '+title+'" />' );
    } );
 
    // DataTable
     table = $('#archives').DataTable({
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
  //Edit
  if( $('#editModal').length > 0 ){
    $('#editModal').on('show.bs.modal', function (event) {
      var edit = $(event.relatedTarget) // edit that triggered the modal
      var ref = edit.data('ref') // Extract info from data-* attributes
      var name = edit.data('name') // Extract info from data-* attributes
      var desc = edit.data('desc') // Extract info from data-* attributes
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this)
      // modal.find('.modal-title').text('New message to ' + recipient)
      modal.find('.modal-body #ref').val(ref)
      modal.find('.modal-body #name').val(name)
      modal.find('.modal-body #desc').val(desc)
    })
    .submit(function(eventObj) {
      eventObj.preventDefault(); //prevent form from submitting
      var modal = $('#editModal');
      var ref=  modal.find('.modal-body #ref').val();
      var name = modal.find('.modal-body #name').val();
      var desc =  modal.find('.modal-body #desc').val();
      var data = {
                  ref:ref,
                  name: name,
                  desc : desc
                };
      //Update The Archive
      axios.patch('/archive/'+ref,data)
            .then(function (res) {
                console.log(res.data);
                $('#editModal').modal('hide');
                swal({
                  title: "Updated!",
                  text: "Archive has been successfully updated",
                  timer: 2500,
                  showConfirmButton: true
                });
                //Refresh Page after Edit
                setTimeout(function() {
                    location.reload();
                }, 3000)
                
              })
              .catch(function (err) {
               swal({
                  title: "Error!",
                  text: "Archive could not be updated",
                  timer: 2500,
                  type: 'error',
                  showConfirmButton: true
                });
               console.log(err);
            });
    });
  }

  //Deleting an  Archive
  $('#sa-warning,.sa-warning').on('click',function(e){
    var row = $(this).parents('tr');
    var ref = $(this).data('ref') // Extract info from data-* attributes
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
          axios.delete('/archive/'+ref)
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
                     text: name +" Archive could not be deleted",
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