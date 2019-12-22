<template>
    <div class="header">
        <div class="container">
            <div class="header-left">
                <h1>DS menu</h1>
            </div>
            <div class="header-right">
                <div class="links">
                    <router-link to="/config">CONFIG</router-link>
                    <a @click="logout">LOGOUT</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        name: "Header",
        methods: {
            logout() {
                axios.post('/logout')
                    .then(res => {
                        location.reload();
                    })
            }
        }

    }
</script>

<style scoped lang="scss">
    .header {
        width            : 100%;
        display          : flex;
        align-items      : center;
        height           : 4rem;
        background-color : #151965;
        box-shadow       : 0px 11px 18px 0px rgba(21, 25, 101, 0.59);

        .container {
            display         : flex;
            max-height      : 100%;
            justify-content : space-between;
        }

        h1 {
            color  : #fff;
            margin : 0;
        }

        .header-left {
            display : flex;
            width   : 50%;

        }

        .header-right {
            display         : flex;
            justify-content : flex-end;
            width           : 50%;

            a {
                color           : #fff;
                font-size       : 1.5rem;
                text-decoration : none;
                margin-right    : 2rem;
                cursor          : pointer;

                &:hover {
                    text-decoration : underline;
                }
            }
        }

    }
</style>