<template>
    <div class="sidebar" :class="{'active':!menu_open}" :style="{'background-color':menu_bg_color}">
        <div class="sidebar-top" @click="menu_open=!menu_open">
            <svg xmlns="http://www.w3.org/2000/svg" width="30.531" height="15.25" viewBox="0 0 30.531 15.25">
                <path :style="{'fill':menu_text_color}"
                        id="menu.svg" class="cls-1"
                      d="M373.3,35.374h28.623a0.954,0.954,0,1,0,0-1.907H373.3A0.954,0.954,0,1,0,373.3,35.374Zm28.623,4.769H373.3a0.954,0.954,0,1,0,0,1.907h28.623A0.954,0.954,0,1,0,401.924,40.143Zm0,6.676H382.842a0.954,0.954,0,1,0,0,1.907h19.082A0.954,0.954,0,1,0,401.924,46.819Z"
                      transform="translate(-372.344 -33.469)"/>
            </svg>

        </div>
        <div class="sidebar-view" v-if="!menu_open">
            <ul class="menu-main-ul">
                <MenuItem v-for="menu_item in menu"
                          :item="menu_item"
                          :depth="1"
                          :menu_text_color="menu_text_color"
                >

                </MenuItem>
            </ul>
        </div>
    </div>
</template>

<script>
    import MenuItem from './MenuItem';

    export default {
        name: "Sidebar",
        data() {
            return {
                menu_open: false,
                // menu: [
                //     {
                //         name: 'menu1',
                //         expanded: false,
                //         children: [
                //             {
                //                 name: 'menu2',
                //                 expanded: false,
                //                 children: [
                //                     {
                //                         name: 'menu21',
                //                     }, {
                //                         name: 'menu22',
                //                         expanded: false,
                //                         children: [
                //                             {
                //                                 name: 'menu221',
                //                             }, {
                //                                 name: 'menu222',
                //                             }
                //                         ]
                //                     }
                //                 ]
                //             }, {
                //                 name: 'menu3',
                //             }, {
                //                 name: 'menu4',
                //             },
                //         ],
                //
                //     },
                //     {
                //         name: 'menu3',
                //         expanded: false,
                //         children: [
                //             {
                //                 name: 'menu2',
                //                 expanded: false,
                //                 children: [
                //                     {
                //                         name: 'menu21',
                //                     }, {
                //                         name: 'menu22',
                //                         expanded: false,
                //                         children: [
                //                             {
                //                                 name: 'menu221',
                //                             }, {
                //                                 name: 'menu222',
                //                             }
                //                         ]
                //                     }
                //                 ]
                //             }, {
                //                 name: 'menu3',
                //             }, {
                //                 name: 'menu4',
                //             },
                //         ]
                //     }
                // ]
            }
        },
        props:['menu','menu_bg_color', 'menu_text_color'],


        components: {
            MenuItem
        }
    }
</script>

<style scoped lang="scss">
    .sidebar {
        width            : 5rem;
        height           : 100vh;
        /*<!--margin-top       : -4rem;-->*/
        /*background-color : #515585;*/
        transition       : all ease-in-out .3s;
        overflow-y       : auto;

        &.active {
            width : 25rem;

            .sidebar-top {
                justify-content : flex-start;
            }
        }

        .sidebar-top {
            height          : 4rem;
            display         : flex;
            justify-content : center;
            align-items     : center;
            border-bottom   : 1px solid #fff;
            position        : relative;
            cursor          : pointer;

            svg {
                position  : absolute;
                top       : 50%;
                transform : translateY(-50%);
                left      : 10px;
            }

            path {
                fill   : #fff;
                cursor : pointer;
            }
        }

        .sidebar-view {
            .menu-main-ul {
                padding-left : 1rem;
                margin-top   : 1rem;
            }
        }
    }
</style>