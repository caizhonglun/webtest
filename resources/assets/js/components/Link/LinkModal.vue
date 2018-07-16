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
              <input type="text" class="form-control" id="title" v-model="input.title" placeholder="必填" required>
              <span class="error text-danger" v-if="error.title">{{ error.title[0] }}</span>
            </div>
          </div>
          <div class="form-group">
            <label for="url" class="col-xs-3 col-sm-3 col-md-3 col-lg-3">網址<span class="text-danger">*</span></label>
            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
              <input type="url" class="form-control" id="url" v-model="input.url" placeholder="必填" required>
              <span class="error text-danger" v-if="error.url">{{ error.url[0] }}</span>
            </div>
          </div>
          <div class="form-group">
            <label for="organizer" class="col-xs-3 col-sm-3 col-md-3 col-lg-3">承辦單位<span class="text-danger">*</span></label>
            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
              <input type="text" class="form-control" id="organizer" maxlength="40" v-model="input.organizer" placeholder="必填" required>
              <span class="error text-danger" v-if="error.organizer">{{ error.organizer[0] }}</span>
            </div>
          </div>
          <div class="form-group">
            <label for="contactPhone" class="col-xs-3 col-sm-3 col-md-3 col-lg-3">聯絡電話<span class="text-danger">*</span></label>
            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
              <input type="tel" class="form-control" id="contactPhone" maxlength="40" v-model="input.contact_phone" placeholder="必填" required>
              <span class="error text-danger" v-if="error.contactPhone">{{ error.contactPhone[0] }}</span>
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
  name: 'link-modal',

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
    input: Object,
    sort: String,
    sort_id: [String, Number]
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
        sort: this.sort,
        sort_id: this.sort_id,
        title: this.input.title,
        url: this.input.url,
        organizer: this.input.organizer,
        contactPhone: this.input.contact_phone
      };

      switch (this.title) {
        case '新增連結':
          axios.post(this.route, params)
            .then(function(response) {
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
            }).catch(function(error) {
            vobj.error = error.response.data;
          });
          break;
        case '修改連結':
          axios.patch(this.route, params)
            .then(function(response) {
              switch (response.data) {
                case 'success':
                  alert('修改成功！');
                  break;
                case 'error':
                  alert('資料庫錯誤！');
                  break;
                default:
                  alert('網路連線有問題！');
              }
            }).catch(function(error) {
            vobj.error = error.response.data;
          });
          break;
        default:
          alert('請照正常管道使用服務，謝謝！');
      }
    }
  }
}
</script>
