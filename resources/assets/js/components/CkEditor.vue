<template>
    <div class="ckeditor">
        <textarea
          :name="name"
          :id="id"
          :value="value">
        </textarea>
    </div>
</template>

<script>
let inc = 0;

var toolbar = {
    default: [
        ['Source'],
        ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript' ],
        ['NumberedList', 'BulletedList'],
        ['Indent', 'Outdent'],
        ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
        ['Link'],
        ['FontSize', 'Font', 'Format', 'Styles'],
        ['BGColor', 'TextColor']
    ],
    luxury: [
        ['Source', 'Preview'],
        ['Undo','Redo'],
        ['Cut', 'Copy', 'Paste'],
        ['Find', 'SelectAll'],
        ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript' ],
        ['NumberedList', 'BulletedList', 'Blockquote'],
        ['BidiRtl', 'BidiLtr'],
        ['Indent', 'Outdent'],
        ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
        ['Anchor', 'Unlink', 'Link'],
        ['base64image', 'Embed', 'Table', 'HorizontalRule', 'SpecialChar', 'PageBreak'],
        ['FontSize', 'Font', 'Format', 'Styles'],
        ['BGColor', 'TextColor'],
        ['ShowBlocks', 'Maximize'],
        ['InsertMedia']
    ]
};

export default {
  name: 'vue-ckeditor',
  props: {
    name: {
      type: String,
      default: () => `editor-${++inc}`
    },
    value: {
      type: String
    },
    id: {
      type: String,
      default: () => `editor-${inc}`
    },
    types: {
      type: String,
      default: () => `classic`
    },
    height: {
      type: Number,
      default: 600
    },
    toolbar: {
        type: String,
        default: 'default'
    }
  },
  data () {
    return { 
        destroyed: false,
        config: {
            toolbar: toolbar[this.toolbar],
            height: this.height
        }
    }
  },
  computed: {
    instance () {
      return CKEDITOR.instances[this.id]
    },
  },
  watch: {
    value (val) {
      let html = this.instance.getData();
      if (val !== html) {
        this.instance.setData(val ? val: '');
      }
    }
  },
  mounted () {
    if (typeof CKEDITOR === 'undefined') {
      console.log('CKEDITOR is missing (http://ckeditor.com/)')
    } else {
      if (this.types === 'inline') {
          CKEDITOR.inline(this.id, this.config)
      } else {
          CKEDITOR.replace(this.id, this.config)
      }

      this.instance.on('change', () => {
        let html = this.instance.getData()
        if (html !== this.value) {
          this.$emit('input', html)
          this.$emit('update:value', html)
        }
      })

      this.instance.on('blur', () => {
        this.$emit('blur', this.instance)
      })

      this.instance.on('focus', () => {
        this.$emit('focus', this.instance)
      })
    }
  },
  beforeDestroy () {
    if (!this.destroyed) {
      this.instance.focusManager.blur(true)
      this.instance.removeAllListeners()
      this.instance.destroy()
      this.destroyed = true
    }
  }
}
</script>
