<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { ref, watch } from 'vue';

const props = defineProps({
    facilities: Object,
    filters: Object,
});

// Сортировка и поиск
const sortField = ref(props.filters.sort || '');
const sortDirection = ref(props.filters.direction || 'asc');
const search = ref(props.filters.search || '');

const goToShow = (id) => {
    router.visit(route('facility.show', id));
};

const applySort = (field) => {
    sortDirection.value = sortField.value === field && sortDirection.value === 'asc' ? 'desc' : 'asc';
    sortField.value = field;
    applyFilters();
};

const applyFilters = () => {
    router.get(
        route('facility.index'),
        {
            search: search.value,
            sort: sortField.value,
            direction: sortDirection.value,
        },
        { preserveScroll: true, preserveState: true, replace: true }
    );
};

watch(search, () => {
    applyFilters();
});
</script>

<template>
    <Head title="Оборудование" />
    <AppLayout>
        <template #header>
            <h2 class="text-xl font-semibold text-gray-800">Оборудование</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <!-- Верхняя панель -->
                    <div class="flex justify-between mb-6">
                        <h3 class="text-lg font-medium">Список оборудования</h3>
                        <Link
                            :href="route('facility.create')"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                        >
                            Добавить
                        </Link>
                    </div>

                    <!-- Поиск -->
                    <div class="mb-4">
                        <input
                            type="text"
                            v-model="search"
                            placeholder="Поиск по названию..."
                            class="border border-gray-300 rounded px-4 py-2 w-full"
                        />
                    </div>

                    <!-- Таблица -->
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left cursor-pointer" @click="applySort('name')">Название</th>
                            <th class="px-6 py-3 text-left cursor-pointer" @click="applySort('buy_date')">Дата покупки</th>
                            <th class="px-6 py-3 text-left cursor-pointer" @click="applySort('operation_end_date')">Окончание эксплуатации</th>
                            <th class="px-6 py-3 text-left cursor-pointer" @click="applySort('inventory_num')">Инв. номер</th>
                            <th class="px-6 py-3 text-left cursor-pointer" @click="applySort('status')">Статус</th>
                            <th class="px-6 py-3 text-left">Сотрудник</th>
                            <th class="px-6 py-3 text-left">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr
                            v-for="facility in facilities.data"
                            :key="facility.id"
                            class="hover:bg-gray-100 cursor-pointer"
                            @click="goToShow(facility.id)"
                        >
                            <td class="px-6 py-4">{{ facility.name }}</td>
                            <td class="px-6 py-4">{{ new Date(facility.buy_date).toLocaleDateString() }}</td>
                            <td class="px-6 py-4">{{ new Date(facility.operation_end_date).toLocaleDateString() }}</td>
                            <td class="px-6 py-4">{{ facility.inventory_num }}</td>
                            <td class="px-6 py-4">{{ facility.status }}</td>
                            <td class="px-6 py-4">{{ facility.employee?.name ?? '—' }}</td>
                            <td class="px-6 py-4 space-x-2" @click.stop>
                                <Link
                                    :href="route('facility.edit', facility.id)"
                                    class="text-blue-600 hover:text-blue-900"
                                >
                                    Редактировать
                                </Link>
                                <Link
                                    :href="route('facility.destroy', facility.id)"
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
                            Вперёд
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
