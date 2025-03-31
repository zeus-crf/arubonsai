/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.{html,js}"], // Inclui todos os arquivos HTML e JS no projeto
  theme: {
    fontFamily: {
      'sans': ['Roboto', 'sans-serif'], // Define a fonte padrão
    },
    extend: {
      colors: {
        lime: {
          900: "#3F6212", // Cor já existente no Tailwind, mas você pode sobrescrever ou personalizar
        },
      },
     
    },
  },
  plugins: [],
};
