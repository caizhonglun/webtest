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
                        <label for="inputTitle">標題<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="inputTitle" maxlength="255" v-model="row.title">
                    </div>
                    <div class="form-group">
                        <label for="inputContent">內容<span class="text-danger">*</span></label>
                        <vue-ckeditor id="inputContent" v-model="row.content" toolbar="luxury"></vue-ckeditor>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
                <button type="button" class="btn btn-primary" @click="submit">儲存</button>
            </div>
        </div>
    </div>
</div>
</template>
<script>
export default {
    name: 'qa-modal',
    props: {
        id: {
          type: String,
          required: true
        },
        title: {
          type: String,
          required: true
        },
        route: String,
        data: Object
    },
    data: function() {
        return {
            row: {
                title: '',
                content: '',
            }
        };
    },
    watch: {
        data: function() {
            this.row = {
                title: this.data.title,
                content: this.data.content,
            }
        }
    },
    methods: {
        submit: function() {
            let that = this;
            for (let key in that.row) {
                if (!that.row[key]) {
                    alert('請填寫所有欄位！');
                    return
                }
            }

            if (that.title == '新增') {
                axios.post('/qa', that.row)
                    .then(function(response) {
                      switch (response.data) {
                        case 'success':
                            alert('新增成功！');
                            window.location.reload();
                            break;
                        case 'error':
                            alert('資料庫錯誤！');
                            break;
                        default:
                            alert('網路連線有問題！');
                      }
                    });
            } else {
                axios.patch(that.route, that.row)
                    .then(function(response) {
                        switch (response.data) {
                            case 'success':
                                alert('修改成功！');
                                window.location.reload();
                                break;
                            case 'error':
                                alert('資料庫錯誤！');
                                break;
                            default:
                                alert('網路連線有問題！');
                          }
                    });
            }
        }
    }
}
</script>