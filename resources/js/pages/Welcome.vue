<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Welcome to CodeSnip">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div class="flex min-h-screen flex-col bg-[#FDFDFC] text-[#1b1b18] dark:bg-[#0a0a0a] dark:text-[#EDEDEC]">
        <!-- Header with navigation -->
        <header class="w-full border-b border-[#19140035] dark:border-[#3E3E3A]">
            <div class="container mx-auto flex items-center justify-between px-6 py-4">
                <div class="flex items-center">
                    <span class="ml-3 text-xl font-semibold">CodeSnip</span>
                </div>
                <nav class="flex items-center gap-4">
                    <Link
                        :href="route('login')"
                        class="inline-block rounded-sm border border-transparent px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#19140035] dark:text-[#EDEDEC] dark:hover:border-[#3E3E3A]"
                    >
                        Log in
                    </Link>
                    <Link
                        :href="route('register')"
                        class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
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
                    <h1 class="mb-6 text-5xl font-bold text-[#1b1b18] dark:text-[#EDEDEC]">Welcome to CodeSnip</h1>
                    <p class="mb-8 text-xl text-[#1b1b18] dark:text-[#EDEDEC]">Your personal code snippet library</p>
                </div>

                <div class="grid gap-8 md:grid-cols-2">
                    <div class="rounded-lg border border-[#19140015] bg-white p-6 shadow-sm dark:border-[#3E3E3A] dark:bg-[#1a1a1a]">
                        <h2 class="mb-4 text-2xl font-semibold">Store & Organize</h2>
                        <p class="text-[#1b1b18]/80 dark:text-[#EDEDEC]/80">
                            Save your code snippets in one place. Organize them with tags and categories for easy access whenever you need them.
                        </p>
                    </div>
                    <div class="rounded-lg border border-[#19140015] bg-white p-6 shadow-sm dark:border-[#3E3E3A] dark:bg-[#1a1a1a]">
                        <h2 class="mb-4 text-2xl font-semibold">Share & Collaborate</h2>
                        <p class="text-[#1b1b18]/80 dark:text-[#EDEDEC]/80">
                            Share your snippets with others or keep them private. Collaborate with team members on shared code collections.
                        </p>
                    </div>
                    <div class="rounded-lg border border-[#19140015] bg-white p-6 shadow-sm dark:border-[#3E3E3A] dark:bg-[#1a1a1a]">
                        <h2 class="mb-4 text-2xl font-semibold">Syntax Highlighting</h2>
                        <p class="text-[#1b1b18]/80 dark:text-[#EDEDEC]/80">
                            Beautiful syntax highlighting for over 100 programming languages. Makes your code readable and visually appealing.
                        </p>
                    </div>
                    <div class="rounded-lg border border-[#19140015] bg-white p-6 shadow-sm dark:border-[#3E3E3A] dark:bg-[#1a1a1a]">
                        <h2 class="mb-4 text-2xl font-semibold">Search & Find</h2>
                        <p class="text-[#1b1b18]/80 dark:text-[#EDEDEC]/80">
                            Powerful search functionality helps you find the exact code snippet you need, when you need it.
                        </p>
                    </div>
                </div>

                <div class="mt-12 text-center">
                    <Link
                        :href="route('snippets')"
                        class="inline-block rounded-md bg-[#1b1b18] px-8 py-3 font-medium text-[#FDFDFC] transition-opacity hover:opacity-90 dark:bg-[#EDEDEC] dark:text-[#0a0a0a]"
                    >
                        Get Started
                    </Link>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="border-t border-[#19140035] py-6 dark:border-[#3E3E3A]">
            <div class="container mx-auto px-6 text-center text-sm text-[#1b1b18]/70 dark:text-[#EDEDEC]/70">
                &copy; {{ new Date().getFullYear() }} CodeSnip. All rights reserved.
            </div>
        </footer>
    </div>
</template>
