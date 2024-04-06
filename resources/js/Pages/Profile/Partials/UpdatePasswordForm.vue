<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref, computed } from "vue";
import Form from "@/Components/Form.vue";

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
  current_password: "",
  password: "",
  password_confirmation: "",
});

const inputs = [
  {
    id: "current_password",
    type: "password",
    label: "Current Password",
    position: "first",
    autocomplete: "current-password",
  },
  {
    id: "password",
    type: "password",
    label: "New Password",
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

function updatePassword() {
  form.put(route("password.update"), {
    preserveScroll: true,
    onSuccess: () => form.reset(),
    onError: () => {
      if (form.errors.password) {
        form.reset("password", "password_confirmation");
        passwordInput.value.focus();
      }
      if (form.errors.current_password) {
        form.reset("current_password");
        currentPasswordInput.value.focus();
      }
    },
  });
}

const status = computed(() => (form.recentlySuccessful ? "Saved New Password" : null));
</script>

<template>
  <section>
    <header>
      <h2 class="text-lg font-medium text-primary-100">Update Password</h2>
      <p class="mt-1 text-sm text-secondary-100">
        Ensure your account is using a long, random password to stay secure.
      </p>
    </header>
    <Form
      class="mt-12"
      @submit="updatePassword"
      submitText="Save"
      buttonStyle="start"
      :form="form"
      :inputs="inputs"
      :status="status"
    >
    </Form>
  </section>
</template>
