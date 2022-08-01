
 require('./bootstrap');

  import { createApp } from 'vue'
  import axios from 'axios';
  import VueAxios from 'vue-axios';
  import EmployeeList from './components/EmployeeList'
//   import  Employee  from "./components/Employee";


// notification 
import Swal from 'sweetalert2'
window.Swal=Swal;
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
});
window.Toast=Toast;

  
  const app = createApp()
  
  app.component('employee-list', EmployeeList)
//   app.component('employee', Employee)

 app.use(VueAxios, axios);
  app.mount('#app')