<script setup>
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import {Input} from "@/components/ui/input/index.js";
import {Label} from "@/components/ui/label/index.js";
import InputError from "@/components/InputError.vue";

const props = defineProps({ employees: Array });

const form = useForm({
    name: '',
    buy_date: new Date().toISOString().split('T')[0],
    operation_end_date: '',
    inventory_num: '',
    employee_id: '',
});

const submit = () => {
    form.post(route('facility.store'));
};
</script>

<template>
    <Head title="Добавить объект" />

    <AuthLayout>
        <template #header>
            <h2 class="text-xl font-semibold text-gray-800">Добавить объект</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <form @submit.prevent="submit">
                        <div class="grid grid-cols-1 gap-6">

                            <!-- Название -->
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

                            <!-- Инвентарный номер -->
                            <div>
                                <Label for="inventory_num" class="text-black">Инвентарный номер</Label>
                                <Input
                                    id="inventory_num"
                                    type="number"
                                    required
                                    autofocus
                                    :tabindex="2"
                                    v-model="form.inventory_num"
                                    class="mt-1 block w-full text-black"
                                />
                                <InputError :message="form.errors.inventory_num" />
                            </div>

                            <!-- Даты -->
                            <div class="grid grid-cols-2 gap-4">
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
                                    <Label for="operation_end_date" class="text-black">Дата примерного окончания срока эксплуатации</Label>
                                    <Input
                                        id="operation_end_date"
                                        type="date"
                                        required
                                        autofocus
                                        :tabindex="4"
                                        v-model="form.operation_end_date"
                                        class="mt-1 block w-full text-black"
                                    />
                                    <InputError :message="form.errors.operation_end_date" />
                                </div>
                            </div>

                            <!-- Ответственный -->
                            <div>
                                <Label for="employee_id" class="text-black">Ответственный</Label>
                                <select
                                    id="employee_id"
                                    v-model="form.employee_id"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                >
                                    <option value="">Выберите пользователя</option>
                                    <option v-for="employee in employees" :key="employee.id" :value="employee.id">
                                        {{ employee.surname }}
                                    </option>
                                </select>
                                <InputError :message="form.errors.employee_id" />
                            </div>

                            <!-- Кнопка -->
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
    </AuthLayout>
</template>
