<template>
  <div>
    <table id="organizations" class="table table-hover display mb-30 dataTable no-footer" style="cursor: pointer;" role="grid">
      <thead>
        <tr role="row">
          <th class="sorting">
            Ref
          </th>
          <th class="sorting" >
            Title
          </th>
          <th class="sorting" >
            Sender
          </th>
          <th class="sorting">
            reciver
          </th>
          <th class="sorting" style="width: 10%;">
            Action
          </th>
        </tr>
      </thead>
      <tfoot>
        <tr role="row">
          <th class="sorting">
            Ref
          </th>
          <th class="sorting" >
            Title
          </th>
          <th class="sorting" >
            Sender
          </th>
          <th class="sorting">
            reciver
          </th>
          <th class="sorting" style="width: 10%;">
            Action
          </th>
        </tr>
          
      </tfoot>
      <tbody>
        <tr role="row" 
            v-for="document in documents"  
            :key="document.id" 
            :document="document"
            @document-delete="onDelete"
             class="odd">
          <td tabindex="1" class="sorting_1">{{document.ref}}</td>
          <td tabindex="1">{{document.title}}</td>
          <td tabindex="1">{{document.sender}} </td>
          <td tabindex="1">{{document.receiver}}</td>
          <td tabindex="1">
            <a href="javascript:void(0)" class="text-inverse pr-5" title="view" data-target="tooltip" data-toggle="tooltip" data-original-title="View" @click="onView(document)"  >
            <i class="zmdi zmdi-eye txt-success"></i>
            </a>
            <a href="javascript:void(0)" class="text-inverse pr-5" title="edit" data-target="tooltip" data-toggle="tooltip" data-original-title="Edit" @click="onEdit(document)" >
            <i class="zmdi zmdi-edit txt-warning"></i>
            </a>
            <a href="javascript:void(0)" class="text-inverse sa-warning" data-toggle="tooltip" data-original-title="Delete" @click="onDelete">
            <i class="zmdi zmdi-delete txt-danger"></i>
            </a>
          </td>
        </tr>
      </tbody>
    </table>
    <document-view v-if="viewing" @close-modal="onCloseModal" :document="viewDocument"></document-view>
  </div>
</template>

<script>
  require('./../custom/datatable/datatable.min')

    export default {
        data() {
          return {
                documents:  [],
                viewDocument: {},
                viewing: false
            }
        },
        mounted() {
          axios.get( "/document")
            .then(function(res) {
                this.documents = res.data;
                console.log('Fetching: ', res.data);
              }.bind(this));
          console.log('Documents Component mounted. ',this.myDocuments);
            $('#organizations').DataTable({
              "columns": [
                         { "data": this.documents.name },
                         { "data": this.documents.title },
                         { "data": this.documents.sender },
                         { "data": this.documents.reciver },
                         { "data": this.documents.created_at } 
                         ]
            });
        },
        methods:  {
          onView: function (document) {
            this.viewDocument = document;
            console.log('You viewed document: ', document),
            this.viewing = true;
          },
          onEdit: function (document) {
            console.log('You Edited document: ', document.id)
            this.viewing = false;
          },
          onDelete: function (doc) {
            console.log('Deletind document: ', doc.id);
            this.documents.splice(_.indexOf(this.documents, doc), 1);
            console.log('Documents: ', this.documents);
          },
          onCloseModal: function () {
            this.viewing = false;
          } 
        }

    }
</script>
