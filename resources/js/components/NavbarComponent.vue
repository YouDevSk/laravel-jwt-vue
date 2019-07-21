<template>
  <header id="header" class="uk-background-secondary uk-light" data-uk-sticky>
    <nav class="uk-navbar-container uk-navbar-transparent" data-uk-navbar>
      <div class="uk-navbar-left">
        <a @click.prevent="toggleSidebar()" class="uk-navbar-toggle" href="#">
          <span data-uk-navbar-toggle-icon></span>
          <span class="uk-margin-small-left uk-text-uppercase uk-text-bold">dashboard</span>
        </a>
      </div>
      <div class="uk-navbar-right">
        <ul v-if="!isLogged" class="uk-navbar-nav">
          <li>
            <router-link :to="{name:'register'}">Register</router-link>
          </li>
          <li>
            <router-link :to="{name:'login'}">Login</router-link>
          </li>
        </ul>
        <ul v-else class="uk-navbar-nav">
          <li>
            <a href="">{{currentUser.name}}</a>
            <div class="uk-navbar-dropdown uk-navbar-dropdown-right">
              <ul class="uk-nav uk-navbar-dropdown-nav">
                <li class="uk-text-bold uk-text-uppercase">
                  <a @click.prevent="logoutUser()" href="">
                    <span class="uk-icon" data-uk-icon="icon: sign-out">

                    </span>
                    <span>logout</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
    </nav>
  </header>
</template>

<script>
import store from '../store'
export default {
  data(){
    return {
      currentUser: '',
    }
  },
  created(){
    if (this.isLogged) {
      this.getCurrentUser();
    }
  },
  computed:{
    isLogged() {
      return store.getters.isLoggedIn
    }
  },
  methods: {
    getCurrentUser(){
      axios.get(`/api/auth/me`, {
        headers: {
          Authorization: 'Bearer ' + localStorage.getItem('token')
        }
      })
      .then( ({data}) => {
        this.currentUser = data
        console.log(data)
      })
      .catch( err => {
        if (err.response.status === 401 || error.response.status === 403) {
          localStorage.removeItem('token');
          store.commit('logoutUser');
          this.$router.push({ name: 'login' });
        }
      })
    },
    logoutUser(){
      localStorage.removeItem('token');
      store.commit('logoutUser');
      this.$router.push({ name: 'login' });
    },
    toggleSidebar(){
      this.$emit('sidebar')
    }
  }
}
</script>

<style>

</style>
