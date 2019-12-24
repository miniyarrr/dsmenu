<template>
    <div class="app" v-if="interfaces">
        <Header
                :header_bg_color="header_bg_color"
                :header_text_color="header_text_color"
                :interfaces="interfaces"
                @interfaceChanged="interfaceChanged"
        ></Header>
        <div class="main">
            <Sidebar :menu="menu"
                     :menu_bg_color="menu_bg_color"
                     :menu_text_color="menu_text_color"
            >

            </Sidebar>
            <router-view
                    @menuBG="menuBG"
                    @menuText="menuText"
                    @headerBG="headerBG"
                    @headerText="headerText"
            ></router-view>
        </div>
    </div>

</template>

<script>
    import Header from './components/Header';
    import Sidebar from './components/Sidebar';
    import List from './components/List';
    import axios from 'axios'

    export default {
        data: function () {
            return {
                menu_bg_color: null,
                menu_text_color: null,
                header_bg_color: null,
                header_text_color: null,
                menu: null,
                interfaces:null
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
            headerText(e) {
                this.header_text_color = e.color;
            },
            async interfaceChanged(e){
                var menu = await axios.post('/menu', {
                    interface_id: e.interface_id
                });
                console.log(menu.data);
                this.menu = menu.data.items
            }

        },
        components: {
            Header,
            Sidebar,
            List
        },
        async mounted() {

            var interfaces = await axios.post('/interface')
            this.interfaces = interfaces.data;

            var menu = await axios.post('/menu', {
                interface_id: this.interfaces[0]['id']
            });
            console.log(menu.data);
            this.menu = menu.data.items

            this.menu_bg_color = 'blue';
            this.menu_text_color = '#fff';
            this.header_bg_color = 'green';
            this.header_text_color = '#FFF'
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