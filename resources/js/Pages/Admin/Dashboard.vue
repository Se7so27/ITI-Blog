<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link } from '@inertiajs/vue3'

defineProps({
    postsCount: Number,
    commentsCount: Number,
})
</script>

<template>
    <Head title="Admin Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Admin Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="mb-6 grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div class="overflow-hidden rounded-lg bg-white shadow">
                        <div class="p-6">
                            <div class="text-sm font-medium text-gray-500">Total Posts</div>
                            <div class="mt-1 text-3xl font-bold text-gray-900">{{ postsCount }}</div>
                        </div>
                    </div>
                    <div class="overflow-hidden rounded-lg bg-white shadow">
                        <div class="p-6">
                            <div class="text-sm font-medium text-gray-500">Total Comments</div>
                            <div class="mt-1 text-3xl font-bold text-gray-900">{{ commentsCount }}</div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <Link :href="route('admin.posts.index')" class="block overflow-hidden rounded-lg bg-white shadow transition hover:shadow-md">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900">Manage Posts</h3>
                            <p class="mt-1 text-sm text-gray-500">View, filter and delete all posts</p>
                        </div>
                    </Link>
                    <Link :href="route('admin.comments.index')" class="block overflow-hidden rounded-lg bg-white shadow transition hover:shadow-md">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900">Manage Comments</h3>
                            <p class="mt-1 text-sm text-gray-500">View and delete all comments</p>
                        </div>
                    </Link>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
