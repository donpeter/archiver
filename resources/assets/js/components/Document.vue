<template>
        <tr role="row" class="odd">
          <td tabindex="1" class="sorting_1">{{document.ref}}</td>
          <td tabindex="1">{{document.title}}</td>
          <td tabindex="1">{{document.sender}} </td>
          <td tabindex="1">{{document.receiver}}</td>
          <td tabindex="1">
            <a href="javascript:void(0)" class="text-inverse pr-5" title="view" data-target="tooltip" data-toggle="tooltip" data-original-title="View" @click="onView"  >
            <i class="zmdi zmdi-eye txt-success"></i>
            </a>
            <a href="javascript:void(0)" class="text-inverse pr-5" title="edit" data-target="tooltip" data-toggle="tooltip" data-original-title="Edit" @click="onEdit" >
            <i class="zmdi zmdi-edit txt-warning"></i>
            </a>
            <a href="javascript:void(0)" class="text-inverse sa-warning" data-toggle="tooltip" data-original-title="Delete" @click="onDelete">
            <i class="zmdi zmdi-delete txt-danger"></i>
            </a>
          </td>
        </tr>
</template>


<script>
    export default {
      props: ['document'],
      mounted() {
          console.log('Document Component Mounted.')
      },
      methods: {
        onView: function () {
          console.log('You viewed document: ', this.document.id)
        },
        onEdit: function () {
          this.document.title = 'edit';
          console.log('You Edited document: ', this.document.id)
        },
        onDelete: function () {
          this.$emit('document-delete', this.document);
          console.log('You Delete document: ', this.document.id);
        }
      }
  }
</script>
