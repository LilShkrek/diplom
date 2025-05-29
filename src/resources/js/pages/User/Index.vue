<script setup>
import AuthenticatedLayout from '@/layouts/AuthLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from "@/layouts/AppLayout.vue";

defineProps({ users: Object });
</script>

<template>
    <Head title="Пользователи" />

    <AppLayout>
        <template #header>
            <h2 class="text-xl font-semibold text-gray-800">Пользователи</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex justify-between mb-6">
                        <h3 class="text-lg font-medium">Список</h3>
                        <Link
                            :href="route('user.create')"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                        >
                            Добавить
                        </Link>
                    </div>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left">Имя</th>
                            <th class="px-6 py-3 text-left">Email</th>
                            <th class="px-6 py-3 text-left">Роль</th>
                            <th class="px-6 py-3 text-left">Дата создания</th>
                            <th class="px-6 py-3 text-left">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="user in users.data" :key="user.id">
                            <td class="px-6 py-4">{{ user.name }}</td>
                            <td class="px-6 py-4">{{ user.email }}</td>
                            <td class="px-6 py-4">
                                {{ user.roles[0] ?? '—' }}
                            </td>
                            <td class="px-6 py-4">{{ user.created_at }}</td>
                            <td class="px-6 py-4 space-x-2">
                                <Link
                                    :href="route('user.edit', user.id)"
                                    class="text-blue-600 hover:text-blue-900"
                                >
                                    Редактировать
                                </Link>
                                <Link
                                    :href="route('user.destroy', user.id)"
                                    method="delete"
                                    as="button"
                                    class="text-red-600 hover:text-red-900"
                                >
                                    Удалить
                                </Link>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <!-- Пагинация -->
                    <div class="mt-4 flex justify-between items-center">
                        <Link
                            v-if="users.prev_page_url"
                            :href="users.prev_page_url"
                            class="px-4 py-2 bg-gray-100 rounded"
                        >
                            Назад
                        </Link>
                        <span class="text-sm text-gray-700">
                            Страница {{ users.current_page }} из {{ users.last_page }}
                        </span>
                        <Link
                            v-if="users.next_page_url"
                            :href="users.next_page_url"
                            class="px-4 py-2 bg-gray-100 rounded"
                        >
                            Вперёд
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
