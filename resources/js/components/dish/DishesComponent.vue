<template>
  <div>
    <addDish-component @dishAdded='getAllDishes()'></addDish-component>
    <h1 class="uk-text-bold">Dishes</h1>
    <table class="uk-table uk-table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Ingredients</th>
          <th>Action buttons</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="dish in dishes" :key="dish.id">
          <td>{{dish.id}}</td>
          <td>
            {{ dish.name | capitalize }}
          </td>
          <td>
            <p v-for="ingredient in dish.ingredients" :key="ingredient.id">
              {{ingredient.name}}
            </p>
          </td>
          <td>
            <button @click="editDish(dish)" class="uk-button uk-button-primary" type="button" data-uk-toggle="target: #modal-update-dish">Edit</button>
            <button @click.prevent="deleteDish(dish.id)" class="uk-button uk-button-danger" type="button">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
    <!-- modal -->
    <div id="modal-update-dish" data-uk-modal>
      <div class="uk-modal-dialog uk-modal-body uk-text-center">
        <h3 class="uk-modal-title uk-text-bold">Update your Dish</h3>
        <form>
          <fieldset class="uk-fieldset">
            <div class="uk-margin">
              <input type="text" class="uk-input" name="name" v-model="dish.name">
            </div>
            <div class="uk-margin">
              <input type="text" class="uk-input" name="price" v-model="dish.price">
            </div>
            <div class="uk-margin">
              <legend class="uk-legend uk-margin-small-bottom">Ingredients:</legend>
              <label for="ingredient" v-for="ingredient in ingredients" :key="ingredient.id">
                <input type="checkbox" :value="ingredient.id" name="ingredient[]" class="uk-checkbox" v-model="dish.ingredient">
                {{ ingredient.name }}
              </label>
            </div>
            <p>
              <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
              <button @click.prevent="updateDish(dish.id)" class="uk-button uk-button-primary" type="button">Save</button>
            </p>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import AddDishComponent from './AddDishComponent'
export default {
  components: {
    AddDishComponent
  },
  data(){
    return {
      ingredients: [],
      dishes: [],
      dish: {
        id: '',
        name: '',
        price: '',
        ingredient: []
      }
    }
  },
  created(){
    this.getAllDishes();
    this.getIngredients();
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
    getAllDishes(){
      axios.get(`/api/dish`, {
        headers: {
          Authorization: 'Bearer ' + localStorage.getItem('token')
        }
      })
      .then(({data}) => {
        this.dishes = data.data
      })
      .catch( err => {
        console.log(err.response.data.errors);
      })
    },
    editDish(dish){
      this.dish.id = dish.id,
      this.dish.name = dish.name,
      this.dish.price = dish.price
    },
    updateDish(id){
      if (confirm('Are you sure?')) {
        axios.put(`/api/dish/${id}`, this.dish , {
          headers: {
            Authorization: 'Bearer ' + localStorage.getItem('token')
          }
        })
        .then(({data}) => {
          UIkit.notification({
              message: 'dish has been edited!',
              status: 'success',
              pos: 'top-center',
              timeout: 5000
          });
          UIkit.modal('#modal-update-dish').hide();
          this.getAllDishes();
        })
        .catch(err => {
          console.log(err.response.data);
        });
      }
    },
    deleteDish(id){
      if (confirm('Are you sure?')) {
        axios.delete(`/api/dish/${id}`, {
           headers: {
            Authorization: 'Bearer ' + localStorage.getItem('token')
          }
        })
        .then(({data}) => {
          UIkit.notification({
              message: 'Dish has been deleted!',
              status: 'danger',
              pos: 'top-center',
              timeout: 5000
          });
          this.getAllDishes();
        })
        .catch(err => console.log(err));
      }
    }
  }
}
</script>

<style lang="scss" scoped>

</style>

