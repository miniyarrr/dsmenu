<template>
    <div class="header">
        <div class="container">
            <h1>DS menu</h1>
        </div>
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
        h1{
            color : #fff;
            margin : 0;
        }
    }
</style>