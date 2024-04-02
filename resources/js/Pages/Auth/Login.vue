<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import ButtonPrimary from "@/Components/Buttons/ButtonPrimary.vue";
import ButtonGoogleLogin from "@/Components/Buttons/ButtonGoogleLogin.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { computed } from "vue";

const form = useForm({
  email: "",
  password: "",
  remember: false,
});

function submit() {
  form.post(route("login"), {
    onFinish: () => {
      form.reset("password");
    },
  });
}

const isLoginButtonDisabled = computed(() => {
  return form.processing || !form.email || !form.password;
});

const firstErrorMessage = computed(() => {
  if (form.hasErrors) {
    const firstErrorKey = Object.keys(form.errors)[0];
    if (firstErrorKey) {
      return form.errors[firstErrorKey];
    }
  }
  return null;
});
</script>

<template>
  <GuestLayout :backRoute="route('welcome')">
    <template #body>
      <Head title="Log in" />
      <div class="text-center mb-12">
        <h1 class="font-bold text-2xl text-accent-100">
          Log in to your account
        </h1>
        <p class="text-secondary-100">Enter your details to proceed further</p>
      </div>
      <form @submit.prevent="submit">
        <div
          class="my-4 rounded-md relative"
          :class="{ 'ring-2 ring-error-100': firstErrorMessage }"
        >
          <div
            v-show="firstErrorMessage"
            class="absolute bottom-[calc(100%-2px)] bg-error-100 w-full text-center text-base-100 py-2 border-error-100 ring-2 ring-error-100 rounded-t-md"
          >
            {{ firstErrorMessage }}
          </div>
          <div class="relative">
            <input
              id="email"
              type="email"
              class="peer block w-full rounded-t-md p-4 border-disabled-100 focus:relative focus:z-10 focus:border-accent-200 focus:ring-accent-200 custom-transition"
              :class="{ 'rounded-t-none': firstErrorMessage }"
              v-model="form.email"
              required
              autofocus
              autocomplete="username"
              @focus="form.clearErrors()"
              @input="form.clearErrors()"
            />
            <label
              for="email"
              class="cursor-text text-disabled-100 absolute z-20 top-3 left-4 text-lg peer-focus:top-0 peer-focus:text-sm custom-transition"
              :class="{ '!top-0 text-sm': form.email }"
              >Email Address</label
            >
          </div>
          <div class="relative">
            <input
              id="password"
              type="password"
              class="peer block w-full rounded-b-md p-4 border-disabled-100 focus:relative focus:z-10 focus:border-accent-200 focus:ring-accent-200 custom-transition"
              v-model="form.password"
              required
              autocomplete="current-password"
              @focus="form.clearErrors()"
              @input="form.clearErrors()"
            />
            <label
              for="password"
              class="cursor-text text-disabled-100 absolute z-20 top-3 left-4 text-lg peer-focus:top-0 peer-focus:text-sm custom-transition"
              :class="{ '!top-0 text-sm': form.password }"
              >Password</label
            >
          </div>
        </div>
        <div class="flex items-center justify-between text-sm">
          <label class="flex items-center gap-2 cursor-pointer">
            <Checkbox v-model:checked="form.remember" />
            <span class="text-secondary-100">Remember me</span>
          </label>
          <Link
            :href="route('password.request')"
            class="underline text-accent-200 hover:text-accent-100 focus:text-accent-100 outline-none font-bold custom-transition"
            >Forgot your password?</Link
          >
        </div>
        <ButtonPrimary
          :class="{ 'bg-disabled-100': isLoginButtonDisabled }"
          :disabled="isLoginButtonDisabled"
          class="w-full text-center py-4 my-4"
        >
          Log In
        </ButtonPrimary>
        <p class="text-sm text-secondary-100 text-center">
          New user?
          <Link
            :href="route('register')"
            class="underline text-accent-200 hover:text-accent-100 focus:text-accent-100 outline-none font-bold custom-transition"
            >Sign up</Link
          >
        </p>
      </form>
    </template>
    <template #extras>
      <ButtonGoogleLogin />
    </template>
  </GuestLayout>
</template>
