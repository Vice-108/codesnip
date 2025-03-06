<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Trash2 } from 'lucide-vue-next';
import { router } from '@inertiajs/vue3';
import { toast } from 'vue-sonner';
import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
    AlertDialogTrigger,
} from '@/components/ui/alert-dialog';

defineProps<{
    snippetId: number;
}>();

const deleteSnippet = (id: number) => {
    router.delete(route('snippets.destroy', { id }), {
        onSuccess: () => {
            toast.success('Snippet deleted successfully');
        },
    });
};
</script>

<template>
    <AlertDialog>
        <AlertDialogTrigger as-child>
            <Button variant="ghost" size="icon">
                <Trash2 class="w-4 h-4 text-destructive" />
            </Button>
        </AlertDialogTrigger>
        <AlertDialogContent>
            <AlertDialogHeader>
                <AlertDialogTitle>Are you sure?</AlertDialogTitle>
                <AlertDialogDescription>
                    This action cannot be undone. This will permanently delete your
                    snippet.
                </AlertDialogDescription>
            </AlertDialogHeader>
            <AlertDialogFooter>
                <AlertDialogCancel>Cancel</AlertDialogCancel>
                <AlertDialogAction
                    @click="deleteSnippet(snippetId)"
                    class="bg-destructive hover:bg-destructive/90 text-destructive-foreground"
                >
                    Delete
                </AlertDialogAction>
            </AlertDialogFooter>
        </AlertDialogContent>
    </AlertDialog>
</template>
