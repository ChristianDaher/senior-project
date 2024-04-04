<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import ButtonPrimary from "@/Components/Buttons/ButtonPrimary.vue";
import { Head, useForm} from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
  email: {
    type: String,
    required: true,
  },
  token: {
    type: String,
    required: true,
  },
});

const form = useForm({
  token: props.token,
  email: props.email,
  password: "",
  password_confirmation: "",
});

function submit() {
  form.post(route("password.store"), {
    onFinish: () => form.reset("password", "password_confirmation"),
  });
}

const isResetButtonDisabled = computed(() => {
  return (
    form.processing ||
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
  <GuestLayout>
    <template #body>
      <Head title="Reset Password" />
      <form @submit.prevent="submit" class="mt-12">
        <div
          class="my-4 rounded-md relative"
          :class="{
            'ring-2 ring-error-100': firstErrorMessage,
          }"
        >
          <div
            v-show="firstErrorMessage"
            class="absolute bottom-[calc(100%-2px)] w-full ring-error-100 bg-error-100 text-center text-base-100 py-2 border-error-100 ring-2 rounded-t-md"
          >
            {{ firstErrorMessage }}
          </div>
          <div class="relative">
            <input
              id="email"
              type="email"
              class="peer block w-full p-4 rounded-t-md border-disabled-100 focus:relative focus:z-10 focus:border-accent-200 focus:ring-accent-200 custom-transition"
              :class="{ 'rounded-t-none': firstErrorMessage }"
              v-model="form.email"
              required
              autofocus
              autocomplete="username"
              @input="form.clearErrors()"
            />
            <label
              for="email"
              class="cursor-text text-disabled-100 absolute z-20 top-3 left-4 text-lg peer-focus:top-0 peer-focus:text-sm custom-transition"
              :class="{ '!top-0 text-sm': form.email }"
              >Email</label
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
        <div class="flex items-center justify-end mt-4">
          <ButtonPrimary
            :class="{ 'opacity-25': isResetButtonDisabled }"
            :disabled="isResetButtonDisabled"
          >
            Reset Password
          </ButtonPrimary>
        </div>
      </form>
    </template>
  </GuestLayout>
</template>
