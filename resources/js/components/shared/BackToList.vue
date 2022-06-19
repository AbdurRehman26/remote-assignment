<template>

    <div class="flex place-content-end mb-4">
        <div class="px-4 py-2 text-white bg-indigo-600 hover:bg-indigo-700 cursor-pointer">
            <router-link :to="{ name: 'resource.index' }" class="text-sm font-medium">Back to List</router-link>
        </div>
    </div>

</template>

<script>
export default {
    name: "BackToList"
}
</script>
