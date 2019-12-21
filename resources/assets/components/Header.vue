<template>
    <div class="header">
        <div class="container">
            <h1>DS menu</h1>
            <h1 @click="logout">LOGOUT</h1>
            <router-link to="/config">weweewe</router-link>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        name: "Header",
        methods:{
            logout(){
                axios.post('/logout')
                    .then(res=>{
                        location.reload();
                    })
            }
        }

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