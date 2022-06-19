import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

export default function useResources() {
    const resources = ref([])
    const resource = ref([])

    const errors = ref('')
    const router = useRouter()

    const getResources = async () => {
        let response = await axios.get('/api/resource')
        resources.value = response.data.data
    }

    const getResource = async (id) => {
        let response = await axios.get(`/api/resource/${id}`)
        resource.value = response.data.data.resourceable;
        resource.value.type = response.data.data.resourceable_type;
    }

    const storeResource = async (data) => {
        errors.value = ''
        try {
            console.log(data);
            await axios.post('/api/resource', data)
            await router.push({ name: 'resource.index' })
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + ' ';
                }
            }
        }
    }

    const updateResource = async (id) => {
        errors.value = ''
        try {
            await axios.patch(`/api/resource/${id}`, resource.value)
            await router.push({ name: 'resource.index' })
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + ' ';
                }
            }
        }
    }

    const destroyResource = async (id) => {
        await axios.delete(`/api/resource/${id}`)
    }

    return {
        errors,
        resources,
        resource,
        getResources,
        getResource,
        storeResource,
        updateResource,
        destroyResource
    }
}
