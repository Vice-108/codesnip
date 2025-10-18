<!-- <script setup lang="ts">
import AppLogo from '@/components/AppLogo.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Welcome to CodeSnip">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div class="flex flex-col bg-[#FDFDFC] dark:bg-[#0a0a0a] min-h-screen text-[#1b1b18] dark:text-[#EDEDEC]">
        <header class="border dark:border-[#3E3E3A] border-b w-full">
            <div class="flex justify-between items-center mx-auto px-6 py-4 container">
                <div class="flex items-center">
                    <AppLogo class="w-8 h-8" />
                </div>
                <nav class="flex items-center gap-4">
                    <Link
                        :href="route('login')"
                        class="inline-block px-5 py-1.5 border hover:border dark:hover:border-[#3E3E3A] border-transparent rounded-sm text-[#1b1b18] dark:text-[#EDEDEC] text-sm leading-normal"
                    >
                        Log in
                    </Link>
                    <Link
                        :href="route('register')"
                        class="inline-block px-5 py-1.5 border hover:border-[#1915014a] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-[#1b1b18] dark:text-[#EDEDEC] text-sm leading-normal"
                    >
                        Register
                    </Link>
                </nav>
            </div>
        </header>

        <main class="flex-1 mx-auto px-6 py-12 container">
            <div class="mx-auto max-w-4xl">
                <div class="mb-12 text-center">
                    <h1 class="mb-6 font-bold text-[#1b1b18] dark:text-[#EDEDEC] text-5xl">Welcome to CodeSnip</h1>
                    <p class="mb-8 text-[#1b1b18] dark:text-[#EDEDEC] text-xl">Your personal code snippet library</p>
                </div>

                <div class="gap-8 grid md:grid-cols-2">
                    <div class="bg-white dark:bg-[#1a1a1a] shadow-sm p-6 border border-[#19140015] dark:border-[#3E3E3A] rounded-lg">
                        <h2 class="mb-4 font-semibold text-2xl">Store & Organize</h2>
                        <p class="text-[#1b1b18]/80 dark:text-[#EDEDEC]/80">
                            Save your code snippets in one place. Organize them with tags and categories for easy access whenever you need them.
                        </p>
                    </div>
                    <div class="bg-white dark:bg-[#1a1a1a] shadow-sm p-6 border border-[#19140015] dark:border-[#3E3E3A] rounded-lg">
                        <h2 class="mb-4 font-semibold text-2xl">Share & Collaborate</h2>
                        <p class="text-[#1b1b18]/80 dark:text-[#EDEDEC]/80">Share your snippets with others or keep them private.</p>
                    </div>
                    <div class="bg-white dark:bg-[#1a1a1a] shadow-sm p-6 border border-[#19140015] dark:border-[#3E3E3A] rounded-lg">
                        <h2 class="mb-4 font-semibold text-2xl">Syntax Highlighting</h2>
                        <p class="text-[#1b1b18]/80 dark:text-[#EDEDEC]/80">
                            Beautiful syntax highlighting for many programming languages. Makes your code readable and visually appealing.
                        </p>
                    </div>
                    <div class="bg-white dark:bg-[#1a1a1a] shadow-sm p-6 border border-[#19140015] dark:border-[#3E3E3A] rounded-lg">
                        <h2 class="mb-4 font-semibold text-2xl">Search & Find</h2>
                        <p class="text-[#1b1b18]/80 dark:text-[#EDEDEC]/80">
                            Powerful search functionality helps you find the exact code snippet you need, when you need it. (Coming soon)
                        </p>
                    </div>
                </div>

                <div class="mt-12 text-center">
                    <Link
                        :href="route('snippets')"
                        class="inline-block bg-[#1b1b18] dark:bg-[#EDEDEC] hover:opacity-90 px-8 py-3 rounded-md font-medium text-[#FDFDFC] dark:text-[#0a0a0a] transition-opacity"
                    >
                        Get Started
                    </Link>
                </div>
            </div>
        </main>

        <footer class="py-6 border dark:border-[#3E3E3A] border-t">
            <div class="mx-auto px-6 text-[#1b1b18]/70 dark:text-[#EDEDEC]/70 text-sm text-center container">
                Made with &hearts; and developed by <a href="https://www.github.com/vice-108" target="_blank">Keshav</a>
            </div>
        </footer>
    </div>
</template> -->
<script setup lang="ts">
import AppLogo from '@/components/AppLogo.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Welcome to CodeSnip">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div class="flex min-h-screen flex-col bg-background text-foreground">
        <!-- Header with navigation -->
        <header class="w-full border border-b border-border">
            <div class="container mx-auto flex items-center justify-between px-6 py-4">
                <div class="flex items-center">
                    <AppLogo class="h-8 w-8" />
                </div>
                <nav class="flex items-center gap-4">
                    <Link
                        :href="route('login')"
                        class="inline-block rounded-sm border border-transparent px-5 py-1.5 text-sm leading-normal text-foreground hover:border-border"
                    >
                        Log in
                    </Link>
                    <Link
                        :href="route('register')"
                        class="inline-block rounded-sm border border-border px-5 py-1.5 text-sm leading-normal text-foreground hover:border-primary"
                    >
                        Register
                    </Link>
                </nav>
            </div>
        </header>

        <!-- Main content area -->
        <main class="container mx-auto flex-1 px-6 py-12">
            <div class="mx-auto max-w-4xl">
                <div class="mb-12 text-center">
                    <h1 class="mb-6 text-5xl font-bold text-foreground">Welcome to CodeSnip</h1>
                    <p class="mb-8 text-xl text-foreground">Your personal code snippet library</p>
                </div>

                <div class="grid gap-8 md:grid-cols-2">
                    <div class="rounded-lg border border-border bg-card p-6 shadow-sm">
                        <h2 class="mb-4 text-2xl font-semibold text-card-foreground">Store & Organize</h2>
                        <p class="text-muted-foreground">
                            Save your code snippets in one place. Organize them with tags and categories for easy access whenever you need them.
                        </p>
                    </div>
                    <div class="rounded-lg border border-border bg-card p-6 shadow-sm">
                        <h2 class="mb-4 text-2xl font-semibold text-card-foreground">Share & Collaborate</h2>
                        <p class="text-muted-foreground">Share your snippets with others or keep them private.</p>
                    </div>
                    <div class="rounded-lg border border-border bg-card p-6 shadow-sm">
                        <h2 class="mb-4 text-2xl font-semibold text-card-foreground">Syntax Highlighting</h2>
                        <p class="text-muted-foreground">
                            Beautiful syntax highlighting for many programming languages. Makes your code readable and visually appealing.
                        </p>
                    </div>
                    <div class="rounded-lg border border-border bg-card p-6 shadow-sm">
                        <h2 class="mb-4 text-2xl font-semibold text-card-foreground">Search & Find</h2>
                        <p class="text-muted-foreground">
                            Powerful search functionality helps you find the exact code snippet you need, when you need it. (Coming soon)
                        </p>
                    </div>
                </div>

                <div class="mt-12 text-center">
                    <Link
                        :href="route('register')"
                        class="inline-block rounded-md bg-primary px-6 py-3 text-base font-medium text-primary-foreground shadow-sm hover:bg-primary/90"
                    >
                        Get Started Now
                    </Link>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="border-t border-border py-6">
            <div class="container mx-auto px-6 text-center text-sm text-muted-foreground">
                <p>© {{ new Date().getFullYear() }} CodeSnip. All rights reserved.</p>
            </div>
        </footer>
    </div>
</template>
