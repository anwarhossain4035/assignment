
 require('./bootstrap');

  import { createApp } from 'vue'
  import axios from 'axios';
  import VueAxios from 'vue-axios';
  import EmployeeList from './components/EmployeeList'
//   import  Employee  from "./components/Employee";
  
  const app = createApp()
  
  app.component('employee-list', EmployeeList)
//   app.component('employee', Employee)

 app.use(VueAxios, axios);
  app.mount('#app')