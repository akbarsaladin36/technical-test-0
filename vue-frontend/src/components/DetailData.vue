<template>
  <div class="container mt-5">
    <div class="row">
      <div class="col">
        <h1>Detail Data</h1>
          <div class="mt-3">
            <h4>Nama Lengkap: {{ users.name }}</h4>
            <h4>NIK: {{ users.nik }}</h4>
            <h4>Jenis Kelamin: {{ users.sex }}</h4>
            <h4>Alamat: {{ users.address }}</h4>
            <h4>Agama: {{ users.religion }}</h4>
            <h4>No. HP: {{ users.phone }}</h4>
          </div>
      </div>
      <div class="col">
        <button @click="goToEditData(users.id)" class="btn btn-success float-end">Update Data</button>
      </div>
    </div>

  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Detail Data",
  data(){
    return{
      users: []
    }
  },
  mounted(){
    this.getOne(this.$route.params.id)
  },
  methods: {
    getOne(id){
      axios.get(`http://localhost:8000/users/getId/${id}`).then((res)=>{
        this.users = res.data.result;
      })
      .catch((err)=>{
        console.log(err.response)
      })
    },
    goToEditData(id){
      this.$router.push({ name: 'Edit Data', params: {id}})
    }
  }
}
</script>