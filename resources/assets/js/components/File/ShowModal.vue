<template>
  <div class="modal fade" :id="id">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">{{ info.title }}</h4>
        </div>
        <div class="modal-body" id="link-modal-body">
          <p>{{ info.description }}</p>
          <hr>
          <ul class="list-unstyled" v-if="info.attachs">
            <li v-for="attach in info.attachs">
                <a :href="attach.path"
                   :download="attach.name" 
                >{{ attach.name }}</a>
            </li>
          </ul>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'file-show-modal',

  props: {
    id: {
      type: String,
      required: true
    },
    info: {
      type: Object,
      required: true
    }
  }
}
</script>
