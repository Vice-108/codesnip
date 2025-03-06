<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import {
    Combobox,
    ComboboxAnchor,
    ComboboxEmpty,
    ComboboxGroup,
    ComboboxInput,
    ComboboxItem,
    ComboboxItemIndicator,
    ComboboxList,
    ComboboxTrigger,
} from '@/components/ui/combobox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Switch } from '@/components/ui/switch';
import { Textarea } from '@/components/ui/textarea';
import { Tooltip, TooltipContent, TooltipProvider, TooltipTrigger } from '@/components/ui/tooltip';
import { languages } from '@/data/languages';
import AppLayout from '@/layouts/AppLayout.vue';
import { cn } from '@/lib/utils';
import { type BreadcrumbItem } from '@/types';
import { useForm } from '@inertiajs/vue3';
import { Check, ChevronsUpDown, Search, Info } from 'lucide-vue-next';
import { ref } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Create Snippet',
        href: '#',
    },
];

const form = useForm({
    title: '',
    description: '',
    code: '',
    language: '',
    is_public: true,
});

const selectedLanguage = ref(null);

// Update the form language when submitting
const submit = () => {
    form.language = selectedLanguage.value?.value || '';
    form.post(route('snippets.store'));
};

// Remove the watcher as we don't need it anymore
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="mx-auto p-4 container">
            <Card class="mx-auto max-w-3xl">
                <CardHeader>
                    <CardTitle>Create New Snippet</CardTitle>
                </CardHeader>
                <CardContent>
                    <form @submit.prevent="submit" class="space-y-6">
                        <div class="gap-5 grid grid-cols-2">
                            <div class="space-y-2">
                                <Label for="title" class="flex items-center gap-1">
                                    Title <span class="text-destructive">*</span>
                                </Label>
                                <Input
                                    id="title"
                                    v-model="form.title"
                                    :error="form.errors.title"
                                    placeholder="Enter snippet title"
                                    required
                                />
                                <span v-if="form.errors.title" class="text-destructive text-sm">
                                    {{ form.errors.title }}
                                </span>
                            </div>

                            <div class="space-y-2">
                                <Label for="language" class="flex items-center gap-1">
                                    Language <span class="text-destructive">*</span>
                                </Label>
                                <Combobox v-model="selectedLanguage" by="label">
                                    <ComboboxAnchor as-child>
                                        <ComboboxTrigger as-child>
                                            <Button variant="outline" class="justify-between w-full h-10">
                                                {{ selectedLanguage?.label ?? 'Select language' }}
                                                <ChevronsUpDown class="opacity-50 ml-2 w-4 h-4 shrink-0" />
                                            </Button>
                                        </ComboboxTrigger>
                                    </ComboboxAnchor>

                                    <ComboboxList class="w-full">
                                        <div class="relative items-center w-full">
                                            <ComboboxInput
                                                class="pl-9 border-0 border-b rounded-none focus-visible:ring-0 w-full h-10"
                                                placeholder="Search language..."
                                            />
                                            <span class="absolute inset-y-0 flex justify-center items-center px-3 start-0">
                                                <Search class="size-4 text-muted-foreground" />
                                            </span>
                                        </div>

                                        <ComboboxEmpty> No language found. </ComboboxEmpty>

                                        <ComboboxGroup class="max-h-[300px] overflow-auto">
                                            <ComboboxItem v-for="lang in languages" :key="lang.value" :value="lang">
                                                {{ lang.label }}
                                                <ComboboxItemIndicator>
                                                    <Check :class="cn('ml-auto h-4 w-4')" />
                                                </ComboboxItemIndicator>
                                            </ComboboxItem>
                                        </ComboboxGroup>
                                    </ComboboxList>
                                </Combobox>
                                <span v-if="form.errors.language" class="text-destructive text-sm">
                                    {{ form.errors.language }}
                                </span>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <Label for="description">Description (Optional)</Label>
                            <Textarea
                                id="description"
                                v-model="form.description"
                                :error="form.errors.description"
                                placeholder="Enter snippet description"
                            />
                            <span v-if="form.errors.description" class="text-destructive text-sm">
                                {{ form.errors.description }}
                            </span>
                        </div>

                        <div class="space-y-2">
                            <div class="flex items-center gap-2">
                                <Label for="code" class="flex items-center gap-1">
                                    Code <span class="text-destructive">*</span>
                                </Label>
                                <TooltipProvider>
                                    <Tooltip>
                                        <TooltipTrigger asChild>
                                            <Info class="w-4 h-4 text-muted-foreground cursor-help" />
                                        </TooltipTrigger>
                                        <TooltipContent class="w-80">
                                            <ul class="space-y-1 pl-4 list-disc">
                                                <li>Use proper language syntax</li>
                                                <li>Include clear and descriptive comments</li>
                                                <li>Include usage and result in comments</li>
                                                <li>Use proper indentation and formatting</li>
                                                <li>Add error handling if necessary</li>
                                            </ul>
                                        </TooltipContent>
                                    </Tooltip>
                                </TooltipProvider>
                            </div>
                            <Textarea
                                id="code"
                                v-model="form.code"
                                :error="form.errors.code"
                                rows="10"
                                placeholder="Paste your code here"
                                class="font-mono"
                                required
                            />
                            <span v-if="form.errors.code" class="text-destructive text-sm">
                                {{ form.errors.code }}
                            </span>
                        </div>

                        <div class="flex items-center gap-2">
                            <Switch id="is_public" v-model="form.is_public" />
                            <Label for="is_public">Make this snippet public</Label>
                        </div>

                        <Button type="submit" :disabled="form.processing" class="w-full">
                            {{ form.processing ? 'Creating...' : 'Create Snippet' }}
                        </Button>
                    </form>
                </CardContent>
            </Card>
        </div>
    </AppLayout>
</template>
