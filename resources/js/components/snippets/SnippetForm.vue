<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import FormCode from './FormCode.vue';
import FormDescription from './FormDescription.vue';
import FormLanguage from './FormLanguage.vue';
import FormSubmit from './FormSubmit.vue';
import FormTitle from './FormTitle.vue';
import FormVisibility from './FormVisibility.vue';

import { type Language } from '@/data/languages';

interface Props {
    snippet?: {
        id?: number;
        title: string;
        description: string;
        code: string;
        language: string;
        is_public: boolean;
    };
    mode: 'create' | 'edit';
}

const props = defineProps<Props>();

const form = useForm({
    title: props.snippet?.title ?? '',
    description: props.snippet?.description ?? '',
    code: props.snippet?.code ?? '',
    language: props.snippet?.language ?? '',
    is_public: props.snippet?.is_public ?? true,
});

const selectedLanguage = ref<Language | null>(null);

const submit = () => {
    form.language = selectedLanguage.value?.value || '';
    if (props.mode === 'edit') {
        form.put(route('snippets.update', { id: props.snippet?.id }));
    } else {
        form.post(route('snippets.store'));
    }
};
</script>

<template>
    <form @submit.prevent="submit" class="space-y-6">
        <div class="grid grid-cols-2 gap-4">
            <FormTitle v-model="form.title" :error="form.errors.title" />
            <FormLanguage v-model="selectedLanguage" :initial-language="snippet?.language" :error="form.errors.language" />
        </div>

        <FormDescription v-model="form.description" :error="form.errors.description" />
        <FormCode v-model="form.code" :error="form.errors.code" />
        <FormVisibility v-model="form.is_public" />
        <FormSubmit :is-processing="form.processing" :mode="mode" />
    </form>
</template>
