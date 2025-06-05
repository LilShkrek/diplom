<script setup>
import AuthenticatedLayout from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import InputError from '@/components/InputError.vue';
import AuthLayout from "@/layouts/AuthLayout.vue";

const props = defineProps({
    roles: Array, // [ 'Администратор', 'Оператор', 'Руководитель' ]
});

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    role: '',
});

const submit = () => {
    form.post(route('user.store'), {
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <Head title="Добавить пользователя" />

    <AuthLayout>
        <template #header>
            <h2 class="text-xl font-semibold text-gray-800">Добавить пользователя</h2>
        </template>

        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <form @submit.prevent="submit" class="grid grid-cols-1 gap-6">
                        <!-- Имя -->
                        <div>
                            <Label for="name" class="text-black">Имя</Label>
                            <Input
                                id="name"
                                type="text"
                                v-model="form.name"
                                required
                                class="mt-1 block w-full text-black"
                            />
                            <InputError :message="form.errors.name" />
                        </div>

                        <!-- Email -->
                        <div>
                            <Label for="email" class="text-black">Email</Label>
                            <Input
                                id="email"
                                type="email"
                                v-model="form.email"
                                required
                                class="mt-1 block w-full text-black"
                            />
                            <InputError :message="form.errors.email" />
                        </div>

                        <!-- Пароль -->
                        <div>
                            <Label for="password" class="text-black">Пароль</Label>
                            <Input
                                id="password"
                                type="password"
                                v-model="form.password"
                                required
                                class="mt-1 block w-full text-black"
                            />
                            <InputError :message="form.errors.password" />
                        </div>

                        <!-- Подтверждение пароля -->
                        <div>
                            <Label for="password_confirmation" class="text-black">Подтверждение пароля</Label>
                            <Input
                                id="password_confirmation"
                                type="password"
                                v-model="form.password_confirmation"
                                required
                                class="mt-1 block w-full text-black"
                            />
                            <InputError :message="form.errors.password_confirmation" />
                        </div>

                        <!-- Роль -->
                        <div>
                            <Label for="roles" class="text-black">Роль</Label>
                            <select
                                id="roles"
                                v-model="form.role"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-black"
                            >
                                <option value="" disabled>Выберите роль</option>
                                <option v-for="role in roles" :key="role" :value="role">
                                    {{ role }}
                                </option>
                            </select>
                            <InputError :message="form.errors.role" />
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
                    </form>
                </div>
            </div>
        </div>
    </AuthLayout>
</template>
