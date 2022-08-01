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
    <input type="search" class="form-control rounded" placeholder="Search By ID" v-model="form.search"  />
    <button type="submit" class="btn btn-outline-primary">Filter By Only ID</button>
  </form>
</div>
        <button type="button" @click="genaratePDF" target="_blank" class="btn btn-warning float-right ml-2">PDF Generate</button>
        <h2 class="text-center">Employee Information</h2>

        <table class="table" id="pdf" >
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

            <tr v-for="employee in employeeLists" :key="employee.id">
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
import html2canvas from 'html2canvas'
import { jsPDF } from "jspdf";
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
              this.axios.post('/api/filter', this.form)
                .then(res => {
                    this.employeeLists = res.data;
                    console.log(this.employeeLists);
                })
           } ,

//  PDF Genarate Funcation
            genaratePDF(){
              window.html2canvas=html2canvas;
              var doc=new jsPDF('p','pt','a4');
              doc.html(document.querySelector('#pdf'),{
                callback:function(pdf){
                 pdf.save("employee.pdf");
                }
              })
            //   this.axios.get('/api/pdf')
            //     .then(res => {
            //         console.log(res.data);
            //         this.employeeLists = res.data;
            //     })
           } ,


  // file handle funcation
        handleFile(event) {
            this.form.file = event.target.files[0];
        },

        // Upload XL file from local
             uploadXlFile() {
                let data = new FormData();
                data.append('file', this.form.file)
                axios.post('/api/upload', data)
                .then(res => {
                   Toast.fire({
                   icon: "success",
                   title: "Upload successfully",
                  });

                    this.dataFilter();
                })
            } ,


        },
        computed:{
        },
           created(){
            this.dataFilter();
        }

    }
</script>
