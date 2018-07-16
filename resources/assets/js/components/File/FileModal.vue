<template>
  <div class="modal fade" :id="id">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">{{ title }}</h4>
        </div>
        <div class="modal-body" id="link-modal-body">
          <form class="form"
                role="form" :id="id+'Form'"
                enctype="multipart/form-data">
            <div class="form-group">
              <label :for="id+'title'">名稱<span class="text-danger">*</span></label>
              <input type="text"
                     class="form-control"
                     :id="id+'title'" 
                     name="title" 
                     v-model="input.title" placeholder="必填">
              <span class="error text-danger" v-if="error.title">{{ error.title[0] }}</span>
            </div>
            <div class="form-group">
              <label :for="id+'description'">描述<span class="text-danger">*</span></label>
              <textarea class="form-control"
                        name="description" 
                        :id="id+'description'"
                        v-model="input.description"
                        placeholder="必填"></textarea>
              <span class="error text-danger" v-if="error.description">{{ error.description[0] }}</span>
            </div>
            <div class="form-group">
              <label :for="id+'attachs'">檔案附件</label>
              <ul class="list-unstyled" v-if="attachs">
                <li v-for="(attach, index) in attachs">
                    <a :href="attach.path"
                       :download="attach.name" 
                    >{{ attach.name }}</a>
                </li>
              </ul>
              <div v-if="title !== '修改檔案'">
                <input type="file"
                       name="attachs[]"
                       :id="id+'attachs'"
                       accept="application/pdf,application/zip" multiple>
                <p class="help-block">
                    <ol>
                        <li>若檔案數較多，請一次選取多個檔案。</li>
                        <li>目前僅開放pdf檔及zip檔上傳。</li>
                        <li>本公告屬公開訊息，凡附件檔案屬機密性、或涉及個人資料，請勿於此提供公開下載。</li>
                        <li>為響應自由軟體的推行，上傳檔案請提供多個版本供使用者下載。</li>
                    </ol>
                </p>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
          <button type="button" class="btn btn-primary"
                  @click.prevent="submit()"
                  :disabled="title !== '新增檔案'">確認</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'file-modal',

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
    folder_id: {
      type: Number,
      required: true
    },
    input: Object,
  },

  data() {
    return {
      error: {},
      attachs: []
    };
  },

  watch: {
    input(val) {
      let vobj = this;
      if (val.id) {
        axios.get('/file/'+val.id)
            .then(function(response) {
              vobj.attachs = response.data.attachs;
            });
      } else {
        vobj.attachs = [];
      }
    }
  },

  methods: {
    submit() {
      let vobj = this;
      switch (this.title) {
        case '新增檔案':
          let formData = new FormData(document.querySelector('#'+this.id+'Form'));
          formData.append('folder_id', vobj.folder_id);

          axios.post(this.route, formData)
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
        case '修改檔案':
          axios.patch(
            this.route, {
              title: vobj.input.title,
              description: vobj.input.description
          }).then(function(response) {
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
