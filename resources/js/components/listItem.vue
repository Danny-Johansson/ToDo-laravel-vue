<template>
    <li class="list-group-item d-flex justify-content-between w-75"  @dblclick="startEditing()">
        <input
            v-if="!this.item.editing"
            type="checkbox"
            @change="completeItem()"
            :checked=item.completed
            class="mr-3 mt-2 form-check float-start"
            style="height:1.5em;width:1.5em;"
        >

        <span v-if="!this.item.editing" :class="[item.completed ? 'completed' : '', 'item','align-bottom','d-inline-block','pt-2']">{{ item.name }}</span>
        <input
               class="edit mx-auto"
               ref="edit_field"
               v-show="this.item.editing"
               @keyup.esc="cancelEditing"
               @keyup.enter="finishEditing"
               @blur="finishEditing"
               :value="item.name">
        <button v-if="!this.item.editing" class="btn btn-danger ml-3 float-end" @click="removeItem()">X</button>
    </li>
</template>

<script>
export default {
    props: ["item"],
    methods: {
        completeItem() {
            axios
                .put(`api/item/${this.item.id}/complete`)
                .then(res => {
                    if (res.status === 200) {
                        this.$emit("itemchanged");
                    }
                })
                .catch(error => {
                    console.log("error from axios put", error);
                });
        },
        startEditing(){
            this.item.editing = true;
            this.$nextTick(() => {
                this.$refs.edit_field.focus();
            })
        },
        cancelEditing(){
            this.item.editing = false;
        },
        finishEditing(){
            this.updateItem(this.$refs.edit_field.value)
            this.item.editing = false;
        },
        updateItem(new_name) {
            axios
                .put(`api/item/${this.item.id}/update`, {
                    name: new_name
                })
                .then(res => {
                    if (res.status === 200) {
                        this.$emit("itemchanged");
                    }
                })
                .catch(error => {
                    console.log("error from axios put", error);
                });
        },
        removeItem() {
            axios
                .delete(`api/item/${this.item.id}`)
                .then(res => {
                    if (res.status === 200) {
                        this.$emit("itemchanged");
                    }
                })
                .catch(error => {
                    console.log("error from axios delete ", error);
                });
        }
    }
};
</script>

<style>
.completed {
    text-decoration: line-through;
    color: gray;
}
.item {
    word-break: break-all;
}
</style>
