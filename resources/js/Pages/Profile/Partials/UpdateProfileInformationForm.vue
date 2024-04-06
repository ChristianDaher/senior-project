<script setup>
import { Link, useForm, usePage } from "@inertiajs/vue3";
import { computed } from "vue";
import Form from "@/Components/Form.vue";

defineProps({
  mustVerifyEmail: {
    type: Boolean,
  },
  status: {
    type: String,
  },
});

const user = usePage().props.auth.user;

const form = useForm({
  name: user.name,
  email: user.email,
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
    position: "last",
    autocomplete: "email",
  },
];

function submit() {
  form.patch(route("profile.update"));
}

const status = computed(() => (form.recentlySuccessful ? "Updated Info" : null));
</script>

<template>
  <section>
    <header>
      <h2 class="text-lg font-medium text-primary-100">Profile Information</h2>
      <p class="mt-1 text-sm text-secondary-100">
        Update your account's profile information and email address.
      </p>
    </header>
    <Form
      class="mt-12"
      @submit="submit"
      submitText="Save"
      buttonStyle="start"
      :form="form"
      :inputs="inputs"
      :status="status"
    >
      <template #before>
        <div v-if="mustVerifyEmail && user.email_verified_at === null">
          <p class="text-sm mt-2 text-primary-100">
            Your email address is unverified.
          <Link
              :href="route('verification.send')"
              method="post"
              as="button"
              class="underline text-sm text-accent-200 hover:text-accent-100 focus:text-accent-100 outline-none font-bold custom-transition"
            >
              Click here to re-send the verification email.
            </Link>
          </p>

          <div
            v-show="status === 'verification-link-sent'"
            class="mt-2 font-medium text-sm text-accent-100"
          >
            A new verification link has been sent to your email address.
          </div>
        </div>
      </template>
    </Form>
  </section>
</template>
