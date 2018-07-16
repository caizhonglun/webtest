<template>
<div class="modal fade" :id="id">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">新增</h4>
            </div>
            <div class="modal-body">
                <form method="POST" role="form" :id="id+'Form'"
                      enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label"
                            for="inputTitle">標題<span class="text-danger">*</span></label>
                        <input type="text" class="form-control"
                               name="title" 
                               id="inputTitle" placeholder="必填"
                               v-model="input.title">
                        <span class="text-danger glyphicon glyphicon-remove"
                              v-if="error.title">{{ error.title[0] }}</span>
                    </div>
                    <div class="form-group">
                        <label for="video">影片檔</label>
                        <input type="file"
                               name="video"
                               id="video"
                               accept="video/mp4,video/webm,video/ogg">
                        <span class="text-danger glyphicon glyphicon-remove"
                              v-if="error.video">{{ error.video[0] }}</span>
                        <p class="help-block">
                            <ol>
                                <li>可上傳mp4, webm, ogg檔。</li>
                                <li>本公告屬公開訊息，凡附件檔案屬機密性、或涉及個人資料，請勿於此提供公開下載。</li>
                            </ol>
                        </p>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">關閉</button>
                <button type="button" class="btn btn-primary" @click="submit">確認</button>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    name: 'video-new-modal',
    props: {
        id: {
            type: String,
            required: true
        },
        route: {
            type: String,
            required: true
        }
    },
    data: function() {
        return {
            input: {
                title: ''
            },
            error: {}
        };
    },// end data()
    methods: {
        submit: function() {
            let vobj = this;
            let formData = new FormData(document.querySelector('#'+vobj.id+'Form'));

            axios.post(vobj.route, formData)
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
                if (error.response.status === 500) {
                    alert('影片檔案過大');
                }
                vobj.error = error.response.data;
            });
        }// end submit()
    }// end methods
};// end export default
</script>
