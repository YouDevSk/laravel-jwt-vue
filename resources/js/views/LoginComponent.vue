<template>
  <div class="uk-position-center">
    <h2 class="uk-title uk-text-center uk-text-bold">Login</h2>
    <form class="uk-width-large" v-on:keyup='clearErrors'>
      <fieldset class="uk-fieldset">
        <div class="uk-margin"><input type="email" class="uk-input" placeholder="Email" v-model="login.email"></div>
        <div class="uk-margin"><input type="password" class="uk-input" placeholder="Password" v-model="login.password"></div>
         <div v-if="login.loginError">
          <div class="uk-alert uk-alert-danger" data-uk-alert>
            Skontrolujte svoje prihlasovacie údaje
          </div>
        </div>
        <div class="uk-margin">
          <button @click.prevent="loginUser" type="submit" class="uk-width-1-1 uk-button uk-button-primary">
            Login
          </button>
        </div>
      </fieldset>
    </form>
  </div>
</template>

<script>
import store from '../store'
export default {
  data(){
    return {
      login: {
        email: '',
        password: '',
        loginError: false,
      }
    }
  },
  methods: {
    loginUser(){
      this.loginError = false;
      axios.post(`/api/auth/login `, {
          email: this.login.email,
          password: this.login.password
      })
      .then( res => {
        store.commit('loginUser');
        localStorage.setItem('token', res.data.access_token);
        this.$router.push({name: 'dashboard'});
      })
      .catch( err => {
        this.login.loginError = true
      })
    },
    clearErrors(){
      this.login.loginError = ''
    }
  }
}
</script>

<style>

</style>