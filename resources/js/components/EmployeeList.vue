<template>
    <div style="margin-top:50px">
<form  @submit.prevent="uploadXlFile" enctype="multipart/form-data">
  <div class="form-group">
    <label for="exampleFormControlFile1">Employee Info file Upload</label>
    <input type="file" class="form-control-file" name="excelFile" @change="handleFile">
    <input type="submit" value="Upload" class="form-control-file">
  </div>
</form>
<div class="input-group">

  <form  @submit.prevent="dataFilter">
    <input type="search" class="form-control rounded" placeholder="Search" v-model="form.search"  />
    <button type="submit" class="btn btn-outline-primary">Filter</button>
  </form>
</div>
        <h2 class="text-center">Employee Information</h2>
 
        <table class="table">
            <thead>
            <tr>
                <th>Month</th>
                <th>Date</th>
                <th>Day</th>
                <th>Employee ID</th>
                <th>Employee Name</th>
                <th>Department</th>
                <th>First-In Time </th>
                <th>Last-Out Time</th>
                <th>Hours of Work</th>
            </tr>
            </thead>
            <tbody>
    
            <tr v-for="employee in employeeLists">
                <td>{{employee.month}}</td>
                <td>{{employee.date}}</td>
                <td>{{employee.day}}</td>
                <td>{{employee.employee_id}}</td>
                <td>{{employee.employee_name}}</td>
                <td>{{employee.department}}</td>
                 <span v-if="employee.first_in_time > this.time">
                    <td  style="background-color: red; color:#e2e8f0">{{employee.first_in_time}}  </td>
                 </span>
                  <span v-else>
                    <td  style="background-color: yellow; color:black">{{employee.first_in_time}}  </td>
                 </span>

                 <td >{{employee.first_in_time}}  </td>
           
                <td>{{employee.hours_of_work}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                employeeLists: [],
                 time:'10:00',
                
                form: {
                    dummy: 'Test text',
                    file:'', 
                    search:'',
                }
               
            

            }
            
        },
  
        methods: {

      
// Get all Data and filter funcation

             dataFilter(){
              this.axios.post('http://localhost:8000/api/filter', this.form)
                .then(res => {
                    this.employeeLists = res.data;
                })
           } ,

 // PDF Genarate Funcation
            genaratePDF(){
              this.axios.get('http://127.0.0.1:8000/api/pdf')
                .then(res => {
                    console.log(res);
                })
           } ,


  // file handle funcation
        handleFile(event) {
            this.form.file = event.target.files[0];   
        },

        // Upload XL file from local
             uploadXlFile() {
                let data = new FormData();
                data.append('file', this.form.file)
                axios.post('http://localhost:8000/api/upload', data)
                .then(res => {
                    this.dataFilter();
                })
            } ,

         
        },
           created(){
            this.dataFilter();
        }
     
    }
</script>