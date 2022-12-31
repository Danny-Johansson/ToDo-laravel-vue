<template>
    <div class="mt-4">
        <h4>ToDos</h4>

        <ul class="list-group m-auto">
            <list-item
                :item="item"
                v-on:itemchanged="$emit('reloadlist')"
                v-for="item in items"
                :key="item.id"
                class="m-auto my-1 text-justify text-wrap"
            />
        </ul>
        <span>{{completedTodos.length}} of {{totalTodos.length}} {{ totalTodos.length === 1 ? 'ToDo' : 'ToDos' }} Completed - {{activeTodos.length}} {{ activeTodos.length === 1 ? 'ToDo' : 'ToDos' }} Left</span>
    </div>
</template>

<script>
import listItem from "./listItem.vue";

export default {
    components: {
        listItem
    },
    props: ["items"],
    computed: {
        activeTodos() {
            return this.items.filter(t => !t.completed);
        },
        completedTodos() {
            return this.items.filter(t => t.completed);
        },
        totalTodos(){
            return this.items;
        }
    },
};
</script>
