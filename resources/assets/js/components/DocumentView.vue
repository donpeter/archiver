<template>
  <!-- Document modal content -->
  <div class="modal fade bs-example-modal-lg" id="viewModal" tabindex="-1" role="dialog" :aria-labelledby="document.title" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h5 class="modal-title" id="title">{{trans.title}} : {{document.title}} </h5>
        </div>
        <div class="modal-body">
          <h5>{{trans.ref}} : {{document.ref}}</h5>
          <h5 class="mb-15">{{trans.title}} : {{document.title}}</h5>
          <p>{{document.desc}}</p>
          <div class="row" >
            <div class="col-md-4 single-img " v-for="img in document.files" >
              <div class="img-preview">
                <a  :href="'/upload/'+img.slug" :data-lightbox="img.name" :data-title="img.name">
                  <img  :src="'/upload/'+img.slug" class="img-thumbnail" :alt="img.alt" max-height="250">
                  <i class="zmdi zmdi-aspect-ratio-alt zmdi-hc-3x mdc-text-light-blue"></i>
                </a>
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info text-left ml-10" data-dismiss="modal">Edit</button>
          <button type="button" class="btn btn-danger text-left" data-dismiss="modal" @click="onClose">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

</template>


<script>
    export default {
      props: ['document','modalShown'],
      data() {
        return {
          trans: {
            ref: 'Reference',
            title: 'Title',
            desc: 'Description',
            from: 'From',
            to: 'To',
            signed: 'Signed Date',
            written: 'Written date',
            received: 'Received'
          },
          imgs: [1,2,3,4,5,6,7]


        }
      },
      mounted() {
          //this.trans = this.getTranslations()
          console.log('View mounted');
          $('#viewModal').modal('show');
      },
      methods: {
        onEdit: function () {
          this.document.title = 'edit';
          console.log('You Edited document: ', this.document.id)
        },
        onClose: function() {
          this.$emit('close-modal');
        },
        getTranslations: function () {
          axios.get('document/view')
            .then(function (response) {
                return response;
              })
              .catch(function (error) {
                console.log(error);
              });
        }
      }
  }
</script>
<style>
  .img-preview, .img-preview i {
      position: relative;
      max-height: 200px;
  }
  
  .img-preview:hover {
      background: rgba(115, 74, 211, 0.21);    
  }

  .img-preview i {
      position: absolute;
      top: 45%;  
      left: 45%;
      transform: translate(-45%, -45%);
      display: none;
  }

  .img-preview:hover img {
      opacity: 0.5;
      background: #FEC107;
  }

  .img-preview:hover i {
      display: block;
      z-index: 500;
  }
</style>
