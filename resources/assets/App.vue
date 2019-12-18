<template>
    <div class="main">
        <Header></Header>
    </div>

</template>

<script>
import Header from './components/Header'
    export default {
        data: function () {
            return {
            }
        },
        methods: {
            downloadFile() {
                window.location += 'download';
            },
//            uploadFile(e) {
//                var reader = new FileReader();
//
//                reader.readAsDataURL(e.target.files[0]);
//
//                reader.onload = (e) => {
//                    this.file = e.target.result;
//                }
//            },

        },
        components:{
            Header
        }
    }

</script>

<style lang="scss">
html{
    font-family:Roboto sans-serif;
}


</style>    