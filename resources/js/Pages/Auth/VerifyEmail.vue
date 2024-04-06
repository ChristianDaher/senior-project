<script setup>
import { computed } from "vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import ButtonPrimary from "@/Components/Buttons/ButtonPrimary.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const props = defineProps({
  status: {
    type: String,
  },
});

const form = useForm({});

function submit() {
  form.post(route("verification.send"));
}

const verificationLinkSent = computed(
  () => props.status === "verification-link-sent"
);
</script>

<template>
  <GuestLayout :backRoute="route('profile.edit')">
    <template #body>
      <Head title="Email Verification" />
      <div class="mb-4 text-sm text-secondary-100">
        Thanks for signing up! Before getting started, could you verify your
        email address by clicking on the link we just emailed to you? If you
        didn't receive the email, we will gladly send you another.
      </div>
      <div
        class="mb-4 font-medium text-sm text-accent-100"
        v-if="verificationLinkSent"
      >
        A new verification link has been sent to the email address you provided
        during registration.
      </div>
      <form @submit.prevent="submit">
        <div class="mt-4 flex items-center justify-between">
          <ButtonPrimary
            :class="{ 'bg-disabled-100': form.processing }"
            :disabled="form.processing"
          >
            Resend Verification Email
          </ButtonPrimary>
          <Link
            :href="route('logout')"
            method="post"
            as="button"
            class="underline text-sm text-accent-200 hover:text-accent-100 focus:text-accent-100 outline-none font-bold custom-transition"
            >Log Out</Link
          >
        </div>
      </form>
    </template>
  </GuestLayout>
</template>
