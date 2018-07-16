<template>
<li class="list-group-item">
    <!-- 如果是檔案夾點擊一下可開啟關閉 -->
    <div @click="toggle(folder)">
        <span class="glyphicon" aria-hidden="true"
              :class="[folder.open ? 'glyphicon-folder-open' : 'glyphicon-folder-close' ]"
        ></span>
        {{ folder.name }}
    </div>
    <!-- open屬性來決定是否開啟 -->
    <ul style="list-style: none;padding-left: 20px;" v-show="folder.open">
        <li v-for="subFolder in folder.children">
          {{ subFolder.name }}
          <span class="glyphicon glyphicon-chevron-right"
                aria-hidden="true"
                @click="getData(subFolder.id, subFolder.name)"
          ></span>
        </li>
        <li><span class="glyphicon glyphicon-plus" @click="newFolder()">新增</span></li>
    </ul>
</li>
</template>
<script>
export default {
  name: 'file-folder',
  props: {
    id: Number,
    layer: {
      type: Number,
      default: 2
    },
    data: Object
  },
  data: function() {
    return {
      folder: {
        name: this.data.name,
        open: this.data.open,
        children: this.data.children
      },
    };
  },
  methods: {
    // 透過傳址的方式控制檔案夾開關
    toggle: function(folder) {
      folder.open = !folder.open;
    },
    getData: function(id, name) {
      this.$emit('select', '/folder/'+id, id, name);
    },
    newFolder: function() {
      let name = prompt("請輸入欲新增的類別名稱","");
      let vobj = this;

      if (name.trim()) {
        axios.post('/folder', {
          above: vobj.id,
          layer: vobj.layer,
          name: name.trim()
        }).then(function(response) {
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
      } else {
        alert('請輸入正常名稱');
      }
    }
  }
}
</script>
