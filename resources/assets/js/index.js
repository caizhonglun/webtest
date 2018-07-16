
Vue.component('file-show-modal', require('./components/File/ShowModal.vue'));

// about district
Vue.component('district-index', require('./components/District/index.vue'));

// schools
Vue.component('auto-complete', require('./components/AutoComplete.vue'));

const app = new Vue({
    el: '#app',
    data: {
        selected: '',
        items: [],
        info: {},
        duty: {
            content: '',
            list: []
        },
        modal: {
            title: '',
            route: '',
        }
    },
    methods: {
        // 組織業務人員簡介
        selectDuty() {
            axios.get('/duty/'+this.selected).then(
                (response) => {
                    this.duty.content = response.data.duty;
                }
            );
            axios.get('/personalduty/'+this.selected).then(
                (response) => {
                    this.duty.list = response.data.personalDuties;
                }
            );
        },
        // 檔案專區
        select(route) {
            let sele = document.getElementById('serTr');
            if (sele) {
                sele.innerHTML = '';
            }

            axios.get(route + this.selected).then(
                (response) => {
                    this.items = response.data;
                }
            );
        },
        getInfo(route) {
            axios.get(route).then(
                (response) => {
                    this.info = response.data;
                }
            );
        },
        showModal(title, route) {
          this.modal.title = title;
          this.modal.route = route;
        }
    }
});
