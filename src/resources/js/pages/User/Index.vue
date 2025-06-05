<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { ref, watch } from 'vue';
import { usePage } from '@inertiajs/vue3';

const csrf = usePage().props.csrf_token;

const props = defineProps({
    users: Object,
    filters: Object,
    sort: Object,
});

const search = ref(props.filters.search || '');
const sortColumn = ref(props.sort.column || 'created_at');
const sortDirection = ref(props.sort.direction || 'desc');

const viewUser = (userId) => {
    router.visit(route('user.show', userId));
};

const applySort = (field) => {
    sortDirection.value = sortColumn.value === field && sortDirection.value === 'asc' ? 'desc' : 'asc';
    sortColumn.value = field;
    applyFilters();
};

const applyFilters = () => {
    router.get(
        route('user.index'),
        {
            search: search.value,
            sort: sortColumn.value,
            direction: sortDirection.value,
        },
        {
            preserveScroll: true,
            preserveState: true,
            replace: true,
        }
    );
};

watch(search, applyFilters);
</script>

<template>
    <Head title="Пользователи" />

    <AppLayout>
        <template #header>
            <h2 class="text-xl font-semibold text-gray-800">Пользователи</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <!-- Верхняя панель -->
                    <div class="flex justify-between mb-6">
                        <h3 class="text-lg font-medium">Список пользователей</h3>
                        <a
                            :href="route('user.export')"
                            class="px-4 py-2 bg-emerald-600 text-white rounded hover:bg-emerald-700 text-sm"
                        >
                            Экспортировать
                        </a>

                        <Link
                            :href="route('user.create')"
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
                            class="border border-gray-300 rounded px-3 py-2 w-full"
                            placeholder="Поиск по имени..."
                        />
                    </div>

                    <!-- Таблица -->
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left cursor-pointer" @click="applySort('name')">Имя</th>
                            <th class="px-6 py-3 text-left cursor-pointer" @click="applySort('email')">Email</th>
                            <th class="px-6 py-3 text-left cursor-pointer" @click="applySort('role')">Роль</th>
                            <th class="px-6 py-3 text-left cursor-pointer" @click="applySort('created_at')">Дата создания</th>
                            <th class="px-6 py-3 text-left">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr
                            v-for="user in users.data"
                            :key="user.id"
                            class="hover:bg-gray-100 cursor-pointer"
                            @click="viewUser(user.id)"
                        >
                            <td class="px-6 py-4">{{ user.name }}</td>
                            <td class="px-6 py-4">{{ user.email }}</td>
                            <td class="px-6 py-4">{{ user.roles[0] ?? '—' }}</td>
                            <td class="px-6 py-4">{{ user.created_at }}</td>
                            <td class="px-6 py-4 space-x-2" @click.stop>
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
