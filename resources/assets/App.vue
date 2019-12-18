<template>
    <div class="main">
       <h1>vue`s working</h1>
    </div>

</template>

<script>

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
        }
    }

</script>

<style lang="scss">
html{
    font-family:Roboto sans-serif;
}


</style>    