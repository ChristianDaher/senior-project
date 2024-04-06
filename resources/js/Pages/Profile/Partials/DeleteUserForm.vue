<script setup>
import ButtonDanger from "@/Components/Buttons/ButtonDanger.vue";
import Modal from "@/Components/Modal.vue";
import ButtonSecondary from "@/Components/Buttons/ButtonSecondary.vue";
import { useForm } from "@inertiajs/vue3";
import { nextTick, ref } from "vue";
import Form from "@/Components/Form.vue";

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
  password: "",
});

const inputs = [
  {
    id: "password",
    type: "password",
    label: "Current Password",
    position: "alone",
    autocomplete: "current-password",
    ref: passwordInput,
  },
];

function confirmUserDeletion() {
  confirmingUserDeletion.value = true;
  nextTick(() => passwordInput.value.focus());
}

function deleteUser() {
  form.delete(route("profile.destroy"), {
    preserveScroll: true,
    onSuccess: () => closeModal(),
    onError: () => passwordInput.value.focus(),
    onFinish: () => form.reset(),
  });
}

function closeModal() {
  confirmingUserDeletion.value = false;
  form.reset();
}
</script>

<template>
  <section class="space-y-6">
    <header>
      <h2 class="text-lg font-medium text-primary-100">Delete Account</h2>
      <p class="mt-1 text-sm text-secondary-100">
        Once your account is deleted, all of its resources and data will be
        permanently deleted. Before deleting your account, please download any
        data or information that you wish to retain.
      </p>
    </header>
    <ButtonDanger @click="confirmUserDeletion">Delete Account</ButtonDanger>
    <Modal :show="confirmingUserDeletion" @close="closeModal">
      <div class="p-6">
        <h2 class="text-lg font-medium text-primary-100">
          Are you sure you want to delete your account?
        </h2>
        <p class="mt-1 text-sm text-secondary-100">
          Once your account is deleted, all of its resources and data will be
          permanently deleted. Please enter your password to confirm you would
          like to permanently delete your account.
        </p>
        <Form
          class="mt-12"
          @submit="deleteUser"
          submitText="Delete"
          buttonStyle="none"
          :form="form"
          :inputs="inputs"
        >
          <template #main>
            <div class="flex justify-end gap-4">
              <ButtonSecondary @click="closeModal"> Cancel </ButtonSecondary>
              <ButtonDanger
                :disabled="form.processing"
                :class="{ 'bg-disabled-100': form.processing }"
              >
                Delete
              </ButtonDanger>
            </div>
          </template>
        </Form>
      </div>
    </Modal>
  </section>
</template>
