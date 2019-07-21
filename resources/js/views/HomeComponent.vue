<template>
  <div>
     <router-view></router-view>
  </div>
</template>

<script>
import NavbarComponent from '../components/NavbarComponent'
import SidebarComponent from '../components/SidebarComponent'
export default {
  components: {
    NavbarComponent,
    SidebarComponent
  },
  data(){
    return {
      toggle: false
    }
  },
  methods: {
    toggleSidebar(){
      this.toggle = !this.toggle
    },
  }
}
</script>

<style>

</style>
