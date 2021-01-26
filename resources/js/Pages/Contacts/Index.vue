<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Contacts
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <contact-new></contact-new>
                <contact-list :contacts="contacts"></contact-list>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import JetSectionBorder from '@/Jetstream/SectionBorder'
    import ContactNew from './ContactNew'
    import ContactList from './ContactList'

    export default {
        props: [
            'contacts',
        ],

        components: {
            AppLayout,
            JetSectionBorder,
            ContactNew,
            ContactList,
        },
    }
</script>
