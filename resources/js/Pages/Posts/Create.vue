<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'

const form = useForm({
    title: '',
    body: '',
    image: null,
    tags: '',
})

const submit = () => {
    form.post(route('posts.store'), {
        forceFormData: true,
    })
}
</script>

<template>
    <Head title="Create Post" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Create Post</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <form @submit.prevent="submit" class="space-y-6">
                            <div>
                                <InputLabel for="title" value="Title" />
                                <TextInput id="title" v-model="form.title" class="mt-1 block w-full" />
                                <InputError :message="form.errors.title" class="mt-2" />
                            </div>

                            <div>
                                <InputLabel for="body" value="Body" />
                                <textarea
                                    id="body"
                                    v-model="form.body"
                                    rows="5"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                />
                                <InputError :message="form.errors.body" class="mt-2" />
                            </div>

                            <div>
                                <InputLabel for="image" value="Image" />
                                <input
                                    id="image"
                                    type="file"
                                    accept=".jpg,.png"
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:rounded-md file:border-0 file:bg-indigo-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-indigo-700 hover:file:bg-indigo-100"
                                    @input="form.image = $event.target.files[0]"
                                />
                                <InputError :message="form.errors.image" class="mt-2" />
                            </div>

                            <div>
                                <InputLabel for="tags" value="Tags" />
                                <TextInput
                                    id="tags"
                                    v-model="form.tags"
                                    class="mt-1 block w-full"
                                    placeholder="laravel, php, blog"
                                />
                                <InputError :message="form.errors.tags" class="mt-2" />
                            </div>

                            <div class="flex items-center gap-4">
                                <button
                                    type="submit"
                                    :disabled="form.processing"
                                    class="rounded-md bg-green-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white shadow-sm hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 disabled:opacity-50"
                                >
                                    Create
                                </button>
                                <Link
                                    :href="route('posts.index')"
                                    class="rounded-md bg-gray-500 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white shadow-sm hover:bg-gray-400"
                                >
                                    Cancel
                                </Link>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
