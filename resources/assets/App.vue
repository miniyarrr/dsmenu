<template>
    <div class="app">
        <Header></Header>
        <div class="main">
            <Sidebar :menu_bg_color="menu_bg_color" ></Sidebar>
            <router-view
                    @menuBG="menuBG"
            ></router-view>
        </div>
    </div>

</template>

<script>
    import Header from './components/Header';
    import Sidebar from './components/Sidebar';

    export default {
        data: function () {
            return {
                menu_bg_color: '#515585'
            }
        },
        methods: {
            menuBG(e) {
                this.menu_bg_color = e.color;
            }

        },
        components: {
            Header,
            Sidebar
        }
    }

</script>

<style lang="scss">
    html {
        font-family : Roboto sans-serif;
        font-size   : 10px;
    }

    .main {
        display : flex;
    }


</style>    