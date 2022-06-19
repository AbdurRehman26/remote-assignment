<template>
    <input type="file" accept=".pdf"  @change="onChange($event)">
</template>

<script>
export default {
    props: ['modelValue'],
    methods: {
        onChange(event) {
            let self = this;
            const formData = new FormData();
            formData.append('file', event.target.files[0])
            axios.post('/api/upload-file', formData, {
                headers: {
                    'Content-Type': formData.type
                }
            }).then(res => {
                self.$emit('update:modelValue', res.data);
            })
        },
    },
};
</script>
