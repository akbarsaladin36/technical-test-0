<template>
  <div class="container mt-5">
    <h1>Data Rumah Sakit</h1>
    <div class="alert alert-success mt-3" role="alert" v-if="isSuccess">{{ isSuccess }}</div>
    <table class="table mt-3">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nama Lengkap</th>
      <th scope="col">Jenis Kelamin</th>
      <th scope="col">Agama</th>
      <th scope="col">Alamat</th>
      <th scope="col">No. HP</th>
      <th scope="col">NIK</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="(user, index) in users" :key="index">
      <th scope="row">{{user.id}}</th>
      <td>{{user.name}}</td>
      <td>{{user.sex}}</td>
      <td>{{user.religion}}</td>
      <td>{{user.address}}</td>
      <td>{{user.phone}}</td>
      <td>{{user.nik}}</td>
      <td>
        <div class="d-flex justify-content-between">
          <button class="btn btn-success" @click="goToDetail(user.id)">Detail</button>
          <button class="btn btn-danger" @click="deleteData(user.id)">Hapus</button>
        </div>
      </td>
    </tr>
  </tbody>
</table>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "Home",
  data(){
    return{
      users: '',
      isSuccess: false
    }
  },
  mounted(){
    this.getAll()
  },
  methods: {
    getAll(){
      axios.get('http://localhost:8000/users').then((res)=>{
        this.users = res.data.result;
      })
      .catch((err)=>{
        console.log(err.response)
      })
    },
    goToDetail(id){
      this.$router.push({ name: 'Detail Data', params: {id}})
    },
    deleteData(id){
      axios.delete(`http://localhost:8000/users/delete/${id}`).then((res)=>{
        this.getAll();
        this.isSuccess = res.data.message;
        setTimeout(()=>{
          this.$router.push({ path: '/home'})
        },3000)
      })
      .catch((err)=>{
        console.log(err.response)
      })
    }
  }
}
</script>