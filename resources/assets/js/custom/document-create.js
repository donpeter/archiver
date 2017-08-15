$(function(){
  var newDocument = $('#addDocument');
  if (newDocument.length) {
    $("#files").fileinput();

    newDocument.submit(function( event ) {
      $('[type=submit]').attr('disabled','disabled');
    });
  }

      $('#flash-overlay-modal').modal();
  
  $('.datetimepicker').datetimepicker({
      locale: document.documentElement.lang,
      format: 'DD/MM/YYYY'
  });
  if($(".select2").length){
    $(".select2").select2();
  }

   
   $.get('/documents', function(res){
      var documents = res.data;
      documents.forEach(function(item) {
        item.prepaired_on = moment(item.prepaired_on).format('DD-MM-YYYY');
      });
      // $('#documents').DataTable( {
      //      "processing": true,
      //      "serverSide": false,
      //      "data": res.data,
      //      "columns": [
      //          { "data": "ref" },
      //          { "data": "title" },
      //          { "data": "sender" },
      //          { "data": "receiver" },
      //          { "data": "prepaired_on" },
      //          {
      //          "targets": 1,
      //          "data": null,
      //          "defaultContent": `
      //              <a href="javascript:void(0)" class="text-inverse pr-5" title="view" data-target="tooltip" data-toggle="tooltip" data-original-title="View"

      //                >
      //              <i class="zmdi zmdi-eye txt-success"></i>
      //              </a>
      //              <a href="javascript:void(0)" class="text-inverse pr-5" title="edit" data-target="tooltip" data-toggle="tooltip" data-original-title="Edit" >
      //              <i class="zmdi zmdi-edit txt-warning"></i>
      //              </a>
      //              <a href="javascript:void(0)" class="text-inverse sa-warning" data-toggle="tooltip" data-original-title="Delete">
      //              <i class="zmdi zmdi-delete txt-danger"></i>
      //              </a>
      //          `

      //      }
      //      ], 
      //      "dom": 'Bfrtip',
      //      "buttons": [
      //          'copy', 'csv', 'excel', 'pdf', 'print'
      //      ],
      //  } );
   });

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

    /* SINGLE INSTANCE READ*/
    $(document).on('click','.sa-view',function(e){
        $('#viewDocument').modal('show');
    });
    /* END SINGLE INSTANCE READ */
   /* END CRUD (READ) FUNTIONS*/
   /* CRUD (DELETE) */

   $(document).on('click','#sa-warning,.sa-warning',function(e){
     datas = table.row($(this).parents('tr')).data();
     var row = $(this).parents('tr');
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

   /* END CRUD (DELETE) */
});