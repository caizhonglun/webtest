<template>
  <div class="modal fade" :id="id">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">{{ title }}</h4>
        </div>
        <div class="modal-body" id="link-modal-body">
          <form class="form-horizontal" role="form" id="linkForm">
            <div class="form-group">
              <label for="title" class="col-xs-3 col-sm-3 col-md-3 col-lg-3">名稱<span class="text-danger">*</span></label>
              <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                <input type="text" class="form-control" id="title" v-model="input.name" placeholder="必填" required>
                <span class="error text-danger" v-if="error.title">{{ error.title[0] }}</span>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
          <button type="button" class="btn btn-primary" @click.prevent="submit()">確認</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'link-sort-modal',

  props: {
    id: {
      type: String,
      required: true
    },
    title: {
      type: String,
      required: true
    },
    route: {
      type: String,
      required: true
    },
    theme: String,
    input: Object,
  },

  data() {
    return {
      error: {}
    };
  },

  methods: {
    submit() {
      var vobj = this;
      var params = {
        name: this.input.name,
        theme: this.theme
      };

      switch (this.title) {
        case '新增類別':
          axios.post(this.route, params)
            .then(vobj.resp)
            .catch(function(error) {
            vobj.error = error.response.data;
          });
          break;
        case '修改類別':
          axios.patch(this.route, params)
            .then(vobj.resp)
            .catch(function(error) {
            vobj.error = error.response.data;
          });
          break;
        default:
          alert('請照正常管道使用服務，謝謝！');
      }
    },
    resp(response) {
      switch (response.data) {
        case 'success':
          window.location.reload();
          break;
        case 'error':
          alert('資料庫錯誤！');
          break;
        default:
          alert('網路連線有問題！');
      }
    }
  }
}
</script>
