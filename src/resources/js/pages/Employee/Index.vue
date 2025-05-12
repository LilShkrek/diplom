<script setup>
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from "@/layouts/AppLayout.vue";
import Layout from "@/layouts/settings/Layout.vue";

defineProps({ employees: Object });
</script>

<template>
    <Head title="Сотрудники" />

    <AppLayout>
        <template #header>
            <h2 class="text-xl font-semibold text-gray-800">Сотрудники</h2>
        </template>

        <div class="pt-4 pb-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex justify-between mb-6">
                        <h3 class="text-lg font-medium text-gray-700">Список сотрудников</h3>
                        <Link
                            :href="route('employee.create')"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                        >
                            Добавить
                        </Link>
                    </div>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left">Имя</th>
                            <th class="px-6 py-3 text-left">Фамилия</th>
                            <th class="px-6 py-3 text-left">Отчество</th>
                            <th class="px-6 py-3 text-left">Должность</th>
                            <th class="px-6 py-3 text-left">Табельный номер</th>
                            <th class="px-6 py-3 text-left">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="employee in employees.data" :key="employee.id">
                            <td class="px-6 py-4">{{ employee.name }}</td>
                            <td class="px-6 py-4">{{ employee.surname }}</td>
                            <td class="px-6 py-4">{{ employee.patronymic }}</td>
                            <td class="px-6 py-4">{{ employee.position }}</td>
                            <td class="px-6 py-4">{{ employee.service_number }}</td>
                            <td class="px-6 py-4 space-x-2">
                                <Link
                                    :href="route('employee.edit', employee.id)"
                                    class="text-blue-600 hover:text-blue-900"
                                >
                                    Редактировать
                                </Link>
                                <Link
                                    :href="route('employee.destroy', employee.id)"
                                    method="delete"
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
                            v-if="employees.prev_page_url"
                            :href="employees.prev_page_url"
                            class="px-4 py-2 bg-gray-100 rounded"
                        >
                            Назад
                        </Link>
                        <span class="text-sm text-gray-700">
              Страница {{ employees.current_page }} из {{ employees.last_page }}
            </span>
                        <Link
                            v-if="employees.next_page_url"
                            :href="employees.next_page_url"
                            class="px-4 py-2 bg-gray-100 rounded"
                        >
                            Вперед
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
