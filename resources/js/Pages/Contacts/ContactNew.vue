<template>
    <jet-form-section @submitted="store">
        <template #title>
            Create Contact
        </template>

        <template #description>
            Create a new contact.
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="name" value="Name" />
                <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autofocus />
                <jet-input-error :message="form.errors.name" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="email" value="E-mail" />
                <jet-input id="email" type="text" class="mt-1 block w-full" v-model="form.email" autofocus />
                <jet-input-error :message="form.errors.email" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="phone" value="Phone" />
                <jet-input id="phone" type="text" class="mt-1 block w-full" v-model="form.phone" autofocus />
                <jet-input-error :message="form.errors.phone" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="message" value="Message" />
                <textarea id="message" class="mt-1 block w-full" v-model="form.message" autofocus></textarea>
                <jet-input-error :message="form.errors.message" class="mt-2" />
            </div>
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Contact created.
            </jet-action-message>
            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </jet-button>
        </template>
    </jet-form-section>
</template>

<script>
import JetActionMessage from '@/Jetstream/ActionMessage'
import JetButton from '@/Jetstream/Button'
import JetFormSection from '@/Jetstream/FormSection'
import JetInput from '@/Jetstream/Input'
import JetInputError from '@/Jetstream/InputError'
import JetLabel from '@/Jetstream/Label'

export default {
    components: {
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
    },

    data() {
        return {
            form: this.$inertia.form({
                name: '',
                email: '',
                phone: '',
                message: '',
            })
        }
    },

    methods: {
        store() {
            this.form.post(route('contacts.store'), {
                errorBag: 'contactStore',
                preserveScroll: true,
                onSuccess: () => {
                    this.form.reset()
                }
            });
        },
    },
}
</script>
