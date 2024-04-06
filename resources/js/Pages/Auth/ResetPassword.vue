<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import Form from "@/Components/Form.vue";

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
    position: "middle",
    autocomplete: "new-password",
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
  form.post(route("password.store"), {
    onFinish: () => form.reset("password", "password_confirmation"),
  });
}
</script>

<template>
  <GuestLayout>
    <template #body>
      <Head title="Reset Password" />
      <Form
        class="mt-12"
        @submit="submit"
        submitText="Reset Password"
        buttonStyle="end"
        :form="form"
        :inputs="inputs"
      />
    </template>
  </GuestLayout>
</template>
