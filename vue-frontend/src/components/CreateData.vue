<template>
  <div class="container mt-5">
    <h1>Create Data</h1>
    <div class="alert alert-success mt-3" role="alert" v-if="isSuccess">{{ isSuccess }}</div>
    <div class="alert alert-danger mt-3" role="alert" v-else-if="isError">{{ isError }}</div>
    <form @submit.prevent="create">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
        <input type="text" v-model="form.fullName" class="form-control">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Jenis Kelamin</label>
        <input type="text" v-model="form.gender" class="form-control">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Agama</label>
        <input type="text" v-model="form.religion" class="form-control">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Alamat</label>
        <input type="text" v-model="form.phoneNumber" class="form-control">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">No. HP</label>
        <input type="text" v-model="form.address" class="form-control">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">NIK</label>
        <input type="text" v-model="form.NIK" class="form-control">
      </div>
      <button type="submit" class="btn btn-primary form-control mt-3">Create</button>
    </form>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Create Data",
  data(){
    return{
      form: {
        fullName: '',
        gender: '',
        religion: '',
        phoneNumber: '',
        address: '',
        NIK: ''
      },
      isSuccess: false,
      isError: false
    }
  },
  methods: {
    create(){
      const data = {
        fullName: this.form.fullName,
        gender: this.form.gender,
        religion: this.form.religion,
        phoneNumber: this.form.phoneNumber,
        address: this.form.address,
        NIK: this.form.NIK
      }
      axios.post('http://localhost:8000/users', data).then((res)=>{
        this.isSuccess = res.data.message;
        setTimeout(()=>{
          this.$router.push({ path: '/home' });
        }, 3000)
      })
      .catch((err)=>{
        console.log(err.response)
        this.isError = err.resoonse.data.message
      })
    }
  }
}
</script>