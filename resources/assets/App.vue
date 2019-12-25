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
            <router-view v-if="show_config"
                         @menuBG="menuBG"
                         @menuText="menuText"
                         @headerBG="headerBG"
                         @headerText="headerText"

                         :p_menu_bg_color="menu_bg_color"
                         :p_menu_text_color="menu_text_color"
                         :p_header_bg_color="header_bg_color"
                         :p_header_text_color="header_text_color"
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
                interfaces: null,
                show_config: false
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
            async interfaceChanged(e) {
                var menu = await axios.post('/menu', {
                    interface_id: +e.interface_id
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
            this.menu = menu.data.items;
            var params = await axios.post('/systemParams');
            this.show_config = true;
            this.menu_bg_color = params.data.menu_bg_color;
            this.menu_text_color = params.data.menu_text_color;
            this.header_bg_color = params.data.header_bg_color;
            this.header_text_color = params.data.header_text_color;
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