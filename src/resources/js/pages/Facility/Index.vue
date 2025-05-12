<script setup>
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from "@/layouts/AppLayout.vue";
import Layout from "@/layouts/settings/Layout.vue";

defineProps({ facilities: Object });
</script>

<template>
    <Head title="Оборудование" />

    <AppLayout>
        <template #header>
            <h2 class="text-xl font-semibold text-gray-800">Оборудование</h2>
        </template>

        <div class="pt-4 pb-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex justify-between mb-6">
                        <h3 class="text-lg font-medium text-gray-700">Список оборудования</h3>
                        <Link
                            :href="route('facility.create')"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                        >
                            Добавить
                        </Link>
                    </div>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left">Название</th>
                            <th class="px-6 py-3 text-left">Инв. номер</th>
                            <th class="px-6 py-3 text-left">Дата покупки</th>
                            <th class="px-6 py-3 text-left">Эксплуатация до</th>
                            <th class="px-6 py-3 text-left">Ответственный</th>
                            <th class="px-6 py-3 text-left">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="facility in facilities.data" :key="facility.id">
                            <td class="px-6 py-4">{{ facility.name }}</td>
                            <td class="px-6 py-4">{{ facility.inventory_num }}</td>
                            <td class="px-6 py-4">{{ facility.buy_date }}</td>
                            <td class="px-6 py-4">{{ facility.operation_end_date }}</td>
                            <td class="px-6 py-4">{{ facility.employee?.surname ?? 'Не назначено' }}</td>
                            <td class="px-6 py-4 space-x-2">
                                <Link
                                    :href="route('facility.edit', facility.id)"
                                    class="text-blue-600 hover:text-blue-900"
                                >
                                    Редактировать
                                </Link>
                                <Link
                                    :href="route('facility.destroy', facility.id)"
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
                            v-if="facilities.prev_page_url"
                            :href="facilities.prev_page_url"
                            class="px-4 py-2 bg-gray-100 rounded"
                        >
                            Назад
                        </Link>
                        <span class="text-sm text-gray-700">
              Страница {{ facilities.current_page }} из {{ facilities.last_page }}
            </span>
                        <Link
                            v-if="facilities.next_page_url"
                            :href="facilities.next_page_url"
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
