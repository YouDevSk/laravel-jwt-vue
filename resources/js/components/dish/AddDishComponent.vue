<template>
  <div>
    <h1 class="uk-text-bold">Add Dish</h1>
    <form>
      <fieldset class="uk-fieldset">
        <div class="uk-margin">
          <input type="text" name="name" placeholder="your dish" v-model="dish.name" class="uk-input">
        </div>
        <div v-if="errorHandler">
          <p class="uk-alert-danger" v-for="(error, index) in errors.name" :key="index" data-uk-alert>
            {{error}}
          </p>
        </div>
        <div class="uk-margin">
          <input type="text" name="price" placeholder="your price" class="uk-input" v-model="dish.price">
        </div>
         <div v-if="errorHandler">
          <p class="uk-alert-danger" v-for="(error, index) in errors.price" :key="index" data-uk-alert>
            {{error}}
          </p>
        </div>
         <div class="uk-margin">
          <legend class="uk-legend uk-margin-small-bottom">Ingredients:</legend>
          <label for="ingredient" v-for="ingredient in ingredients" :key="ingredient.id">
            <input type="checkbox" :value="ingredient.id" name="ingredient[]" class="uk-checkbox" v-model="dish.ingredient">
            {{ ingredient.name }}
          </label>
        </div>
        <div class="uk-margin">
          <button @click.prevent="addDish()" class="uk-button">Add dish</button>
        </div>
      </fieldset>
    </form>
  </div>
</template>

<script>
export default {
  data(){
    return {
      ingredients: [],
      dish: {
        id: '',
        name: '',
        price: '',
        ingredient: []
      },
      errorHandler: false,
      errors: {}
    }
  },
  created(){
    this.getIngredients()
  },
  methods: {
    getIngredients(){
      axios.get(`/api/ingredient`, {
      headers: {
        Authorization: 'Bearer ' + localStorage.getItem('token')
      }
    })
      .then(({data}) => {
        this.ingredients = data.data
      })
      .catch( e => {
        console.log(e)
      })
    },
    addDish(){
      axios.post(`/api/dish`, this.dish, {
        headers: {
          Authorization: 'Bearer ' + localStorage.getItem('token')
        }
      })
      .then(({data}) => {
        this.errors = '',
        this.errorHandler = false,
        this.dish.name = '',
        this.dish.price = '',
        UIkit.notification({
              message: 'Dish has been added!',
              status: 'primary',
              pos: 'top-center',
              timeout: 5000
        });
        this.$emit('dishAdded');
      })
      .catch( err => {
        this.errorHandler = true,
        this.errors = err.response.data.errors
      })
    }
  }
}
</script>

<style>

</style>
