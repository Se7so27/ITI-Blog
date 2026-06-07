<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'

const props = defineProps({
    post: Object,
})

const form = useForm({
    title: props.post.title,
    body: props.post.body,
})

const submit = () => {
    form.put(route('posts.update', props.post.id))
}
</script>

<template>
    <Head :title="`Edit ${post.title}`" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Edit Post
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="submit" class="space-y-6">
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                                <input
                                    id="title"
                                    v-model="form.title"
                                    type="text"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    :class="{ 'border-red-500 focus:border-red-500 focus:ring-red-500': form.errors.title }"
                                />
                                <p v-if="form.errors.title" class="mt-1 text-sm text-red-600">
                                    {{ form.errors.title }}
                                </p>
                            </div>

                            <div>
                                <label for="body" class="block text-sm font-medium text-gray-700">Body</label>
                                <textarea
                                    id="body"
                                    v-model="form.body"
                                    rows="5"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    :class="{ 'border-red-500 focus:border-red-500 focus:ring-red-500': form.errors.body }"
                                ></textarea>
                                <p v-if="form.errors.body" class="mt-1 text-sm text-red-600">
                                    {{ form.errors.body }}
                                </p>
                            </div>

                            <div class="flex items-center gap-4">
                                <button
                                    type="submit"
                                    class="inline-flex items-center rounded-md bg-green-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white shadow-sm hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 disabled:opacity-25"
                                    :disabled="form.processing"
                                >
                                    <span v-if="form.processing" class="mr-2 inline-block h-4 w-4 animate-spin rounded-full border-2 border-white border-t-transparent"></span>
                                    Update
                                </button>
                                <Link
                                    :href="route('posts.index')"
                                    class="inline-flex items-center rounded-md bg-gray-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white shadow-sm hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
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