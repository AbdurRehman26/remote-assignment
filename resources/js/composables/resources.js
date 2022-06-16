import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

export default function useResources() {
    const resources = ref([])

    const errors = ref('')
    const router = useRouter()

    const getResources = async () => {
        let response = await axios.get('/api/companies')
        resources.value = response.data.data
    }

    const storeResource = async (data) => {
        errors.value = ''
        try {
            await axios.post('/api/companies', data)
            await router.push({ name: 'companies.index' })
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + ' ';
                }
            }
        }
    }

    return {
        errors,
        resources,
        getResources,
        storeResource
    }
}
