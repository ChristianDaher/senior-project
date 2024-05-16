<script setup>
import Form from "@/Components/Form.vue";
import { useForm } from "@inertiajs/vue3";

const form = useForm({
  name: "",
  email: "",
  subject: "",
  message: "",
});

const inputs = [
  {
    id: "name",
    type: "text",
    label: "Full Name",
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
    id: "subject",
    type: "text",
    label: "Subject",
    position: "middle",
  },
  {
    id: "message",
    type: "textarea",
    label: "Message",
    position: "last",
  },
];

function submit() {
  form.post(route("contact"), {
    preserveScroll: true,
  });
}
</script>

<template>
  <div>
    <h2 class="text-4xl font-bold text-center my-16">Get in Touch</h2>
    <Form
      class="container sm:w-3/4 lg:w-1/2"
      @submit="submit"
      submitText="Send Message"
      :form="form"
      :inputs="inputs"
      :autofocus="false"
    />
  </div>
</template>
