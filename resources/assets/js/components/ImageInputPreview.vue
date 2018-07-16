<template>
    <div class="Image-input__image-wrapper" @click="triggerImg()">
        <img v-show="imageSrc" class="img-thumbnail" :src="imageSrc">
        <input
            v-show="false" @change="previewThumbnail"
            :name="name" :id="id" type="file"
            accept="image/x-png,image/gif,image/jpeg"
        >
    </div>
</template>

<script>
export default {
    name: 'vue-image-preview',

    props: {
        imageSrc: String,
        id: {
            type: String,
            default: 'thumbnail'
        },
        name: {
            type: String,
            default: 'thumbnail'
        }
    },

    methods: {
        previewThumbnail: function(event) {
            var input = event.target;

            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var vm = this;

                reader.onload = function(e) {
                    vm.imageSrc = e.target.result;
                }

                reader.readAsDataURL(input.files[0]);
            }
        },

        triggerImg: function() {
            var btn = document.getElementById(this.id);
            btn.click();
        }
    }
}
</script>

<style scoped>

.Image-input__image-wrapper {
    flex-basis: 80%;
    min-height: 200px;
    flex: 2.5;
    border-radius: 1px;
    overflow-y: hidden;
    border-radius: 1px;
    background: #eee;
    justify-content: center;
    align-items: center;
    display: flex;
    cursor: pointer;
}

.Image-input__image-wrapper:hover {
    background: #e0e0e0;
}

.img-thumbnail {
    max-width: 100%;
}

</style>