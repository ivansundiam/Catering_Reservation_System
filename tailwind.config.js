import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";

/** @type {import('tailwindcss').Config} */

const colors = require("tailwindcss/colors");

export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],

    safelist: ["bg-green-100", "bg-red-100", "bg-blue-100", "bg-yellow-100"],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
                serif: ["ui-serif, Georgia, Cambria"],
                tai: ["Tai Heritage Pro"],
                noticia: ["Noticia Text"],
            },

            container: {
                center: true,
                padding: {
                    DEFAULT: "0.5rem",
                    sm: "2rem",
                    lg: "4rem",
                    xl: "5rem",
                    "2xl": "6rem",
                },
            },

            colors: {
                primary: {
                    // RED
                    // DEFAULT: "#e37171",
                    // hover: "#e88d8d",
                    // active: "#b55a5a",
                    // light: "#f9e2e2",

                    // GREEN
                    // DEFAULT: "#65a30d",
                    // hover: "#a3e635",
                    // active: "#3f6212",
                    // light: "#f7fee7",

                    // ORANGE
                    // DEFAULT: "#e56e0c",
                    // hover: "#ea8b3c",
                    // active: "#b75809",
                    // light: "#f3ede1",

                    // BROWN
                    DEFAULT: "#D09c4c",
                    hover: "#D9AF6F",
                    active: "#a67c3c",
                    light: "#f5ebdb",
                },

                mainblue: "#333f72",
                green: colors.green,
            },
        },
    },
    // toggle dark mode
    darkMode: "class",

    plugins: [forms, typography, require("flowbite/plugin")],
};
