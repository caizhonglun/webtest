
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import ToggleButton from 'vue-js-toggle-button';
Vue.use(ToggleButton);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('vue-ckeditor', require('./components/CkEditor.vue'));
Vue.component('vue-image-preview', require('./components/ImageInputPreview.vue'));

// about link
Vue.component('link-modal', require('./components/Link/LinkModal.vue'));
Vue.component('link-sort-modal', require('./components/Link/SortModal.vue'));

// about files
Vue.component('file-folder', require('./components/File/Folder.vue'));
Vue.component('file-modal', require('./components/File/FileModal.vue'));

// about page table
Vue.component('page-content', require('./components/PageContent.vue'));

// about section
Vue.component('section-form-modal', require('./components/section/FormModal.vue'));

// about video
Vue.component('video-new-modal', require('./components/Video/NewModal.vue'));

// about district
Vue.component('district-back', require('./components/District/back.vue'));

// about pdata
Vue.component('pdata-model', require('./components/PData/back.vue'));

// about qa
Vue.component('qa-modal', require('./components/QA/back.vue'));

// schools
Vue.component('auto-complete', require('./components/AutoComplete.vue'));

const app = new Vue({
    el: '#app',
    data: {
      items: null,
      tabTitle: '',
      modal: {
        'title': '',
        'route': '',
        'data': {},
        'sort_id': -1,
        'folder_id': -1
      }
    },
    methods: {
        // 通用型，切換
        toggleShow: function(url) {
          axios.patch(url);
        },
        // 通用型，刪除
        deleteItem: function(route, index=-1) {
          let vobj = this;

          axios.delete(route).then(
            (response) => {
              if (index !== -1) {
                vobj.items.splice(index, 1);
              } else {
                window.location.reload();
              }
            }
          );
        },
        // 通用型，modal資料
        showModal(title, route, data={}) {
          this.modal.title = title;
          this.modal.route = route;
          this.modal.data = data;
        },
        // 通用型，取得json資料
        getInfo(route, id='', name='') {
          var vobj = this;

          vobj.modal.sort_id = id;
          vobj.modal.folder_id = id;
          vobj.tabTitle = name ? '['+name+']' : '';

          axios.get(route).then(function(response) {
            vobj.items = response.data;
          });
        },
        // 通用型，排序(上)
        up(id, route) {
          let row = document.getElementById('row'+id);
          let preRow = row.previousSibling;

          // skip TextNodes
          while(preRow != null && preRow.nodeType != 1){
            preRow = preRow.previousSibling;
          }

          // 檢查是否置頂
          if (preRow !== null) {
            let parent = row.parentNode;

            this.setPriority(
              route, id, --row.cells[1].innerHTML
            );
            this.setPriority(
              route, preRow.id.replace('row', ''), ++preRow.cells[1].innerHTML
            );
            parent.insertBefore(row, preRow);
          }
        },
        // 通用型，排序(下)
        down(id, route) {
          let row = document.getElementById('row'+id);
          let nextRow = row.nextSibling;

          // skip TextNodes
          while(nextRow != null && nextRow.nodeType != 1){
            nextRow = nextRow.nextSibling;
          }

          // 檢查是否置底
          if (nextRow !== null) {
            let parent = row.parentNode;

            this.setPriority(
              route, id, ++row.cells[1].innerHTML
            );
            this.setPriority(
              route, nextRow.id.replace('row', ''), --nextRow.cells[1].innerHTML
            );

            parent.insertBefore(row, nextRow.nextSibling);
          }
        },
        // 通用型，優先權設定
        setPriority(route, id, priority) {
          route = route.replace('number1', id).replace('number2', priority);
          axios.patch(route, {
            id: id,
            priority: priority
          }).then(function (res) {
            // console.log(res);
          });
        }
    }
});
