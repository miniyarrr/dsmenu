<template>
    <div class="config container">
        <h1>Страница настроек</h1>
        <div class="input-row">
           <Chrome v-model="colors" @input="menuBG"></Chrome>

        </div>

    </div>
</template>

<script>
    import { Chrome } from 'vue-color'



    export default {
        name: "Config",
        data() {
            return {
                menu_bg_color: null,
                colors:'#194d33',
            }
        },
        methods: {
            menuBG(e) {
                this.$emit('menuBG', {color: e.hex})
                console.log('emit')
            }
        },
        components: {
            Chrome

        }
    }
</script>

<style scoped lang="scss">
    .config {
        display : flex;

    }
</style>