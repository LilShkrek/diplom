<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';

const props = defineProps({
    employees: Object,
    filters: Object,
});

const goToShow = (id) => {
    router.visit(route('employee.show', id));
};

const sortBy = (column) => {
    router.get(
        route('employee.index'),
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
        route('employee.index'),
        { search: e.target.value },
        { preserveScroll: true, preserveState: true }
    );
};
</script>

<template>
    <Head title="Сотрудники" />
    <AppLayout>
        <template #header>
            <h2 class="text-xl font-semibold text-gray-800">Сотрудники</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <!-- Верхняя панель -->
                    <div class="flex justify-between mb-6">
                        <h3 class="text-lg font-medium">Список сотрудников</h3>

                        <a
                            :href="route('user.export')"
                            class="px-4 py-2 bg-emerald-600 text-white rounded hover:bg-emerald-700 text-sm"
                        >
                            Экспортировать
                        </a>

                        <Link
                            :href="route('employee.create')"
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
                            placeholder="Поиск по фамилии..."
                            :value="filters.search"
                            @input="updateSearch"
                        />
                    </div>

                    <!-- Таблица -->
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left cursor-pointer" @click="sortBy('name')">Имя</th>
                            <th class="px-6 py-3 text-left cursor-pointer" @click="sortBy('surname')">Фамилия</th>
                            <th class="px-6 py-3 text-left cursor-pointer" @click="sortBy('patronymic')">Отчество</th>
                            <th class="px-6 py-3 text-left cursor-pointer" @click="sortBy('position')">Должность</th>
                            <th class="px-6 py-3 text-left cursor-pointer" @click="sortBy('service_number')">Табельный номер</th>
                            <th class="px-6 py-3 text-left">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr
                            v-for="employee in employees.data"
                            :key="employee.id"
                            class="hover:bg-gray-100 cursor-pointer"
                            @click="goToShow(employee.id)"
                        >
                            <td class="px-6 py-4">{{ employee.name }}</td>
                            <td class="px-6 py-4">{{ employee.surname }}</td>
                            <td class="px-6 py-4">{{ employee.patronymic }}</td>
                            <td class="px-6 py-4">{{ employee.position }}</td>
                            <td class="px-6 py-4">{{ employee.service_number }}</td>
                            <td class="px-6 py-4 space-x-2" @click.stop>
                                <Link
                                    :href="route('employee.edit', employee.id)"
                                    class="text-blue-600 hover:text-blue-900"
                                >
                                    Редактировать
                                </Link>
                                <Link
                                    :href="route('employee.destroy', employee.id)"
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
                            Вперёд
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
