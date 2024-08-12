<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import InputError from '@/Components/InputError.vue';
import {useForm} from '@inertiajs/vue3';

const { post }=defineProps({
    post : Object
})

const form = useForm({
    message: post?.message,
})

function update(post){
    form.patch(route('peoplebooks.update', post), {
        onSuccess: () => form.reset(),
        preserveState: false
    })
}

function submit(){
    if (post?.id) {
        update(post.id)
        return;
    }
    form.post(route('peoplebooks.store'), {
        onSuccess: () => form.reset(),
        preserveState: false
    })
}
</script>

<template>
     <form @submit.prevent="submit">
                            <textarea 
                            v-model="form.message"
                            placeholder="What's on your mind?"
                            class="block w-full rounded-md border-gray-300 bg-white"
                            ></textarea>
                            <InputError :message="form.errors.message"></InputError>
                            <PrimaryButton 
                            :disabled="form.processing" 
                            class="mt-2"
                            >
                            {{ form.processing ? 'Posting...' : 'Post' }}
                            </PrimaryButton>
                            <SecondaryButton v-if="post?.id" @click="$emit('cancel')" class="ml-2">Cancelar</SecondaryButton>
                        </form>
</template>

<style scoped>

</style>