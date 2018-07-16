<template>
  <div>
    <input type="text" name="school" id="school" class="form-control"
      autocomplete="off"
      v-model="keyword"
      @keydown.down="down"
      @keydown.up="up"
      @keydown.enter.prevent="hit"
      @keydown.esc="reset"
      @keydown.delete="focus"
      @focus="focus"
      @blur="lossFocus"
      required="required" title="學校名稱" placeholder="請輸入學校關鍵字">

    <input type="hidden" id="sch_id" name="sch_id" v-model="keyword_id">

    <ul class="list-group" v-show="display">
      <li class="list-group-item" v-for="(item, index) in filter_posts"
          :class="activeClass(index)"
          @mousemove="mousemove(index)"
          @mousedown="hit">
          {{ item.name }}
      </li>
    </ul>
  </div>
</template>

<script>
var post_api_url="/schools/all";

export default {
  name: 'auto-complete',
  props: ['tempid', 'tempuid', 'tempvalue'],
  data() {
    return {
      current: 0,// now position
      keyword: this.tempvalue ? this.tempvalue: '',
      keyword_id: this.tempid ? this.tempid : -1,
      display: false,
      data: [],
      limit: 5,// display limit
    }
  },
  mounted() {
    var vobj = this;
    $.get(post_api_url).then(function (res) {
      vobj.data = res;
    });
  },
  computed: {
    filter_posts: function () {// 過濾篩選
      var vobj = this;
      return this.data.filter(function (post) {
        if (post['name'].indexOf(vobj.keyword) != -1 & vobj.keyword != '') {
          return true;
        } else {
          return false;
        }
      }).slice(0, this.limit);
    }
  },
  methods: {
    mousemove (index) {
      this.current = index;
    },
    focus () {
      this.display = true;
    },
    lossFocus () {
      this.display = false;
    },
    activeClass (index) {
      return {
        active: this.current === index
      }
    },
    up () {
      if (this.current > 0) {
        this.current--
      } else {
        this.current = this.limit-1
      }
    },
    down () {
      if (this.current < this.limit - 1) {
        this.current++;
      } else {
        this.current = 0;
      }
    },
    hit () {
      var now = this.filter_posts[this.current];

      this.display = false;
      this.current = 0;
      this.keyword = now.name;
      this.keyword_id = now.id;
    },
    reset () {
      this.display = false;
      this.keyword = '';
    }
  }
}
</script>

<style scoped>
  ul {
    position: absolute;
    z-index: 1000;
  }

  li:hover {
    background-color: #3097D1;
    color: #fff;
    cursor: pointer;
  }
</style>