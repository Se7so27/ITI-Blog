<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import PostActions from '@/Components/PostActions.vue'
import CommentsList from '@/Components/CommentsList.vue'
import { Head, Link } from '@inertiajs/vue3'

defineProps({
    post: Object,
})
</script>

<template>
    <Head :title="post.title" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ post.title }}
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="mb-4">
                            <h1 class="text-2xl font-bold text-gray-900">{{ post.title }}</h1>
                            <div class="mt-1 flex items-center gap-2 text-sm text-gray-500">
                                <span>by {{ post.user?.name ?? 'Unknown' }}</span>
                                <span>&middot;</span>
                                <span>Slug: {{ post.slug }}</span>
                            </div>
                        </div>
                        
                        <div class="mt-6 border-t border-gray-200 pt-6">
                            <p class="text-gray-700 whitespace-pre-wrap">{{ post.body }}</p>
                        </div>

                        <CommentsList :post="post" />

                        <div class="mt-8 flex items-center gap-3">
                            <Link
                                :href="route('posts.index')"
                                class="inline-flex items-center rounded-md bg-gray-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white shadow-sm hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
                            >
                                Back to Posts
                            </Link>
                            <PostActions :post="post" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>