<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import ButtonPrimary from "@/Components/Buttons/ButtonPrimary.vue";
import ButtonGoogleLogin from "@/Components/Buttons/ButtonGoogleLogin.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { computed } from "vue";
import Form from "@/Components/Form.vue";

const form = useForm({
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
});

const inputs = [
  {
    id: "name",
    type: "text",
    label: "Name",
    position: "first",
    autocomplete: "name",
  },
  {
    id: "email",
    type: "email",
    label: "Email Address",
    position: "middle",
    autocomplete: "username",
  },
  {
    id: "password",
    type: "password",
    label: "Password",
    position: "middle",
    autocomplete: "current-password",
  },
  {
    id: "password_confirmation",
    type: "password",
    label: "Confirm Password",
    position: "last",
    autocomplete: "new-password",
  },
];

function submit() {
  form.post(route("register"), {
    onFinish: () => form.reset("password", "password_confirmation"),
  });
}
</script>

<template>
  <GuestLayout :backRoute="route('welcome')">
    <template #body>
      <Head title="Register" />
      <div class="text-center mb-16">
        <h1 class="font-bold text-2xl text-accent-100">
          Register for an account
        </h1>
        <p class="text-secondary-100">Enter your details to proceed further</p>
      </div>
      <Form
        @submit="submit"
        submitText="Register"
        :form="form"
        :inputs="inputs"
      >
        <template #after>
          <p class="text-sm text-secondary-100 text-center">
            Already registered?
            <Link
              :href="route('login')"
              class="underline text-accent-200 hover:text-accent-100 focus:text-accent-100 outline-none font-bold custom-transition"
              >Log in</Link
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
