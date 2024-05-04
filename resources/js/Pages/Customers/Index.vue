<script setup>
import {router} from "@inertiajs/vue3";

defineProps({
    "customers": Object
})

function destroy(id){
    router.delete('/customers/'+id);
}

function edit(id){
    router.get("/customers/edit/"+id);
}
</script>

<template>
    <div class="card col-5 offset-3">
        <table class="table table-bordered table-hover table-sm">
            <thead>
            <tr>
                <th>Name</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="customer in customers">
                <td>{{ customer.name }}</td>
                <td>
                    <button class="btn  btn-outline-info btn-sm">Edit</button>
                    <button class="btn  btn-outline-primary btn-sm" @click="edit(customer.id)">Edit</button>
                    <button class="btn btn-outline-danger btn-sm" @click="destroy(customer.id)">Delete</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<style scoped>

</style>
