<script setup>
import AuthenticatedLayout from '@/layouts/AuthLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthLayout from "@/layouts/AuthLayout.vue";

const props = defineProps({
    user: Object,         // { id, name, email, roles: [...] }
    allRoles: Array,      // ['Администратор', 'Оператор', 'Руководитель']
    currentRoles: Array,  // ['Оператор']
});

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    password: '',
    password_confirmation: '',
    role: props.currentRoles.length ? props.currentRoles[0] : '', // одна выбранная роль
});

const submit = () => {
    form.put(route('user.update', props.user.id));
};
</script>

<template>
    <Head title="Редактировать пользователя" />

    <AuthLayout>
        <template #header>
            <h2 class="text-xl font-semibold text-gray-800">Редактировать пользователя</h2>
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
                            <Label for="password" class="text-black">Новый пароль (необязательно)</Label>
                            <Input
                                id="password"
                                type="password"
                                v-model="form.password"
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
                                <option value="">Выберите роль</option>
                                <option
                                    v-for="role in allRoles"
                                    :key="role"
                                    :value="role"
                                >
                                    {{ role }}
                                </option>
                            </select>
                            <InputError :message="form.errors.role" />
                        </div>

                        <!-- Кнопки -->
                        <div class="flex justify-end space-x-4">
                            <Link
                                :href="route('user.index')"
                                class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400"
                            >
                                Отмена
                            </Link>
                            <button
                                type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                                :disabled="form.processing"
                            >
                                Сохранить
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthLayout>
</template>
