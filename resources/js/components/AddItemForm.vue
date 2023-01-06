<template>
    <div class="mt-3">
        <div class="input-group m-2 w-100">
            <input
                type="text"
                placeholder="Add Item"
                class="form-control border"
                v-model="item.name"
                v-on:keyup.enter="addItem()"
            />
            <div class="input-group-append">
                <button
                    class="ms-2 btn"
                    :class="[item.name ? 'btn-success' : 'btn-secondary']"
                    @click="addItem()"
                >
                    Add
                </button>
            </div>

        </div>
    </div>
</template>
<script>
export default {
    data: function() {
        return {
            item: {
                name: ""
            }
        };
    },
    methods: {
        addItem() {
            if (this.item.name === "") {
                return;
            }
            axios
                .post("https://todo-api.danny-johansson.online/api/items/store", {
                    item: this.item
                })
                .then(res => {
                    if (res.status === 201) {
                        this.item.name = "";
                        this.$emit("reloadlist");
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
};
</script>

<style scoped>
.active {
    color: white;
    background-color: blue;
}
.inactive {
    color: gray;
}
</style>
