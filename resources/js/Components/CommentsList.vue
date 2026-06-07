<script setup>
import { useForm, Link, usePage } from '@inertiajs/vue3'

const props = defineProps({
    post: Object,
})

const page = usePage()
const isAuthenticated = !!page.props.auth.user

const form = useForm({
    body: '',
    post_id: props.post.id,
})

const submit = () => {
    form.post(route('comments.store'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
    })
}
</script>

<template>
    <div class="mt-8 border-t border-gray-200 pt-6">
        <h3 class="text-lg font-semibold text-gray-900">Comments</h3>

        <div v-if="post.comments && post.comments.length" class="mt-4 space-y-4">
            <div
                v-for="comment in post.comments"
                :key="comment.id"
                class="rounded-lg bg-gray-50 p-4"
            >
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-900">{{ comment.user?.name ?? 'Unknown' }}</span>
                    <span class="text-xs text-gray-500">{{ comment.created_at }}</span>
                </div>
                <p class="mt-2 text-sm text-gray-700 whitespace-pre-wrap">{{ comment.body }}</p>
            </div>
        </div>
        <p v-else class="mt-4 text-sm text-gray-500">No comments yet.</p>

        <form v-if="isAuthenticated" @submit.prevent="submit" class="mt-6 space-y-4">
            <textarea
                v-model="form.body"
                rows="3"
                placeholder="Write a comment..."
                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
            />
            <p v-if="form.errors.body" class="text-sm text-red-600">{{ form.errors.body }}</p>
            <button
                type="submit"
                :disabled="form.processing"
                class="rounded-md bg-indigo-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50"
            >
                Post Comment
            </button>
        </form>
        <p v-else class="mt-6 text-sm text-gray-500">
            <Link :href="route('login')" class="text-indigo-600 hover:text-indigo-500 underline">Log in</Link> to leave a comment.
        </p>
    </div>
</template>