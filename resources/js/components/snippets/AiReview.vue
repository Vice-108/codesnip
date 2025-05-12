<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { ScrollArea } from '@/components/ui/scroll-area';
import { Sheet, SheetContent, SheetDescription, SheetFooter, SheetHeader, SheetTitle, SheetTrigger } from '@/components/ui/sheet';
import useGemini from '@/composables/useGemini';
import useMarkdown from '@/composables/useMarkdown';
import { Snippet } from '@/types';
import { LucideBot } from 'lucide-vue-next';
import { ref, watch } from 'vue';

const props = defineProps<{
    snippet: Snippet;
}>();

interface reviewObjectType {
    title: string;
    description: string | null;
    code: string;
}
const reviewObject: reviewObjectType = {
    title: props.snippet.title,
    description: props.snippet.description,
    code: props.snippet.code,
};
const { generateContent, result, error, loading } = useGemini();

const renderedMarkdown = ref('');
const sheetOpen = ref(false);
const hasFetched = ref(false);
const systemMessage =
    'You are a code reviewer and you will review the code and give a score from 1 to 10 and make some suggestion to improve the code. the rules are Use proper language syntax,Include clear and descriptive comments Include usage and result in Use proper indentation and formatting Add error handling if necessary';
watch(result, (val) => {
    if (val) {
        renderedMarkdown.value = useMarkdown(val);
    }
});

function handleSheetOpen(open: boolean) {
    sheetOpen.value = open;
    if (open && !hasFetched.value) {
        generateContent(reviewObject, systemMessage);
        hasFetched.value = true;
    }
}

function retry() {
    generateContent(reviewObject, systemMessage);
}
</script>

<template>
    <Sheet :open="sheetOpen" @update:open="handleSheetOpen">
        <SheetTrigger as-child>
            <Button variant="ghost" size="icon">
                <LucideBot :style="{ height: '20px', width: '20px' }" />
            </Button>
        </SheetTrigger>
        <SheetContent class="min-w-full sm:min-w-[600px]">
            <SheetHeader>
                <SheetTitle>Analyzing your code</SheetTitle>
                <SheetDescription>It wil take some time to analyze so be patient. </SheetDescription>
            </SheetHeader>

            <div v-if="loading" class="p-4 text-muted-foreground text-center">Analyzing...</div>
            <div v-else-if="error" class="p-4 text-destructive">Error: {{ error.message }}</div>
            <ScrollArea v-else-if="renderedMarkdown" class="py-4">
                <div class="space-y-2 p-2 h-[75dvh] text-[0.75rem] markdown-content" v-html="renderedMarkdown"></div>
            </ScrollArea>
            <div v-else class="p-4 text-muted-foreground">No review generated yet.</div>

            <SheetFooter>
                <Button type="button" :disabled="loading" @click="retry" variant="outline">
                    <span v-if="loading">Retrying...</span>
                    <span v-else>Retry</span>
                </Button>
            </SheetFooter>
        </SheetContent>
    </Sheet>
</template>
