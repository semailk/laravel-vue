import { createRouter, createWebHistory } from 'vue-router'

import Home from '../components/Home';
import AddRent from '../components/AddRent.vue';
import AddEmployee from '../components/AddEmployee.vue';
import Booking from '../components/Booking.vue';
import AddClient from "@/components/AddClient";
import EditBooking from '../components/EditBooking.vue'

export const routes = [
  {
    name: 'home',
    path: '/',
    component: Home
  },
  {
    name: 'add-client',
    path: '/add/client',
    component: AddClient
  },
  {
    name: 'add-rent',
    path: '/add/rent',
    component: AddRent
  },
  {
    name: 'add-employee',
    path: '/add/employee',
    component: AddEmployee
  },
  {
    name: 'edit-booking',
    path: '/edit/booking/:id',
    component: EditBooking
  },
  {
    name: 'add-booking',
    path: '/add-booking',
    component: Booking
  }
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
