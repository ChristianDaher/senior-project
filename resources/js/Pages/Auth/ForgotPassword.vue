<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import ButtonPrimary from "@/Components/Buttons/ButtonPrimary.vue";
import { Head, useForm } from "@inertiajs/vue3";

defineProps({
  status: {
    type: String,
  },
});

const form = useForm({
  email: "",
});

function submit() {
  form.post(route("password.email"));
}
</script>

<template>
  <GuestLayout :backRoute="route('login')">
    <template #body>
      <Head title="Forgot Password" />
      <div class="mb-12 text-sm text-secondary-100">
        Forgot your password? No problem. Just let us know your email address
        and we will email you a password reset link that will allow you to
        choose a new one.
      </div>
      <form @submit.prevent="submit">
        <div
          class="my-4 rounded-md relative"
          :class="{
            'ring-2 ring-error-100': form.errors.email,
            'ring-2 ring-accent-100': status,
          }"
        >
          <div
            v-show="form.errors.email || status"
            class="absolute bottom-[calc(100%-2px)] w-full text-center text-base-100 py-2 ring-2 rounded-t-md"
            :class="{
              'ring-error-100 bg-error-100 border-error-100': form.errors.email,
              'ring-accent-100 bg-accent-100 border-accent-100': status,
            }"
          >
            {{ form.errors.email || status }}
          </div>
          <div class="relative">
            <input
              id="email"
              type="email"
              class="peer block w-full rounded-md p-4 border-disabled-100 focus:relative focus:z-10 focus:border-accent-200 focus:ring-accent-200 custom-transition"
              :class="{ 'rounded-t-none': form.errors.email || status }"
              v-model="form.email"
              required
              autofocus
              autocomplete="username"
              @input="form.clearErrors(), status = ''"
            />
            <label
              for="email"
              class="cursor-text text-disabled-100 absolute z-20 top-3 left-4 text-lg peer-focus:top-0 peer-focus:text-sm custom-transition"
              :class="{ '!top-0 text-sm': form.email }"
              >Email</label
            >
          </div>
        </div>
        <div class="flex items-center justify-end mt-4">
          <ButtonPrimary
            :class="{ 'bg-disabled-100': form.processing || !form.email }"
            :disabled="form.processing || !form.email"
          >
            Email Password Reset Link
          </ButtonPrimary>
        </div>
      </form>
    </template>
  </GuestLayout>
</template>
