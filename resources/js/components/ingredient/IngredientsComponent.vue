<template>
  <div>
    <add-component @data-added='getIngredients()'></add-component>
    <h1 class="uk-text-bold">Ingredients:</h1>
    <div class="uk-section">
      <table class="uk-table uk-table-striped">
        <thead>
          <tr>
            <th>Ingredient name</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="ingredient in ingredients" :key="ingredient.id">
            <td>
              {{ ingredient.name | capitalize }}
            </td>
            <td class="uk-align-right uk-margin-remove-left uk-margin-remove-bottom">
              <button class="uk-button uk-button-primary" type="button" data-uk-toggle="target: #modal-update-ingredient" @click="editIngredient(ingredient)">Edit</button>
            </td>
            <td class="uk-align-right uk-margin-remove-bottom">
              <button @click.prevent="deleteIngredient(ingredient.id)" class="uk-button uk-button-danger" type="button">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- modal -->
    <div id="modal-update-ingredient" data-uk-modal>
      <div class="uk-modal-dialog uk-modal-body uk-text-center">
        <h3 class="uk-modal-title uk-text-bold">Update your ingredient</h3>
        <form>
          <fieldset class="uk-fieldset">
            <div class="uk-margin">
              <input type="text" class="uk-input" name="name" v-model="ingredient.name">
            </div>
            <p>
              <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
              <button @click.prevent="updateIngredient(ingredient.id)" class="uk-button uk-button-primary" type="button">Save</button>
            </p>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import AddComponent from './AddComponent';
export default {
  components: {
    AddComponent,
  },
  data(){
    return {
      ingredients: [],
      ingredient: {
        id: '',
        name: ''
      },
    }
  },
  created(){
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
    updateIngredient(id){
      if (confirm('Are you sure?')) {
        axios.put(`/api/ingredient/${id}`, this.ingredient , {
          headers: {
            Authorization: 'Bearer ' + localStorage.getItem('token')
          }
        })
        .then(({data}) => {
          UIkit.notification({
              message: 'Ingredient has been edited!',
              status: 'success',
              pos: 'top-center',
              timeout: 5000
          });
          UIkit.modal('#modal-update-ingredient').hide();
          this.getIngredients();
        })
        .catch(err => {
          console.log(err.response.data);
        });
      }
    },
    editIngredient(ingredient){
      this.ingredient.name = ingredient.name,
      this.ingredient.id = ingredient.id
    },
    deleteIngredient(id) {
      if (confirm('Are you sure?')) {
        axios.delete(`/api/ingredient/${id}`, {
           headers: {
            Authorization: 'Bearer ' + localStorage.getItem('token')
          }
        })
        .then(({data}) => {
          UIkit.notification({
              message: 'Ingredient has been deleted!',
              status: 'danger',
              pos: 'top-center',
              timeout: 5000
          });
          this.getIngredients();
        })
        .catch(err => console.log(err));
      }
    }
  },
}
</script>

<style>

</style>
