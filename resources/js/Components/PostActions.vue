<script setup>
import { ref } from 'vue'
import { Link, router } from '@inertiajs/vue3'

const props = defineProps({
    post: Object,
    showShowButton: {
        type: Boolean,
        default: false,
    },
})

const confirmingDeleteId = ref(null)

const confirmDelete = (id) => {
    confirmingDeleteId.value = id
}

const executeDelete = () => {
    router.delete(route('posts.destroy', confirmingDeleteId.value))
    confirmingDeleteId.value = null
}

const cancelDelete = () => {
    confirmingDeleteId.value = null
}

</script>

<template>
    <div class="flex items-center gap-1">
        <template v-if="!post.deleted_at">
            <Link
                v-if="showShowButton"
                :href="route('posts.show', post.id)"
                class="rounded bg-blue-600 px-3 py-1 text-xs font-semibold text-white shadow-sm hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
            >
                Show
            </Link>
            <Link
                :href="route('posts.edit', post.id)"
                class="rounded bg-yellow-500 px-3 py-1 text-xs font-semibold text-white shadow-sm hover:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2"
            >
                Edit
            </Link>
            <button
                @click="confirmDelete(post.id)"
                class="rounded bg-red-600 px-3 py-1 text-xs font-semibold text-white shadow-sm hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
            >
                Delete
            </button>
        </template>
    </div>

    <Teleport to="body">
        <div
            v-if="confirmingDeleteId"
            class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/50"
        >
            <div class="mx-4 w-full max-w-md rounded-lg bg-white p-6 shadow-xl">
                <h3 class="text-lg font-semibold text-gray-900">Delete Post</h3>
                <p class="mt-2 text-sm text-gray-600">
                    Are you sure you want to delete this post? This action can be undone later via restore.
                </p>
                <div class="mt-6 flex justify-end gap-3">
                    <button
                        @click="cancelDelete"
                        class="rounded-md bg-gray-500 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
                    >
                        Cancel
                    </button>
                    <button
                        @click="executeDelete"
                        class="rounded-md bg-red-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white shadow-sm hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                    >
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </Teleport>
</template>
