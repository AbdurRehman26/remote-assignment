<template>

    <div class="flex place-content-end mb-4">
        <div class="px-4 py-2 text-white bg-indigo-600 hover:bg-indigo-700 cursor-pointer">
            <router-link :to="{ name: 'resource.create' }" class="text-sm font-medium">Create Resource</router-link>
        </div>
    </div>

    <div class="overflow-hidden overflow-x-auto min-w-full align-middle sm:rounded-md">

        <div class="flex flex-wrap -mx-1 lg:-mx-4">

            <!-- Column -->
            <div v-for="item in resources" :key="item.id" class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">

                <!-- Article -->
                <article class="overflow-hidden rounded-lg shadow-lg">

                    <header class="flex leading-tight p-2 md:p-4">
                        <h1 class="text-lg">
                            Title : {{ item.resourceable_type.replace('_', ' ').toUpperCase() }}
                        </h1>
                    </header>


                    <div class="p-2 md:p-4" v-if="isOfType(item.resourceable_type, 'html_snippet')">

                        <h4 class="text-lg">
                            {{item.resourceable.description}}
                            <br/>
                        </h4>

                        <code>{{ item.resourceable.snippet }}</code>

                    </div>


                    <footer class="flex items-center justify-between leading-none p-2 md:p-4">

                        <button @click="downloadItem(item.resourceable.name)" v-if="isOfType(item.resourceable_type, 'pdf')" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Download PDF</button>

                        <button @click="openLink(item.resourceable.link, item.resourceable.new_tab)" v-if="isOfType(item.resourceable_type, 'link')" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Open Link</button>

                        <button @click="copySnippet(item.resourceable.snippet)" v-if="isOfType(item.resourceable_type, 'html_snippet')" class="inline-flex px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Copy</button>

                        <button @click="deleteResource(item.id)"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Delete</button>

                        <router-link :to="{ name: 'resource.edit', params: { id: item.id } }"
                                     class="ml-1 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Edit</router-link>


                    </footer>

                </article>
                <!-- END Article -->

            </div>
            <!-- END Column -->

        </div>

    </div>
</template>

<script>
import useResources from '../../composables/resources'
import { onMounted } from 'vue';
import axios from 'axios'

export default {
    setup() {
        const { resources, getResources, destroyResource } = useResources()

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
            await getResources()
        }

        const isOfType = (type, id) => {
            return type === id;
        }

        onMounted(getResources)

        return {
            downloadItem,
            isOfType,
            resources,
            openLink,
            deleteResource,
            copySnippet
        }
    }
}
</script>
