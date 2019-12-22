<template>
    <div class="app">
        <Header></Header>
        <div class="main">
            <Sidebar
                    :menu_bg_color="menu_bg_color"
                    :menu_text_color="menu_text_color"
            >

            </Sidebar>
            <router-view
                    @menuBG="menuBG"
                    @menuText="menuText"
                    @headerBG="headerBG"
            ></router-view>
        </div>
    </div>

</template>

<script>
    import Header from './components/Header';
    import Sidebar from './components/Sidebar';
    import axios from 'axios'

    export default {
        data: function () {
            return {
                menu_bg_color: null,
                menu_text_color: null,
                header_bg_color: null,
            }
        },
        methods: {
            menuBG(e) {
                this.menu_bg_color = e.color;
            },
            menuText(e) {
                this.menu_text_color = e.color;
            },
            headerBG(e) {
                this.header_bg_color = e.color;
            },


        },
        components: {
            Header,
            Sidebar
        },
        mounted() {
            axios.post('/menu', {
                interface_id: 1
            })
                .then(res => {
                    console.log(res.data);
                })
        }
    }

</script>

<style lang="scss">
    html {
        font-family : Nunito sans-serif;
        font-size   : 10px;
    }

    .main {
        display : flex;
    }


</style>    