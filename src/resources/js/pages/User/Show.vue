<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';

const props = defineProps({
    user: Object,
    permissions: Array,
});
</script>

<template>
    <Head :title="`Пользователь: ${user.name}`" />

    <AppLayout>
        <template #header>
            <h2 class="text-xl font-semibold text-gray-800">Информация о пользователе</h2>
        </template>

        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            {{ user.name }}
                        </h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                            Детальная информация о пользователе и его правах.
                        </p>
                    </div>
                    <div class="border-t border-gray-200 px-4 py-5 sm:p-6 space-y-4">
                        <div>
                            <span class="font-semibold">Имя:</span>
                            <span>{{ user.name }}</span>
                        </div>
                        <div>
                            <span class="font-semibold">Email:</span>
                            <span>{{ user.email }}</span>
                        </div>
                        <div>
                            <span class="font-semibold">Роль:</span>
                            <span>{{ user.role ?? '—' }}</span>
                        </div>
                        <div>
                            <span class="font-semibold">Дата регистрации:</span>
                            <span>{{ new Date(user.created_at).toLocaleDateString() }}</span>
                        </div>
                        <div v-if="permissions.length">
                            <span class="font-semibold">Права доступа:</span>
                            <ul class="list-disc ml-6 text-sm text-gray-700">
                                <li v-for="perm in permissions" :key="perm">{{ perm }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="px-4 py-4 bg-gray-50 text-right sm:px-6">
                        <Link
                            :href="route('user.index')"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700"
                        >
                            Назад к списку
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
