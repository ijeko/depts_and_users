<template>
    <div class="card" :style=styles>
        <img class="card-img-top" :src="getUrl" :style=styles alt="Card image cap">
        <div class="card-body" v-if=isEditable>
            <div class="mb-3">
                <input class="form-control form-control-sm" id="file" ref="file" type="file"  @change="upload">
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "LogoComponent",
    data () {
      return {
          fileObject: {}
      }
    },
    props: {
        img: '',
        isEditable: false
    },
    methods: {
        upload() {
            this.fileObject = this.$refs.file.files[0];
            this.$emit('upload', this.fileObject)
            this.$refs.file.value=null;
        },
        preview() {
        },
    },
    computed: {
        getUrl() {
            return 'http://' + window.location.host + '/' + this.img
        },
        styles() {
            let styles = ''
            if (!this.isEditable) {
                styles = styles+'width: 8rem'
            } else {
                styles = styles+'width: 18rem'
            }
            return styles
        }
    }
}
</script>

<style scoped>

</style>
