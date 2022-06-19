<template>

        <header class="flex leading-tight p-2 md:p-4">
            <h1 class=" text-lg">
                Type : {{ item.resourceable_type.replace('_', ' ').toUpperCase() }}
            </h1>
        </header>


    <div class="p-2 md:p-4">

        <h3 class="text-lg">
            Title : {{ item.resourceable.title }}
        </h3>

        <div v-if="isOfType('html_snippet')">

            <h4 class="text-lg">
                Description : {{item.resourceable.description}}
                <br/>
                <br/>
            </h4>

            <code>{{ item.resourceable.snippet }}</code>

        </div>


    </div>

</template>

<script>

import ItemCardFooter from "./ItemCardFooter";

export default {
    name: "ItemCard",
    components: {
        ItemCardFooter
    },

    props: {
        item: {
            required: true,
            type: Object
        }
    },

    setup(props){

        const isOfType = (type) => {
            return props.item.resourceable_type === type;
        }

        return {
            isOfType
        }
    }
}
</script>
