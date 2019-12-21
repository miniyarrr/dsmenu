<template>
    <div class="main">
        <Header></Header>
        <Sidebar></Sidebar>
        <router-view></router-view>
    </div>

</template>

<script>
import Header from './components/Header';
import Sidebar from './components/Sidebar';
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
            Header,
            Sidebar
        }
    }

</script>

<style lang="scss">
html{
    font-family:Roboto sans-serif;
    font-size:10px;
}


</style>    