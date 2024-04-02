<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import ButtonPrimary from "@/Components/Buttons/ButtonPrimary.vue";
import ButtonGoogleLogin from "@/Components/Buttons/ButtonGoogleLogin.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { computed } from "vue";

const form = useForm({
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
});

function submit() {
  form.post(route("register"), {
    onFinish: () => form.reset("password", "password_confirmation"),
  });
}

const isSigininButtonDisabled = computed(() => {
  return (
    form.processing ||
    !form.name ||
    !form.email ||
    !form.password ||
    !form.password_confirmation
  );
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
      <Head title="Register" />
      <div class="text-center mb-12">
        <h1 class="font-bold text-2xl text-accent-100">
          Register for an account
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
              id="name"
              type="text"
              class="peer block w-full p-4 rounded-t-md border-disabled-100 focus:relative focus:z-10 focus:border-accent-200 focus:ring-accent-200 custom-transition"
              :class="{ 'rounded-t-none': firstErrorMessage }"
              v-model="form.name"
              required
              autofocus
              autocomplete="name"
              @focus="form.clearErrors()"
              @input="form.clearErrors()"
            />
            <label
              for="name"
              class="cursor-text text-disabled-100 absolute z-20 top-3 left-4 text-lg peer-focus:top-0 peer-focus:text-sm custom-transition"
              :class="{ '!top-0 text-sm': form.name }"
              >Name</label
            >
          </div>
          <div class="relative">
            <input
              id="email"
              type="email"
              class="peer block w-full p-4 border-disabled-100 focus:relative focus:z-10 focus:border-accent-200 focus:ring-accent-200 custom-transition"
              v-model="form.email"
              required
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
              class="peer block w-full p-4 border-disabled-100 focus:relative focus:z-10 focus:border-accent-200 focus:ring-accent-200 custom-transition"
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
          <div class="relative">
            <input
              id="confirmPassword"
              type="password"
              class="peer block w-full rounded-b-md p-4 border-disabled-100 focus:relative focus:z-10 focus:border-accent-200 focus:ring-accent-200 custom-transition"
              v-model="form.password_confirmation"
              required
              autocomplete="new-password"
              @focus="form.clearErrors()"
              @input="form.clearErrors()"
            />
            <label
              for="confirmPassword"
              class="cursor-text text-disabled-100 absolute z-20 top-3 left-4 text-lg peer-focus:top-0 peer-focus:text-sm custom-transition"
              :class="{ '!top-0 text-sm': form.password_confirmation }"
              >Confirm Password</label
            >
          </div>
        </div>
        <ButtonPrimary
          :class="{ 'bg-disabled-100': isSigininButtonDisabled }"
          :disabled="isSigininButtonDisabled"
          class="w-full text-center py-4 my-4"
        >
          Register
        </ButtonPrimary>
        <p class="text-sm text-secondary-100 text-center">
          Already registered?
          <Link
            :href="route('login')"
            class="underline text-accent-200 hover:text-accent-100 focus:text-accent-100 outline-none font-bold custom-transition"
            >Log in</Link
          >
        </p>
      </form>
    </template>
    <template #extras>
      <ButtonGoogleLogin />
    </template>
  </GuestLayout>
</template>
