<template>

    <footer class="flex items-center justify-between leading-none p-2 md:p-4">

        <button @click="downloadItem(item.resourceable.name)" v-if="isOfType('pdf')" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
            Download PDF</button>

        <button @click="openLink(item.resourceable.link, item.resourceable.new_tab)" v-if="isOfType('link')" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
            Open Link</button>

        <button @click="copySnippet(item.resourceable.snippet)" v-if="isOfType('html_snippet')" class="inline-flex px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
            Copy</button>

        <button v-if="$route.name === 'resource.admin'" @click="deleteResource(item.id)"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
            Delete</button>

        <router-link v-if="$route.name === 'resource.admin'" :to="{ name: 'resource.edit', params: { id: item.id } }"
                     class="ml-1 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Edit</router-link>


    </footer>


</template>

<script>
import useResources from "../../../composables/resources";

export default {
    name: "ItemCardFooter",

    props: {
        item: {
            required: true,
            type: Object
        }
    },

    emits:['refreshList'],

    setup(props, {emit}){

        const { getResources, destroyResource } = useResources()

        const isOfType = (type) => {
            return props.item.resourceable_type === type;
        }


        const downloadItem =  ( name ) => {
            window.location.href = 'download/'+name;
        }

        const openLink = (url, inNewTab) => {
            inNewTab ? window.open(url, '_blank') : window.location.href = url;
        }

        const copySnippet = str => {
            const el = document.createElement('textarea');
            el.value = str;
            el.setAttribute('readonly', '');
            el.style.position = 'absolute';
            el.style.left = '-9999px';
            document.body.appendChild(el);
            const selected =
                document.getSelection().rangeCount > 0
                    ? document.getSelection().getRangeAt(0)
                    : false;
            el.select();
            document.execCommand('copy');
            document.body.removeChild(el);
            if (selected) {
                document.getSelection().removeAllRanges();
                document.getSelection().addRange(selected);
            }
        };

        const deleteResource = async (id) => {
            if (!window.confirm('You sure?')) {
                return
            }

            await destroyResource(id)
            emit('refreshList');
        }

        return {
            downloadItem,
            openLink,
            deleteResource,
            copySnippet,
            isOfType
        }
    }
}
</script>

<style scoped>

</style>
