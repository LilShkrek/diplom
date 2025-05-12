<script setup>
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import {Input} from "@/components/ui/input/index.js";
import {Label} from "@/components/ui/label/index.js";
import InputError from "@/components/InputError.vue";

const form = useForm({
    name: '',
    surname: '',
    patronymic: '',
    position: '',
    service_number: '',
});

const submit = () => {
    form.post(route('employee.store'));
};
</script>

<template>
    <Head title="Добавить сотрудника" />

    <AuthLayout>
        <template #header>
            <h2 class="text-xl font-semibold text-gray-800">Добавить сотрудника</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <form @submit.prevent="submit">
                        <div class="grid grid-cols-1 gap-6">

                            <!-- Имя -->
                            <div>
                                <Label for="name" class="text-black">Имя</Label>
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

                            <!-- Фамилия -->
                            <div>
                                <Label for="surname" class="text-black">Фамилия</Label>
                                <Input
                                    id="surname"
                                    type="text"
                                    required
                                    autofocus
                                    :tabindex="2"
                                    v-model="form.surname"
                                    class="mt-1 block w-full text-black"
                                />
                                <InputError :message="form.errors.surname" />
                            </div>

                            <!-- Отчество -->
                            <div>
                                <Label for="patronymic" class="text-black">Отчество</Label>
                                <Input
                                    id="patronymic"
                                    type="text"
                                    required
                                    autofocus
                                    :tabindex="3"
                                    v-model="form.patronymic"
                                    class="mt-1 block w-full text-black"
                                />
                                <InputError :message="form.errors.patronymic" />
                            </div>

                            <!-- Должность -->
                            <div>
                                <Label for="position" class="text-black">Должность</Label>
                                <Input
                                    id="position"
                                    type="text"
                                    required
                                    autofocus
                                    :tabindex="4"
                                    v-model="form.position"
                                    class="mt-1 block w-full text-black"
                                />
                                <InputError :message="form.errors.position" />
                            </div>

                            <!-- Табельный номер -->
                            <div>
                                <Label for="service_number" class="text-black">Табельный номер</Label>
                                <Input
                                    id="service_number"
                                    type="number"
                                    required
                                    autofocus
                                    :tabindex="5"
                                    v-model="form.service_number"
                                    class="mt-1 block w-full text-black"
                                />
                                <InputError :message="form.errors.service_number" />
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
