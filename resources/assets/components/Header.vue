<template>
    <div class="header">
        <h1>DS menu</h1>
    </div>
</template>

<script>
    export default {
        name: "Header"
    }
</script>

<style scoped lang="scss">
    .header{
        width:100%;
        display: flex;
        align-items : center;
        height: 4rem;
        background-color: #151965;
        box-shadow: 0px 11px 18px 0px rgba(21,25,101,0.59);
        padding-left : 4rem;
        padding-right : 4rem;
        h1{
            color : #fff;
            margin : 0;
        }
    }
</style>