import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    "./storage/framework/views/*.php",
    "./resources/views/**/*.blade.php",
    "./resources/js/**/*.vue",
  ],

  theme: {
    extend: {
      fontFamily: {
        primary: ["Figtree", ...defaultTheme.fontFamily.sans],
        secondary: ["Open Sans", ...defaultTheme.fontFamily.sans],
      },
      colors: {
        base: {
          100: "rgb(var(--color-base-100) / <alpha-value>)",
        },
        disabled: {
          100: "rgb(var(--color-disabled-100) / 50)",
        },
        primary: {
          100: "rgb(var(--color-primary-100) / <alpha-value>)",
        },
        secondary: {
          100: "rgb(var(--color-secondary-100) / <alpha-value>)",
        },
        accent: {
          100: "rgb(var(--color-accent-100) / <alpha-value>)",
          200: "rgb(var(--color-accent-200) / <alpha-value>)",
          300: "rgb(var(--color-accent-300) / <alpha-value>)",
        },
        error: {
          100: "rgb(var(--color-error-100) / <alpha-value>)",
        },
      },
    },
  },
  darkMode: ["class", '[data-theme="dark"]'],
  plugins: [forms],
};
