<template>
    <div class="modal fade" :id="id">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">{{ title }}</h4>
                </div>
                <div class="modal-body">
                    <form role="form">
                        <div class="form-group">
                            <label for="sort_id">類別</label>
                            <select name="sort_id" id="sort_id"
                                    class="form-control"
                                    v-model="input.sort_id"
                                    required>
                                <option disabled value="undefined">請選擇</option>
                                <option value="1">教育局</option>
                                <option value="5">教育局附屬機關</option>
                            </select>
                            <span class="error text-danger" v-if="error.sort_id">{{ error.sort_id[0] }}</span>
                        </div>

                        <div class="form-group">
                            <label for="name">單位名一<span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" v-model="input.name" maxlength="255" required>
                            <span class="error text-danger" v-if="error.name">{{ error.name[0] }}</span>
                        </div>

                        <div class="form-group">
                            <label for="name1">單位名二<span class="text-danger">*</span></label>
                            <input type="text" name="name1" id="name1" class="form-control" v-model="input.name1" maxlength="255" required>
                            <span class="error text-danger" v-if="error.name1">{{ error.name1[0] }}</span>
                        </div>

                        <div class="form-group">
                            <label for="name2">單位名三<span class="text-danger">*</span></label>
                            <input type="text" name="name2" id="name2" class="form-control" v-model="input.name2" maxlength="255" required>
                            <span class="error text-danger" v-if="error.name2">{{ error.name2[0] }}</span>
                        </div>

                        <div class="form-group">
                            <label for="engName">單位英文名<span class="text-danger">*</span></label>
                            <input type="text" name="engName" id="engName" class="form-control" v-model="input.engName" maxlength="255" required>
                            <span class="error text-danger" v-if="error.engName">{{ error.engName[0] }}</span>
                        </div>

                        <div class="form-group">
                            <label for="duty">科室執掌<span class="text-danger">*</span></label>
                            <br>
                            <span class="error text-danger" v-if="error.duty">{{ error.duty[0] }}</span>
                            <vue-ckeditor 
                                name="duty" id="duty"
                                v-model="input.duty"
                            ></vue-ckeditor>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" @click.prevent="submit">確認</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
  name: 'section-form-modal',

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
  },

  data() {
    return {
      error: {}
    };
  },

  watch: {
    input (val) {
      // 每次觸發modal, 就清空錯誤訊息
      this.error = {};
    }
  },

  methods: {
    submit() {
      var vobj = this;

      switch (this.title) {
        case '新增科室':
          axios.post(this.route, this.input)
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
        case '科室執掌':
          axios.patch(this.route, this.input)
            .then(function(response) {
              switch (response.data) {
                case 'success':
                  alert('修改成功');
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
        default:
          alert('請照正常管道使用服務，謝謝！');
      }
    }
  }
}
</script>
