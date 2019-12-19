<template>
    <li>
        {{item.name}}

        <transition name="tree-transition"
                    @before-enter="beforeEnter"
                    @enter="enter"
                    @after-enter="afterEnter"
                    @leave="leave"
                    @beforeLeave="beforeLeave"
        >
            <ul v-if="item.children">

                <MenuItem
                        v-for="child in item.children"
                        :item="child"
                        :depth="child.depth+1"
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

        },
        methods: {

            toggleLevel(element, e) {
                !element.hasOwnProperty('visible') ? this.$set(element, 'visible', false) : false;
                element.visible = !element.visible;

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

        components: {
            MenuItem
        }
    }
</script>

<style lang="scss" scoped>


    .tree-element-header {
        display    : flex;
        margin-top : -1px;


        .left-part {
            min-width : 50%;
            display   : flex;

            h2 {
                font-size   : 2.5rem;
                font-weight : 600;
            }

            .header-wrapper {
                display      : flex;
                width        : 100%;
                height       : 100%;
                border       : 1px solid #eee;
                border-right : none;
                align-items  : center;
                padding-left : 2rem;

            }

            .add-question {
                margin-left : 1rem;
                cursor      : pointer;
                transition  : transform .3s;

                &:hover {
                    transform : scale(1.1);
                }

                path {
                    fill : red;
                }
            }

            .collapse-item {
                margin-left  : auto;
                margin-right : 2rem;
                padding      : 0 0.5rem;
                cursor       : pointer;
            }
        }


    }
</style>
