<template>
  <div>
    <aside id="sidebar" class="uk-background-secondary uk-light" ref="app">
      <ul class="uk-padding-small uk-nav-default uk-nav-parent-icon uk-width-auto" data-uk-nav>
        <li class="uk-nav-header">
          <router-link :to="{name:'dashboard'}">
            <span class="uk-margin-small-right" uk-icon="icon: home"></span>
            <div class="uk-text-left sidebar-item">
              Home
            </div>
          </router-link>
        </li>
        <li class="uk-nav-header">
          <router-link :to="{name:'ingredients'}">
            <span class="uk-margin-small-right" uk-icon="icon: paint-bucket"></span>
            <div class="uk-text-left sidebar-item">
              ingredients
            </div>
          </router-link>
        </li>
        <li class="uk-nav-header">
          <router-link :to="{name:'dishes'}">
            <span class="uk-margin-small-right" uk-icon="icon: file-text"></span>
            <div class="uk-text-left sidebar-item">
              Dishes
            </div>
          </router-link>
        </li>
      </ul>
    </aside>
  </div>
</template>

<script>
export default {
  props: {
    msg: {
      type: Boolean
    }
  },
  data(){
    return {
      
    }
  },
  watch: {
    msg(){
      const sidebarItems = document.querySelectorAll('.sidebar-item');
        sidebarItems.forEach(sidebarItem => {

          if (this.msg) {
            sidebarItem.style.width = '200px';
            sidebarItem.style.opacity = '1';
            sidebarItem.style.display = 'inline-block';
          } else {
            sidebarItem.style.width = '0';
            sidebarItem.style.opacity = '0';
            sidebarItem.style.display = 'none';
          }
        });
    }
  }
}
</script>

<style lang="scss" scoped>
#sidebar {
  position: fixed;
  height: calc(100vh - 80px);
}

#sidebar ul {
  padding-right: 0;
}

.active {
  transition: width .5s;
  width: 300px;
}

#sidebar .sidebar-item {
  display: none;
  opacity: 0;
  width: 0;
  transition: .3s;
  -webkit-transition: .3s;
  -moz-transition: .3s;
  -ms-transition: .3s;
  -o-transition: .3s;
}
</style>

