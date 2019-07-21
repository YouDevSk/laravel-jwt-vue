<template>
  <div class="uk-position-center">
    <h2 class="uk-title uk-text-center uk-text-bold">Register</h2>
    <form class="uk-width-large">
      <fieldset class="uk-fieldset">
        <div class="uk-margin">
          <input @keyup.self="clearErrors()" type="text" class="uk-input" placeholder="Name" v-model="register.name">
        </div>
        <!-- error message -->
        <div v-if="errors.name">
          <div class="uk-alert-danger" data-uk-alert>
            <p v-for="(error,index) in errors.name" :key="index">
              {{error}}
            </p>
          </div>
        </div>
        <div class="uk-margin">
          <input @keyup.self="clearErrors()" type="email" class="uk-input" placeholder="Email" v-model="register.email">
        </div>
        <!-- error message -->
        <div v-if="errors.email">
          <div class="uk-alert-danger" data-uk-alert>
            <p v-for="(error,index) in errors.email" :key="index">
              {{error}}
            </p>
          </div>
        </div>
        <div class="uk-margin">
          <input @keyup.self="clearErrors()" type="password" class="uk-input" placeholder="Password" v-model="register.password">
        </div>
         <!-- error message -->
        <div v-if="errors.password">
          <div class="uk-alert-danger" data-uk-alert>
            <p v-for="(error,index) in errors.password" :key="index">
              {{error}}
            </p>
          </div>
        </div>
        <div class="uk-margin">
          <input @keyup.self="clearErrors()" type="password" class="uk-input" placeholder="Password" v-model="register.password_confirmation">
        </div>
        <div class="uk-margin">
          <button @click.prevent="registerUser()" type="submit" class="uk-width-1-1 uk-button uk-button-primary">Register</button>
        </div>
      </fieldset>
    </form>
  </div>
</template>

<script>
export default {
  data(){
    return {
      register: {
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
      },
      errors: []
    }
  },
  mounted(){
    this.checkUsers();
  },
  methods: {
    registerUser(){
      axios.post(`api/auth/register`, this.register)
      .then(this.$router.push('dashboard'))
      .catch( err => {
        this.errors = err.response.data.errors;
      })
    },
    clearErrors(){
      if (this.register.name) {
        this.errors.name = ''
      } if (this.register.email){
        this.errors.email = ''
      } if (this.register.password && this.register.password_confirmation){
        this.errors.password = ''
      }
    },
    checkUsers(){
       axios.get(`/api/check-user`)
      .then( ({data}) => {
        if (data) {
          this.$router.push('login')
        }
      })
      .catch( err => {
        console.log(err.response.data);
      })
    }
  }
}
</script>

<style>

</style>
