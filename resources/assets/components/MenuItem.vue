<template>
    <li class="menu-item">

        <div class="menu-item-header" @click="expandChildren(item)">
            <h2 >
                <router-link :style="{'color':menu_text_color}" :to="item.url">
                    {{item.title}}
                </router-link>
            </h2>
            <svg v-if="item.children" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                 enable-background="new 0 0 24 24" id="Layer_1" version="1.0" viewBox="0 0 24 24" xml:space="preserve">
                <polyline :style="{'stroke':menu_text_color}" points="21,8.5 12,17.5 3,8.5 " fill="none" stroke="#fff" stroke-miterlimit="10"
                          stroke-width="2"/>
            </svg>
        </div>
        <transition name="tree-transition"
                    @before-enter="beforeEnter"
                    @enter="enter"
                    @after-enter="afterEnter"
                    @leave="leave"
                    @beforeLeave="beforeLeave"
        >

            <ul class="submenu" :style="{'padding-left':depth+'rem'}" v-if="item.children && item.expanded">

                <MenuItem
                        v-for="child in item.children"
                        :item="child"
                        :depth="depth+1"
                        :menu_text_color="menu_text_color"
                >

                </MenuItem>

            </ul>
        </transition>

    </li>
</template>

<script>
    import MenuItem from './MenuItem.vue'


    export default {
        name: "MenuItem",
        data() {
            return {}
        },
        props: {
            item: {
                type: Object
            },
            depth: {
                type: Number
            },
            menu_text_color:{
                type:String
            }

        },
        methods: {

            toggleLevel(element, e) {
                !element.hasOwnProperty('visible') ? this.$set(element, 'visible', false) : false;
                element.visible = !element.visible;

            },
            expandChildren(item){
                if(item.expanded===undefined){
                    this.$set(item, 'expanded', false)
                }
                item.expanded = !item.expanded

            },

            beforeEnter(el) {
                el.style.height = '0';
                el.style.overflow = 'hidden';
            },

            enter(el) {
                el.style.height = `${el.scrollHeight}px`;
            },

            afterEnter(el) {
                el.style.height = "auto";
                el.style.overflow = 'visible';

            },

            beforeLeave(el) {
                el.style.height = `${el.scrollHeight}px`;
            },

            leave(el) {
                setTimeout(() => {
                    el.style.height = '0';
                    el.style.overflow = 'hidden';

                }, 0)
            },


        },
        mounted() {
            console.log(this.item.name + this.depth);
        },
        components: {
            MenuItem
        }
    }
</script>

<style lang="scss" scoped>

    .menu-item {
        color   : #fff;
        padding : 1rem 0rem;

        .menu-item-header {
            display         : flex;
            justify-content : space-between;

            h2 {
                font-size   : 1.8rem;
                user-select : none;
                margin : 0;
                a{
                    font-size   : 1.8rem;
                    text-decoration : none;
                }
            }

            svg {
                width         : 1.5rem;
                height       : 2rem;
                margin-right : 2rem;
            }
        }

        .submenu {
            transition  : all 0.3s;
            padding-top : 1rem;
        }
    }


</style>
