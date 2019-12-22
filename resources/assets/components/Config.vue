<template>
    <div class="config container">
        <h1>Страница настроек</h1>
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

    export default {
        name: "Config",
        data() {
            return {
                menu_bg_color: '#fff',
                menu_text_color: '#fff',
                header_bg_color: '#fff',
                header_text_color:'fff',
            }
        },

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
            headerText(e){
                this.$emit('headerText', {color: e.hex});
            }


        },
        components: {
            Chrome

        }
    }
</script>

<style scoped lang="scss">
    .config {
        display        : flex;
        flex-direction : column;

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