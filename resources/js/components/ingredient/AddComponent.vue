<template>
  <div>
    <h1 class="uk-title uk-text-bold">
      Add Ingredient
    </h1>
    <form>
      <fieldset class="uk-fieldset">
        <div class="uk-margin">
          <h4 class="uk-title">Name of ingredient</h4>
          <input @keyup.self="clearErrors()" type="text" name="name" class="uk-input" v-model="ingredient.name">
        </div>
         <div v-if="errorHandler">
            <p class="uk-alert-danger" v-for="(error, index) in errors.name" :key="index" data-uk-alert>
              {{error}}
            </p>
          </div>
        <div class="uk-margin">
          <button @click.prevent="addIngredient()" class="uk-width-1-1 uk-button uk-button-primary">
            Add
          </button>
        </div>
      </fieldset>
    </form>
    <hr>
  </div>
</template>

<script>
export default {
  data(){
    return {
      ingredient: {
        name: ''
      },
      errorHandler: false,
      errors: {}
    }
  },
  methods: {
    addIngredient(){
      axios.post(`/api/ingredient`, this.ingredient, {
        headers: {
          Authorization: 'Bearer ' + localStorage.getItem('token')
        }
      })
      .then(({data}) => {
        this.errors = '',
        this.errorHandler = false,
        this.ingredient.name = '',
        UIkit.notification({
              message: 'Ingredient has been added!',
              status: 'primary',
              pos: 'top-center',
              timeout: 5000
        });
        this.$emit('data-added')
      })
      .catch( err => {
        this.errorHandler = true,
        this.errors = err.response.data.errors
      })
    },
    clearErrors(){
      if (this.ingredient.name) {
        this.errors = ''
      }
    }
  }
}
</script>

<style>

</style>
