<template>
    <div v-if="contacts.length > 0">
        <jet-section-border />

        <jet-action-section class="mt-10 sm:mt-0">
            <template #title>
                Contacts
            </template>

            <template #description>
                All contacts.
            </template>

            <template #content>
                <div class="space-y-6">
                    <div class="flex items-center justify-between" v-for="contact in contacts" :key="contact.id">
                        <div class="flex items-start justify-betweenr">
                            <div class="w-64">{{ contact.name }}</div>
                            <div class="w-64">{{ contact.email }}</div>
                        </div>
                    </div>
                </div>
            </template>
        </jet-action-section>
    </div>
</template>

<script>
    import JetActionSection from '@/Jetstream/ActionSection'
    import JetSectionBorder from '@/Jetstream/SectionBorder'

    export default {
        components: {
            JetActionSection,
            JetSectionBorder,
        },

        props: [
            'contacts',
        ],
    }
</script>
