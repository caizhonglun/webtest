<template>
    <form role="form">
        <div class="alert alert-danger" role="alert" v-if="error.show">
          {{ error.content }}
        </div>
        <div class="form-group">
            <vue-ckeditor
                v-model="editContent"
                toolbar="luxury"
            ></vue-ckeditor>
        </div>
        <div class="form-group">
            <div class="col-xs-4 col-xs-offset-4 col-sm-4 col-sm-offset-4 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
                <button type="button"
                        class="btn btn-primary btn-block"
                        @click="updatePage"
                >確認送出</button>
            </div>
        </div>
    </form>
</template>
<script>
export default {
  name: 'page-content',
  props: {
    id: {
      type: String,
      required: true
    },
    value: String,
  },
  data() {
    return {
        editContent: this.value,
        success: {
          show: false
        },
        error: {
          show: false,
          content: ''
        }
    };
  },
  methods: {
    updatePage() {
      var vobj = this;

      axios.patch('/page/' + vobj.id, {
        content: vobj.editContent
      })
      .then(function (response) {
        if (response.data === 'success') {
          alert('更新成功');
        } else {
          vobj.error.show = true;
          vobj.error.content = error.response.status + '伺服器錯誤，請聯絡網站管理者。';
        }
      })
      .catch(function (error) {
        vobj.error.show = true;
        vobj.error.content = '發生錯誤';
      });
    }
  }
}
</script>
