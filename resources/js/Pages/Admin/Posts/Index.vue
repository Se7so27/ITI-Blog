<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, router, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

const props = defineProps({
    posts: Object,
})

const page = usePage()
const flashSuccess = computed(() => page.props.flash?.success)

const destroy = (id) => {
    if (confirm('Delete this post?')) {
        router.delete(route('admin.posts.destroy', id))
    }
}

const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString('en-GB', {
        day: 'numeric',
        month: 'short',
        year: 'numeric',
    })
}
</script>

<template>
    <Head title="Admin - Posts" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Manage Posts</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div v-if="flashSuccess" class="mb-4 rounded-md bg-green-50 p-4 text-sm font-medium text-green-800">
                    {{ flashSuccess }}
                </div>

                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Title</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Author</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Created</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            <tr v-if="posts.data.length === 0">
                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No posts found.</td>
                            </tr>
                            <tr v-for="post in posts.data" :key="post.id" :class="{ 'bg-red-50': post.deleted_at }">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                    <Link :href="route('posts.show', post.id)" class="text-indigo-600 hover:text-indigo-900">
                                        {{ post.title }}
                                    </Link>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ post.user?.name }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span v-if="post.deleted_at" class="inline-flex rounded-full bg-red-100 px-2 text-xs font-semibold leading-5 text-red-800">Deleted</span>
                                    <span v-else class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800">Active</span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ formatDate(post.created_at) }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <button @click="destroy(post.id)" class="rounded bg-red-600 px-3 py-1 text-xs font-semibold text-white hover:bg-red-500">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div v-if="posts.links && posts.links.length > 3" class="border-t border-gray-200 px-6 py-4">
                        <div class="flex flex-wrap items-center gap-1">
                            <component
                                :is="link.url ? Link : 'span'"
                                v-for="(link, key) in posts.links"
                                :key="key"
                                :href="link.url || ''"
                                class="rounded-md px-3 py-1 text-sm"
                                :class="{
                                    'bg-indigo-600 text-white': link.active,
                                    'text-gray-700 hover:bg-gray-100': !link.active && link.url,
                                    'text-gray-400': !link.url,
                                }"
                                v-html="link.label"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
