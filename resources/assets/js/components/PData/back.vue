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
                        <label for="unit">科室<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="unit" maxlength="255" v-model="row.unit">
                    </div>
                    <div class="form-group">
                        <label for="name">檔案名稱<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" maxlength="255" v-model="row.name">
                    </div>
                    <div class="form-group">
                        <label for="accordance">保有依據<span class="text-danger">*</span></label>
                        <textarea class="form-control" id="accordance" v-model="row.accordance"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="purpose">特定目的<span class="text-danger">*</span></label>
                        <textarea class="form-control" id="purpose" v-model="row.purpose"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="p_data_sort">個人資料別<span class="text-danger">*</span></label>
                        <textarea class="form-control" id="p_data_sort" v-model="row.p_data_sort"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="keep_unit">保有單位<span class="text-danger">*</span></label>
                        <textarea class="form-control" id="keep_unit" v-model="row.keep_unit"></textarea>
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
    name: 'pdata-model',
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
                unit: '',
                name: '',
                accordance: '',
                purpose: '',
                p_data_sort: '',
                keep_unit: ''
            }
        };
    },
    watch: {
        data: function() {
            this.row = {
                unit: this.data.unit,
                name: this.data.name,
                accordance: this.data.accordance,
                purpose: this.data.purpose,
                p_data_sort: this.data.p_data_sort,
                keep_unit: this.data.keep_unit
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
                axios.post('/pdata', that.row)
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