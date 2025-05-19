<script setup>
// Импорты
import AuthenticatedLayout from '@/layouts/AuthLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import InputError from '@/components/InputError.vue';

// Получаем список объектов (facilities) из контроллера
const props = defineProps({
    facilities: Array, // [ { id: 1, name: 'Объект 1' }, ... ]
});

// Инициализируем пустую форму
const form = useForm({
    name: '',
    key: '',
    buy_date: new Date().toISOString().split('T')[0], // Сегодняшняя дата (формат YYYY-MM-DD)
    start_date: '',
    end_date: '',
    facility_id: '',
});

// Отправка формы
const submit = () => {
    form.post(route('licence.store'), {
        onSuccess: () => form.reset(), // Очистить форму после успеха
    });
};
</script>

<template>
    <Head title="Добавить лицензию" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold text-gray-800">Добавить лицензию</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <!-- Форма -->
                    <form @submit.prevent="submit">
                        <div class="grid grid-cols-1 gap-6">

                            <!-- Поле "Название" -->
                            <div>
                                <Label for="name" class="text-black">Название</Label>
                                <Input
                                    id="name"
                                    type="text"
                                    required
                                    autofocus
                                    :tabindex="1"
                                    v-model="form.name"
                                    class="mt-1 block w-full text-black"
                                />
                                <InputError :message="form.errors.name" />
                            </div>

                            <!-- Поле "Ключ" -->
                            <div>
                                <Label for="key" class="text-black">Ключ лицензии</Label>
                                <Input
                                    id="key"
                                    type="text"
                                    required
                                    autofocus
                                    :tabindex="2"
                                    v-model="form.key"
                                    class="mt-1 block w-full text-black"
                                />
                                <InputError :message="form.errors.key" />
                            </div>

                            <!-- Выпадающий список "Объект" -->
                            <div>
                                <Label for="facility_id" class="text-black">Оборудование</Label>
                                <select
                                    id="facility_id"
                                    v-model="form.facility_id"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                >
                                    <option value="" disabled>Выберите объект</option>
                                    <option v-for="facility in facilities" :key="facility.id" :value="facility.id">
                                        {{ facility.name }}
                                    </option>
                                </select>
                                <InputError :message="form.errors.facility_id" />
                            </div>

                            <!-- Даты -->
                            <div class="grid grid-cols-3 gap-4">
                                <div>
                                    <Label for="buy_date" class="text-black">Дата покупки</Label>
                                    <Input
                                        id="buy_date"
                                        type="date"
                                        required
                                        autofocus
                                        :tabindex="3"
                                        v-model="form.buy_date"
                                        class="mt-1 block w-full text-black"
                                    />
                                    <InputError :message="form.errors.buy_date" />
                                </div>
                                <div>
                                    <Label for="start_date" class="text-black">Дата начала действия</Label>
                                    <Input
                                        id="start_date"
                                        type="date"
                                        required
                                        autofocus
                                        :tabindex="4"
                                        v-model="form.start_date"
                                        class="mt-1 block w-full text-black"
                                    />
                                    <InputError :message="form.errors.start_date" />
                                </div>
                                <div>
                                    <Label for="end_date" class="text-black">Дата окончания действия</Label>
                                    <Input
                                        id="end_date"
                                        type="date"
                                        required
                                        autofocus
                                        :tabindex="5"
                                        v-model="form.end_date"
                                        class="mt-1 block w-full text-black"
                                    />
                                    <InputError :message="form.errors.end_date" />
                                </div>
                            </div>

                            <!-- Кнопка отправки -->
                            <div class="flex justify-end">
                                <button
                                    type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                                    :disabled="form.processing"
                                >
                                    Создать
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
