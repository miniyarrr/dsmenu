<template>
    <div class="header" :style="{'background-color':header_bg_color, 'color':header_text_color }">
        <div class="container">
            <div class="header-left">
                <p>Роль: </p>
                <select v-if="interfaces.length>1"
                        @change="interfaceChanged"
                        v-model="current_interface"
                >
                    <option v-for="interf in interfaces" :value="interf.id">
                        {{ interf.name}}

                    </option>
                </select>
                <p v-else>{{interfaces[0].name}}</p>
            </div>
            <div class="header-right">
                <div class="links">
                    <router-link to="/list">Пункты меню</router-link>
                    <router-link to="/configuration">Настройки</router-link>
                    <a @click="logout">Выйти</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        data() {
            return {
                current_interface: null
            }
        },
        name: "Header",
        props: ['header_bg_color', 'header_text_color', 'interfaces'],
        methods: {
            logout() {
                axios.post('/logout')
                    .then(res => {
                        location.reload();
                    })
            },
            interfaceChanged(e) {
                this.$emit('interfaceChanged', {interface_id: e.target.value})
            }
        },
        mounted() {
            this.current_interface = this.interfaces[0]['id']
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
            align-items     : center;
        }

        h1 {
            color  : inherit;
            margin : 0;
        }

        .header-left {
            display : flex;
            width   : 50%;
            align-items : center;
            p {
                margin-bottom : 0;
            }

            select {
                margin-left   : 1.5rem;
                color         : #000;
                border-radius : 5px;
                padding       : 0.4rem;
            }
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