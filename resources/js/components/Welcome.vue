<template>
    <div class="container w-50 m-auto text-center mt-3">
        <h1 class="text-danger">Danny Johansson's</h1>
        <h1 class="text-danger">ToDo List - Laravel with Vue</h1>
        <add-item-form v-on:reloadlist="getItems()" />
        <list-view
            :items="items"
            v-on:reloadlist="getItems()"
            class="text-center"
        />
    </div>
</template>
<script>
import listView from "./listView.vue";
import addItemForm from "./addItemForm.vue";

export default {
    components: {
        addItemForm,
        listView
    },

    data: function() {
        return {
            items: []
        };
    },
    methods: {
        getItems() {
            axios
                .get("https://todo-api.danny-johansson.online/api/items")
                .then(res => {
                    this.items = res.data;
                })
                .catch(error => {
                    console.log(error);
                });
        }
    },
    created() {
        this.getItems();
    }
};
</script>
