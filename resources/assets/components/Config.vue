<template>
    <div class="config container">
        <div class="config-header">
            <h1>Страница настроек</h1>
            <button @click="save" class="btn btn-primary">Сохранить</button>
        </div>
        <div class="configs">
            <div class="input-row">
                <h4>Цвет меню</h4>
                <Chrome v-model="menu_bg_color" @input="menuBG"></Chrome>

            </div>
            <div class="input-row">
                <h4>Цвет текста меню</h4>
                <Chrome v-model="menu_text_color" @input="menuText"></Chrome>
            </div>
            <div class="input-row">
                <h4>Цвет шапки</h4>
                <Chrome v-model="header_bg_color" @input="headerBG"></Chrome>

            </div>
            <div class="input-row">
                <h4>Цвет текста шапки</h4>
                <Chrome v-model="header_text_color" @input="headerText"></Chrome>

            </div>

        </div>

    </div>
</template>

<script>
    import {Chrome} from 'vue-color'
    import axios from 'axios';

    export default {
        name: "Config",
        data() {
            return {
                menu_bg_color: {hex: '#fff'},
                menu_text_color: {hex: '#fff'},
                header_bg_color: {hex: '#fff'},
                header_text_color: {hex: '#fff'},
            }
        },
        props: ['p_menu_bg_color', 'p_menu_text_color', 'p_header_bg_color', 'p_header_text_color'],
        methods: {
            menuBG(e) {
                this.$emit('menuBG', {color: e.hex});
            },
            menuText(e) {
                this.$emit('menuText', {color: e.hex});
            },
            headerBG(e) {
                this.$emit('headerBG', {color: e.hex});
            },
            headerText(e) {
                this.$emit('headerText', {color: e.hex});
            },
            save() {
                axios.post('/saveParams', {
                    menu_bg_color: this.menu_bg_color.hex,
                    menu_text_color: this.menu_text_color.hex,
                    header_bg_color: this.header_bg_color.hex,
                    header_text_color: this.header_text_color.hex
                })
                    .then(res => {
                        console.log('saved successfully');
                    })
            }


        },
        components: {
            Chrome

        },
        mounted() {
            this.menu_bg_color = {hex: this.p_menu_bg_color};
            this.menu_text_color = {hex: this.p_menu_text_color};
            this.header_bg_color = {hex: this.p_header_bg_color};
            this.header_text_color = {hex: this.p_header_text_color};
        }
    }
</script>

<style scoped lang="scss">
    .config {
        display        : flex;
        flex-direction : column;

        .config-header {
            margin-bottom : 1.5rem;
        }

        .configs {
            display : flex;

            .input-row {
                margin : 0rem 1rem;

                .vc-chrome {
                    width : 18rem;
                }
            }
        }
    }
</style>