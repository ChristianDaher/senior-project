<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import ButtonPrimary from "@/Components/Buttons/ButtonPrimary.vue";
import ButtonGooglesignin from "@/Components/Buttons/ButtonGoogleSignin.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { computed } from "vue";

const form = useForm({
  email: "",
  password: "",
  remember: false,
});

function submit() {
  form.post(route("login"), {
    onFinish: () => form.reset("password"),
  });
}

const isSigninButtonDisabled = computed(() => {
  return form.processing || !form.email || !form.password;
});
</script>

<template>
  <GuestLayout>
    <template #body>
      <Head title="Log in" />

      <div class="text-center mb-4">
        <h1 class="font-bold text-2xl text-accent-100">
          Log in to your account
        </h1>
        <p class="text-secondary-100">Enter your details to proceed further</p>
      </div>

      <form @submit.prevent="submit">
        <div class="my-4" :class="{'' :form.hasErrors}">
          <input
            type="email"
            class="block w-full rounded-t-md p-4 border border-disabled-100 outline-none hover:ring-2 active:ring-2 focus:ring-2 hover:ring-accent-200 active:ring-accent-100 focus:ring-accent-100 transition ease-in-out duration-150"
            v-model="form.email"
            required
            autofocus
            autocomplete="username"
          />
          <input
            id="password"
            type="password"
            class="block w-full rounded-b-md p-4 border border-disabled-100 outline-none hover:ring-2 active:ring-2 focus:ring-2 hover:ring-accent-200 active:ring-accent-100 focus:ring-accent-100 transition ease-in-out duration-150"
            v-model="form.password"
            required
            autocomplete="current-password"
          />
        </div>

        <label class="flex items-center gap-2 cursor-pointer">
          <Checkbox v-model:checked="form.remember" />
          <span class="text-sm text-secondary-100">Remember me</span>
        </label>

        <ButtonPrimary
          :class="{ 'bg-disabled-100': isSigninButtonDisabled }"
          :disabled="isSigninButtonDisabled"
          class="w-full text-center py-4 my-4"
        >
          Sign In
        </ButtonPrimary>

        <p class="text-sm text-secondary-100 text-center">
          Forgot your password?
          <Link
            :href="route('password.request')"
            class="underline text-accent-200 hover:text-accent-100 focus:text-accent-100 outline-none transition ease-in-out duration-150 font-bold"
            >Tap here</Link
          >
        </p>
      </form>
    </template>
    <template #extras>
      <ButtonGooglesignin />
    </template>
  </GuestLayout>
</template>
