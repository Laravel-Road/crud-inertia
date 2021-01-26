<template>
    <div class="mt-6 -mb-1 flex flex-wrap">
        <template v-for="(link, key) in links">
            <div v-if="link.url === null"
                 :key="key"
                 class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md"
                 :class="{ 'ml-auto': link.label === 'Next' }">
                <span v-html="link.label"></span>
            </div>
            <inertia-link v-else
                          :key="key"
                          class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
                          :class="{ 'bg-white': link.active, 'ml-auto': link.label === 'Next' }"
                          :href="link.url">
                <span v-html="link.label"></span>
            </inertia-link>
        </template>
    </div>
</template>

<script>
export default {
    props: {
        links: Array,
    },
}
</script>
