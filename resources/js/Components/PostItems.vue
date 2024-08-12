<script setup>
import Dropdown from "@/Components/Dropdown.vue";
import DropdownButton from "@/Components/DropdownButton.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import { ref } from "vue";
import PostForm from "@/Components/PostForm.vue";

const editing = ref(false);

defineProps({
    post: Object,
});
</script>

<template>
    <div class="p-6 flex space-x-2">
        <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="size-6"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"
            />
        </svg>

        <div class="flex-1">
            <div class="flex justify-between items-center">
                <div>
                    <span class="text-gray-800 dark:text-gray-200">{{
                        post.user.name
                    }}</span>
                    <small
                        class="ml-2 text-sm text-gray-600 dark:text-gray-400"
                    >
                        {{ post.created_at }}
                    </small>
                    <small
                        class="text-sm text-gray-600 dark:text-gray-400"
                        v-if="post.edited"
                    >
                        &middot; edited
                    </small>
                </div>
            </div>
            <PostForm v-if="editing" :post="post" class="mt-4" @cancel="editing = false"></PostForm>
            <p v-else class="mt-4 text-lg text-gray-900 dark:text-gray-100">
                {{ post.message }}
            </p>
        </div>
        <Dropdown v-if="post.user.id === $page.props.auth.user.id">
            <template #trigger>
                <button>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="size-6 dark:text-slate-50"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"
                        />
                    </svg>
                </button>
            </template>
            <template #content>
               <DropdownButton @click="editing = true">Edit</DropdownButton>
               <DropdownLink 
               as="button" 
               :href="route('peoplebooks.destroy', post.id)" method="delete"
               :preserve-state="false"
               >
                Delete
               </DropdownLink>
            </template>
        </Dropdown>
    </div>
</template>

<style scoped></style>
