<template>
    <li class="menu-item">
        <h2>{{item.name}}</h2>

        <transition name="tree-transition"
                    @before-enter="beforeEnter"
                    @enter="enter"
                    @after-enter="afterEnter"
                    @leave="leave"
                    @beforeLeave="beforeLeave"
        >

            <ul  :style="{'padding-left':depth+'rem'}">

                <MenuItem
                        v-for="child in item.children"
                        :item="child"
                        :depth="depth+1"
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
        mounted(){
          console.log(this.item.name + this.depth);
        },
        components: {
            MenuItem
        }
    }
</script>

<style lang="scss" scoped>

    .menu-item{
        color : #fff;
        h2{
            font-size : 1.8rem;
        }
    }

   
</style>
