<template>
  <div>
     <h1 class="uk-text-bold">Dashboard</h1>
  </div>
</template>

<script>
// store import
import store from '../store'
// components import
import IngredientsComponent from '../components/ingredient/IngredientsComponent'

export default {
  components: {
      IngredientsComponent,
  },
  data(){
    return {
      data: '',
      isLogged: false,
    }
  },
  mounted(){
    this.dashboard();
  },
  created(){
    this.isLogged = store.state.isLoggedIn
  },
  methods: {
    dashboard(){
      axios.get(`/api/dashboard`, {
      headers: {
        Authorization: 'Bearer ' + localStorage.getItem('token')
      }
    })
    .then( response => {
      this.data = response.data.data
    })
    .catch( err => {
      console.log(err.reponse.data.errors);
    })
    }
  },
}
</script>

<style lang="scss" scoped>
</style>

