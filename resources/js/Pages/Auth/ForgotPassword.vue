<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import Form from "@/Components/Form.vue";

const props = defineProps({
  status: {
    type: String,
  },
});

const form = useForm({
  email: "",
});

const inputs = [
  {
    id: "email",
    type: "email",
    label: "Email Address",
    position: "alone",
    autocomplete: "username",
  },
];

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
      <Form
        @submit="submit"
        submitText="Email Password Reset Link"
        buttonStyle="end"
        :form="form"
        :inputs="inputs"
        :status="status"
        @clearStatus="status = null"
      />
    </template>
  </GuestLayout>
</template>
