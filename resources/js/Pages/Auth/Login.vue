<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import ButtonGoogleLogin from "@/Components/Buttons/ButtonGoogleLogin.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import Form from "@/Components/Form.vue";

defineProps({
  canResetPassword: {
    type: Boolean,
  },
  status: {
    type: String,
  },
});

const form = useForm({
  email: "",
  password: "",
  remember: false,
});

const inputs = [
  {
    id: "email",
    type: "email",
    label: "Email Address",
    position: "first",
    autocomplete: "username",
  },
  {
    id: "password",
    type: "password",
    label: "Password",
    position: "last",
    autocomplete: "current-password",
  },
];

function submit() {
  form.post(route("login"), {
    onFinish: () => {
      form.reset("password");
    },
  });
}
</script>

<template>
  <GuestLayout :backRoute="route('welcome')">
    <template #body>
      <Head title="Log in" />
      <div class="text-center mb-16">
        <h1 class="font-bold text-2xl text-accent-100">
          Log in to your account
        </h1>
        <p class="text-secondary-100">Enter your details to proceed further</p>
      </div>
      <Form
        @submit="submit"
        submitText="Log In"
        :form="form"
        :inputs="inputs"
        :status="status"
        @clearStatus="status = null"
      >
        <template #before>
          <div class="flex items-center justify-between text-sm">
            <label class="flex items-center gap-2 cursor-pointer">
              <Checkbox v-model:checked="form.remember" />
              <span class="text-secondary-100">Remember me</span>
            </label>
            <Link
              v-if="canResetPassword"
              :href="route('password.request')"
              class="underline text-accent-200 hover:text-accent-100 focus:text-accent-100 outline-none font-bold custom-transition"
              >Forgot your password?</Link
            >
          </div>
        </template>
        <template #after>
          <p class="text-sm text-secondary-100 text-center">
            New user?
            <Link
              :href="route('register')"
              class="underline text-accent-200 hover:text-accent-100 focus:text-accent-100 outline-none font-bold custom-transition"
              >Sign up</Link
            >
          </p>
        </template>
      </Form>
    </template>
    <template #extras>
      <ButtonGoogleLogin />
    </template>
  </GuestLayout>
</template>
