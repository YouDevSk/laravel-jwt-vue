import Vue from 'vue';
import VueRouter from 'vue-router';
import store from './store';

// import components for router
import DashboardComponent from './views/DashboardComponent';
import RegisterComponent from './views/RegisterComponent';
import LoginComponent from './views/LoginComponent';
import HomeComponent from './views/HomeComponent';
import ErrorComponent from './components/ErrorComponent';
import IngredientsComponent from './components/ingredient/IngredientsComponent'
import DishesComponent from './components/dish/DishesComponent'

Vue.use(VueRouter);

const router = new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '*',
      name: 'error',
      component: ErrorComponent
    },
    {
      path: '/home',
      name: 'home',
      component: HomeComponent
    },
    {
      path: '/register',
      name: 'register',
      component: RegisterComponent
    },
    {
      path: '/login',
      name: 'login',
      component: LoginComponent
    },
    {
      path: '/dashboard',
      name: 'dashboard',
      component: DashboardComponent,
      meta: { requiresAuth: true }
    },
    {
      path: '/dashboard/ingredients',
      name: 'ingredients',
      component: IngredientsComponent
    },
    {
      path: '/dashboard/dishes',
      name: 'dishes',
      component: DishesComponent
    }
  ],
});

router.beforeEach((to, from, next) => {
  // check if the route requires authentication and user is not logged in
  if (to.matched.some(route => route.meta.requiresAuth) && !store.state.isLoggedIn) {
    // redirect to login page
    next({ name: 'login' })
    return
  }
  // if logged in redirect to dashboard
  if (to.path === '/login' && store.state.isLoggedIn) {
    next({name: 'dashboard'})
    return
  }

  next()
})

export default router;