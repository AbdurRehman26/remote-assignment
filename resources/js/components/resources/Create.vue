<template>

    <BackToList></BackToList>

    <div class="mt-2 mb-6 text-sm text-red-600" v-if="errors !== ''">
        {{ errors }}
    </div>

    <form class="space-y-6" @submit.prevent="saveResource">
        <div class="space-y-4 rounded-md shadow-sm">
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700">Resource Type</label>
                <div class="mt-1">
                    <select type="text" name="name" id="name"
                           class="block p-2 mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="form.type">
                        <option value="pdf">PDF</option>
                        <option value="link">Link</option>
                        <option value="html_snippet">HTML Snippet</option>
                    </select>
                </div>
            </div>

            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <div class="mt-1">
                <input type="text" name="title" id="title"
                       class="block mt-1 p-2 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                       v-model="form.title">
            </div>


            <div v-if="isOfType('html_snippet')">

                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <div class="mt-1">
                    <textarea type="text" name="description" id="description"
                              class="block p-2 mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                              v-model="form.description"></textarea>
                </div>

                <label for="snippet" class="block text-sm font-medium text-gray-700">Snippet</label>
                <div class="mt-1">
                    <textarea type="text" name="snippet" id="snippet"
                              class="block p-2 mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                              v-model="form.snippet"></textarea>
                </div>

            </div>

            <div v-if="isOfType('link')">

                <label for="link" class="block text-sm font-medium text-gray-700">Link</label>
                <div class="mt-1">
                    <input type="text" name="link" id="link"
                              class="block p-2 mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                              v-model="form.link">
                </div>


                <label for="new_tab" class="block text-sm font-medium text-gray-700">Open in new tab</label>
                <div class="mt-1">
                    <input type="checkbox" name="new_tab" id="new_tab" v-model="form.new_tab"/>
                </div>

            </div>

            <div v-if="isOfType('pdf')">

                <label for="file" class="block text-sm font-medium text-gray-700">File</label>
                <div class="mt-1">
                    <FileUpload v-model="form.file"></FileUpload>
                </div>
            </div>
        </div>

        <button type="submit"
                :disabled="!form.type"
                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-800 rounded-md border border-transparent ring-gray-300 transition duration-150 ease-in-out hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25">
            Create
        </button>
    </form>
</template>

<script>
import useResources from '../../composables/resources'
import { reactive, ref } from 'vue'
import FileUpload from '../../components/shared/FileUpload.vue';
import BackToList from '../../components/shared/BackToList.vue';

export default {
    components: {
        FileUpload,
        BackToList
    },

    setup() {
        const form = reactive({
            type: '',
            title: '',
            description: '',
            snippet: '',
            file: ''
        })

        const { errors, storeResource } = useResources()

        const saveResource = async () => {
            await storeResource({ ...form })
        }

        const isOfType = (id) => {
            return form.type === id;
        }

        return {
            form,
            errors,
            saveResource,
            isOfType
        }
    }
}
</script>
