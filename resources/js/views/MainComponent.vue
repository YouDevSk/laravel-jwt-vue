<template>
    <div>
        <div v-if="!isLogged">
            <login-component></login-component>
        </div>
        <div v-else>
            <navbar-component @sidebar='toggleSidebar'></navbar-component>
            <div class="uk-flex" data-uk-grid>
                <sidebar-component :msg='toggle'></sidebar-component>
                <div id="main"  class="uk-padding uk-width-expand">
                    <home-component></home-component>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
// store
import store from '../store'
// components
import LoginComponent from './LoginComponent'
import HomeComponent from '../views/HomeComponent'
import NavbarComponent from '../components/NavbarComponent'
import SidebarComponent from '../components/SidebarComponent'
    export default {
        components: {
            LoginComponent,
            HomeComponent,
            NavbarComponent,
            SidebarComponent
        },
       data(){
            return {
            toggle: false
            }
        },
        computed:{
            isLogged() {
            return store.getters.isLoggedIn
            }
        },
        methods: {
            toggleSidebar(){
            this.toggle = !this.toggle
            },
        }
    }
</script>
<style lang="scss" scoped>
  #main {
    margin-left: 45px;
  }
</style>

