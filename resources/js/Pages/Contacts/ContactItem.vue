<template>
    <div>
        <button
            class="cursor-pointer ml-6 text-sm text-gray-400 underline focus:outline-none"
            @click="updating = true">
            Edit
        </button>

        <button class="cursor-pointer ml-6 text-sm text-red-500 focus:outline-none"
                @click="destroying = true">
            Delete
        </button>

        <jet-dialog-modal :show="updating" @close="updating = false">
            <template #title>
                Update Contact
            </template>

            <template #content>
                <div class="col-span-6 sm:col-span-4">
                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="name" value="Name" />
                        <jet-input type="text" class="mt-1 block w-full" v-model="updateForm.name" autofocus />
                        <jet-input-error :message="updateForm.errors.name" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="email" value="E-mail" />
                        <jet-input type="text" class="mt-1 block w-full" v-model="updateForm.email" autofocus />
                        <jet-input-error :message="updateForm.errors.email" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="phone" value="Phone" />
                        <jet-input type="text" class="mt-1 block w-full" v-model="updateForm.phone" autofocus />
                        <jet-input-error :message="updateForm.errors.phone" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="message" value="Message" />
                        <textarea class="mt-1 block w-full" v-model="updateForm.message" autofocus></textarea>
                        <jet-input-error :message="updateForm.errors.message" class="mt-2" />
                    </div>
                </div>
            </template>

            <template #footer>
                <jet-secondary-button @click.native="updating = false">
                    Nevermind
                </jet-secondary-button>

                <jet-button class="ml-2" @click.native="update" :class="{ 'opacity-25': updateForm.processing }" :disabled="updateForm.processing">
                    Save
                </jet-button>
            </template>
        </jet-dialog-modal>

        <jet-confirmation-modal :show="destroying" @close="destroying = false">
            <template #title>
                Delete Contact
            </template>

            <template #content>
                Are you sure you would like to delete this Contact?
            </template>

            <template #footer>
                <jet-secondary-button @click.native="destroying = false">
                    Nevermind
                </jet-secondary-button>

                <jet-danger-button class="ml-2" @click.native="destroy" :class="{ 'opacity-25': destroyForm.processing }" :disabled="destroyForm.processing">
                    Delete Contact
                </jet-danger-button>
            </template>
        </jet-confirmation-modal>

    </div>
</template>

<script>
    import JetButton from '@/Jetstream/Button'
    import JetConfirmationModal from "@/Jetstream/ConfirmationModal";
    import JetDangerButton from "@/Jetstream/DangerButton";
    import JetDialogModal from "@/Jetstream/DialogModal";
    import JetFormSection from "@/Jetstream/FormSection";
    import JetInput from "@/Jetstream/Input";
    import JetInputError from "@/Jetstream/InputError";
    import JetLabel from "@/Jetstream/Label";
    import JetSecondaryButton from "@/Jetstream/SecondaryButton";

    export default {
        components: {
            JetButton,
            JetConfirmationModal,
            JetDangerButton,
            JetDialogModal,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
            JetSecondaryButton,
        },

        props: [
            'contact',
        ],

        data() {
            return {
                updateForm: this.$inertia.form({
                    name: this.contact.name,
                    email: this.contact.email,
                    phone: this.contact.phone,
                    message: this.contact.message,
                }),
                updating: false,

                destroyForm: this.$inertia.form(),
                destroying: false,
            }
        },

        methods: {
            update() {
                this.updateForm.put(route('contacts.update', this.contact), {
                    errorBag: 'contactUpdate',
                    preserveScroll: true,
                    onSuccess: () => {
                        this.updating = false
                    }
                });
            },

            destroy() {
                this.destroyForm.delete(route('contacts.destroy', this.contact), {
                    errorBag: 'default',
                    preserveScroll: true,
                    onSuccess: () => {
                        this.destroying = false
                        this.destroyForm.reset()
                    }
                });
            },
        },
    }
</script>
