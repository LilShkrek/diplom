<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';

const props = defineProps({
    employee: Object,
});
</script>

<template>
    <Head :title="`Сотрудник: ${employee.surname} ${employee.name}`" />

    <AppLayout>
        <template #header>
            <h2 class="text-xl font-semibold text-gray-800">Информация о сотруднике</h2>
        </template>

        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            {{ employee.surname }} {{ employee.name }} {{ employee.patronymic }}
                        </h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                            Детальная информация о сотруднике.
                        </p>
                    </div>
                    <div class="border-t border-gray-200 px-4 py-5 sm:p-6 space-y-4">
                        <div>
                            <span class="font-semibold">Имя:</span>
                            <span>{{ employee.name }}</span>
                        </div>
                        <div>
                            <span class="font-semibold">Фамилия:</span>
                            <span>{{ employee.surname }}</span>
                        </div>
                        <div>
                            <span class="font-semibold">Отчество:</span>
                            <span>{{ employee.patronymic }}</span>
                        </div>
                        <div>
                            <span class="font-semibold">Должность:</span>
                            <span>{{ employee.position }}</span>
                        </div>
                        <div>
                            <span class="font-semibold">Табельный номер:</span>
                            <span>{{ employee.service_number }}</span>
                        </div>
                        <div>
                            <span class="font-semibold">Дата добавления:</span>
                            <span>{{ new Date(employee.created_at).toLocaleDateString() }}</span>
                        </div>
                    </div>
                    <div class="px-4 py-4 bg-gray-50 text-right sm:px-6">
                        <Link
                            :href="route('employee.index')"
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
