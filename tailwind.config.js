/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./resources/**/*.{html,js,blade.php}'],
  theme: {
    extend: {
      borderRadius: {
        'custom-t': '100px',
      },
      fontFamily: {
        sans: [
          'Poppins', 'sans-serif'
        ],
      },
      colors: {
        customColor: {
          biru: '#5274DA',
          putih: '#FFFFFF',
          kuning: '#FFED4A',
          hijau: '#0AB965',
        }
      }
    },
  },
  plugins: [],
}
