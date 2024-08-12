<script setup>
import PostForm from '@/Components/PostForm.vue';
import PostItems from '@/Components/PostItems.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head} from '@inertiajs/vue3';
defineProps(['posts'])
</script>

<template>
    <Head title="People Books">
        <meta name="description" content="People Books description"></meta>
    </Head>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">People Books</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                       <PostForm></PostForm>
                    </div>
                </div>
                <div class="mt-6 bg-white dark:bg-gray-800 shadow-md rounded-lg divide-y">
                    <PostItems 
                        v-for=" post in posts" 
                        :key="`posts-${post.id}`" 
                        :post="post"
                        >
                    </PostItems>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
