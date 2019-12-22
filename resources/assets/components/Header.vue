<template>
    <div class="header" :style="{'background-color':header_bg_color, 'color':header_text_color }">
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
        props:['header_bg_color','header_text_color'],
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
            color : inherit;
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
                color           : inherit;
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