module.exports = {
  root: true,
  env: {
    browser: true,
    node: true,
  },
  parserOptions: {
    parser: 'babel-eslint',
  },
  extends: [
    '@nuxtjs',
    'prettier',
    'prettier/vue',
    'plugin:prettier/recommended',
    'plugin:nuxt/recommended',
  ],
  plugins: ['prettier'],
  // add your custom rules here


  "ruels": {
 
    //  'linebreak-style': ['error', 'windows'],
  },
  // rules: {
  //   indent: ['error', 2, { SwitchCase: 1 }],
  //   'linebreak-style': ['error', 'windows'],
  //   quotes: ['error', 'single'],
  //   semi: ['error', 'always'],
  //   'no-console': 'off',
  //   'vue/no-v-html': 'off',
  // },

}
