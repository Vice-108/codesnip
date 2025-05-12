<script setup lang="ts">
// filepath: /e:/code/codesnip/resources/js/components/snippets/AiConvert.vue
import LanguageSelector from '@/components/snippets/LanguageSelector.vue';
import { Button } from '@/components/ui/button';
import { ScrollArea } from '@/components/ui/scroll-area';
import { Sheet, SheetContent, SheetDescription, SheetFooter, SheetHeader, SheetTitle, SheetTrigger } from '@/components/ui/sheet';
import useGemini from '@/composables/useGemini';
import useMarkdown from '@/composables/useMarkdown';
import { type Language } from '@/data/languages';
import { Snippet } from '@/types';
import { Sparkles } from 'lucide-vue-next';
import { computed, ref, watch } from 'vue';

const props = defineProps<{
    snippet: Snippet;
}>();

const selectedLanguage = ref<Language | null>(null);
const sheetOpen = ref(false);

const { generateContent, result, error, loading } = useGemini();
const renderedMarkdown = ref('');
const hasFetched = ref(false);

const systemPrompt = computed(() => {
    if (!selectedLanguage.value) return '';
    return `You are a code conversion assistant. Your task is to convert the given code snippet from one programming language to another. The code snippet will be provided in the request. You should only respond with the converted code snippet in the ${selectedLanguage.value} language. The response should contain the following, title, description as list items and converted code`;
});

watch(result, (val) => {
    if (val) {
        renderedMarkdown.value = useMarkdown(val);
    }
});

function handleSheetOpen(open: boolean) {
    sheetOpen.value = open;
    if (open) {
        selectedLanguage.value = selectedLanguage.value || null;
        renderedMarkdown.value = '';
        error.value = null;
        hasFetched.value = false;
    }
}

function handleLanguageChange(lang: Language | null) {
    selectedLanguage.value = lang;
    if (lang) {
        fetchConversion();
    }
}

function fetchConversion() {
    if (!selectedLanguage.value) return;
    const reviewObject = {
        title: props.snippet.title,
        description: props.snippet.description,
        code: props.snippet.code,
        targetLanguage: selectedLanguage.value.label,
    };
    generateContent(reviewObject, systemPrompt.value);
    hasFetched.value = true;
}

function retry() {
    fetchConversion();
}
</script>

<template>
    <Sheet :open="sheetOpen" @update:open="handleSheetOpen">
        <SheetTrigger as-child>
            <Button variant="ghost" size="icon">
                <Sparkles :style="{ height: '20px', width: '20px' }" />
            </Button>
        </SheetTrigger>
        <SheetContent class="min-w-full sm:min-w-[600px]">
            <SheetHeader>
                <SheetTitle>Convert your code</SheetTitle>
                <SheetDescription>
                    Select a language to convert your code snippet. It will take some time to analyze so be patient.
                </SheetDescription>
            </SheetHeader>
            <div class="space-y-4 py-2">
                <LanguageSelector :error="error" :disabled="loading" @update:model-value="handleLanguageChange" />
            </div>

            <div v-if="loading" class="p-4 text-muted-foreground text-center">Analyzing...</div>
            <div v-else-if="error" class="p-4 text-destructive">Error: {{ error.message }}</div>
            <ScrollArea v-else-if="renderedMarkdown" class="py-4">
                <div class="space-y-2 p-2 h-[75dvh] text-[0.75rem] markdown-content" v-html="renderedMarkdown"></div>
            </ScrollArea>
            <div v-else-if="hasFetched" class="p-4 text-muted-foreground">No conversion generated yet.</div>

            <SheetFooter>
                <Button type="button" :disabled="loading || !selectedLanguage" @click="retry" variant="outline">
                    <span v-if="loading">Retrying...</span>
                    <span v-else>Retry</span>
                </Button>
            </SheetFooter>
        </SheetContent>
    </Sheet>
</template>
