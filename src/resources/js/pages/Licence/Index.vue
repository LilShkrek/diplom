<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';

const props = defineProps({
    licences: Object,
    filters: Object,
});

const goToShow = (id) => {
    router.visit(route('licence.show', id));
};

const sortBy = (column) => {
    router.get(
        route('licence.index'),
        {
            search: props.filters.search,
            sort: column,
            direction: props.filters.sort === column && props.filters.direction === 'asc' ? 'desc' : 'asc',
        },
        { preserveScroll: true, preserveState: true }
    );
};

const updateSearch = (e) => {
    router.get(
        route('licence.index'),
        { search: e.target.value },
        { preserveScroll: true, preserveState: true }
    );
};
</script>

<template>
    <Head title="Лицензии" />
    <AppLayout>
        <template #header>
            <h2 class="text-xl font-semibold text-gray-800">Лицензии</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <!-- Верхняя панель -->
                    <div class="flex justify-between mb-6">
                        <h3 class="text-lg font-medium">Список лицензий</h3>
                        <Link
                            :href="route('licence.create')"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                        >
                            Добавить
                        </Link>
                    </div>

                    <!-- Поиск -->
                    <div class="mb-4">
                        <input
                            type="text"
                            class="border border-gray-300 rounded px-3 py-2 w-full"
                            placeholder="Поиск по названию..."
                            :value="filters.search"
                            @input="updateSearch"
                        />
                    </div>

                    <!-- Таблица -->
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left cursor-pointer" @click="sortBy('name')">Название</th>
                            <th class="px-6 py-3 text-left cursor-pointer" @click="sortBy('key')">Ключ</th>
                            <th class="px-6 py-3 text-left cursor-pointer" @click="sortBy('buy_date')">Дата покупки</th>
                            <th class="px-6 py-3 text-left cursor-pointer" @click="sortBy('start_date')">Начало действия</th>
                            <th class="px-6 py-3 text-left cursor-pointer" @click="sortBy('end_date')">Окончание действия</th>
                            <th class="px-6 py-3 text-left cursor-pointer" @click="sortBy('facility_id')">Оборудование</th>
                            <th class="px-6 py-3 text-left">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr
                            v-for="licence in licences.data"
                            :key="licence.id"
                            class="hover:bg-gray-100 cursor-pointer"
                            @click="goToShow(licence.id)"
                        >
                            <td class="px-6 py-4">{{ licence.name }}</td>
                            <td class="px-6 py-4">{{ licence.key }}</td>
                            <td class="px-6 py-4">{{ new Date(licence.buy_date).toLocaleDateString() }}</td>
                            <td class="px-6 py-4">{{ new Date(licence.start_date).toLocaleDateString() }}</td>
                            <td class="px-6 py-4">{{ new Date(licence.end_date).toLocaleDateString() }}</td>
                            <td class="px-6 py-4">{{ licence.facility?.name ?? '—' }}</td>
                            <td class="px-6 py-4 space-x-2" @click.stop>
                                <Link
                                    :href="route('licence.edit', licence.id)"
                                    class="text-blue-600 hover:text-blue-900"
                                >
                                    Редактировать
                                </Link>
                                <Link
                                    :href="route('licence.destroy', licence.id)"
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
                            v-if="licences.prev_page_url"
                            :href="licences.prev_page_url"
                            class="px-4 py-2 bg-gray-100 rounded"
                        >
                            Назад
                        </Link>
                        <span class="text-sm text-gray-700">
                            Страница {{ licences.current_page }} из {{ licences.last_page }}
                        </span>
                        <Link
                            v-if="licences.next_page_url"
                            :href="licences.next_page_url"
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
