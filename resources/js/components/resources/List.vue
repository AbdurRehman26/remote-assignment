<template>

    <div class="flex place-content-end mb-4">
        <div class="px-4 py-2 text-white bg-indigo-600 hover:bg-indigo-700 cursor-pointer">
            <router-link :to="{ name: 'resource.create' }" class="text-sm font-medium">Create Resource</router-link>
        </div>
    </div>

    <div class="overflow-hidden overflow-x-auto min-w-full align-middle sm:rounded-md">

        <div class="flex flex-wrap -mx-1 lg:-mx-4">

            <div v-for="item in resources" :key="item.id" class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">
                <!-- Article -->
                <article class="overflow-hidden rounded-lg shadow-lg">
                    <ItemCardBody :item="item" />
                    <ItemCardFooter @refreshList="getResources()" :item="item" />
                </article>
            </div>


        </div>

    </div>
</template>

<script>
import useResources from '../../composables/resources'
import { onMounted } from 'vue';
import ItemCardBody from "../shared/ItemCard/ItemCardBody";
import ItemCardFooter from "../shared/ItemCard/ItemCardFooter";

export default {
    components: {
        ItemCardBody,
        ItemCardFooter
    },
    setup() {
        const { resources, getResources } = useResources()

        onMounted(getResources)

        return {
            resources,
            getResources
        }
    }
}
</script>
