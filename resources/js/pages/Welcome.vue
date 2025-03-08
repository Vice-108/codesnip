<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AppLogo from '@/components/AppLogo.vue';
</script>

<template>
    <Head title="Welcome to CodeSnip">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div class="flex flex-col bg-[#FDFDFC] dark:bg-[#0a0a0a] min-h-screen text-[#1b1b18] dark:text-[#EDEDEC]">
        <!-- Header with navigation -->
        <header class="border-[#19140035] dark:border-[#3E3E3A] border-b w-full">
            <div class="flex justify-between items-center mx-auto px-6 py-4 container">
                <div class="flex items-center">
                    <AppLogo class="w-8 h-8" />
                </div>
                <nav class="flex items-center gap-4">
                    <Link
                        :href="route('login')"
                        class="inline-block px-5 py-1.5 border hover:border-[#19140035] dark:hover:border-[#3E3E3A] border-transparent rounded-sm text-[#1b1b18] dark:text-[#EDEDEC] text-sm leading-normal"
                    >
                        Log in
                    </Link>
                    <Link
                        :href="route('register')"
                        class="inline-block px-5 py-1.5 border border-[#19140035] hover:border-[#1915014a] dark:hover:border-[#62605b] dark:border-[#3E3E3A] rounded-sm text-[#1b1b18] dark:text-[#EDEDEC] text-sm leading-normal"
                    >
                        Register
                    </Link>
                </nav>
            </div>
        </header>

        <!-- Main content area -->
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
                        <p class="text-[#1b1b18]/80 dark:text-[#EDEDEC]/80">
                            Share your snippets with others or keep them private.
                        </p>
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

        <!-- Footer -->
        <footer class="py-6 border-[#19140035] dark:border-[#3E3E3A] border-t">
            <div class="mx-auto px-6 text-[#1b1b18]/70 dark:text-[#EDEDEC]/70 text-sm text-center container">
                Made with &hearts; and developed by <a href="https://www.github.com/vice-108" target="_blank">Vikas</a>
            </div>
        </footer>
    </div>
</template>
