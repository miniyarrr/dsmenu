<template>
    <div class="list container">
        <div class="item-block" v-for="item in items">

            <div class="input-box">
                <label>Название</label>
                <input type="text" v-model="item.title">
            </div>
            <div class="input-box">
                <label>Код</label>
                <input type="text" v-model="item.code">
            </div>
            <div class="input-box">
                <label>Ссылка</label>
                <input type="text" v-model="item.link">
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';


    export default {
        name: "List",
        data() {
            return {
                items: []
            }
        },
        methods: {},
        async mounted() {
            // debugger;
            var res = await axios.post('/menuItems');
            this.items = res.data.main_data_models.MenuItems;
            console.log(this.items)
        }
    }
</script>

<style scoped lang="scss">
    .list {
        margin-top : 5rem;

        .item-block {
            display       : flex;
            max-width     : 54%;
            border        : 1px solid #ccbdbd;
            padding       : 1rem;
            margin-bottom : 1rem;
            border-radius  : 5px;

            .input-box {
                display        : flex;
                flex-direction : column;
                padding        : 0.5rem;

                input {
                    padding       : 0.5rem;
                    border-radius : 5px;
                    border        : 1px solid #ccbdbd;
                    outline : none;
                }
            }
        }
    }
</style>