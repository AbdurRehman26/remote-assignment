<template>
    <div class="mt-2 mb-6 text-sm text-red-600" v-if="errors !== ''">
        {{ errors }}
    </div>

    <form class="space-y-6" @submit.prevent="saveResource">
        <div class="space-y-4 rounded-md shadow-sm">
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700">Resource Type</label>
                <div class="mt-1">
                    <select type="text" name="name" id="name"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="resource.type">
                        <option value="pdf">PDF</option>
                        <option value="link">Link</option>
                        <option value="html_snippet">HTML Snippet</option>
                    </select>
                </div>
            </div>

            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <div class="mt-1">
                <input type="text" name="title" id="title"
                       class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                       v-model="resource.title">
            </div>

            <div v-if="isOfType(resource.type, 'html_snippet')">

                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <div class="mt-1">
                    <textarea type="text" name="description" id="description"
                              class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                              v-model="resource.description"></textarea>
                </div>

                <label for="snippet" class="block text-sm font-medium text-gray-700">Snippet</label>
                <div class="mt-1">
                    <textarea type="text" name="snippet" id="snippet"
                              class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                              v-model="resource.snippet"></textarea>
                </div>

            </div>

            <div v-if="isOfType(resource.type, 'link')">

                <label for="link" class="block text-sm font-medium text-gray-700">Link</label>
                <div class="mt-1">
                    <input type="text" name="link" id="link"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="resource.link">
                </div>


                <label for="new_tab" class="block text-sm font-medium text-gray-700">Open in new tab</label>
                <div class="mt-1">
                    <input type="checkbox" name="new_tab" id="new_tab"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="resource.new_tab"/>
                </div>

            </div>


        </div>

        <button type="submit"
                :disabled="!resource.type"
                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-800 rounded-md border border-transparent ring-gray-300 transition duration-150 ease-in-out hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25">
            Update
        </button>
    </form>
</template>


<script>
import useResources from '../../composables/resources'
import { onMounted } from 'vue';

export default {
    props: {
        id: {
            required: true,
            type: String
        }
    },

    setup(props) {
        const { errors, resource, updateResource, getResource } = useResources()

        onMounted(() => getResource(props.id))

        const saveResource = async () => {
            await updateResource(props.id)
        }

        const isOfType = (type, id) => {
            return type === id;
        }

        return {
            errors,
            resource,
            isOfType,
            saveResource
        }
    }
}
</script>
