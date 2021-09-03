<template>
  <div class="container mt-5">
    <h1>Edit Data</h1>
    <div class="alert alert-success mt-3" role="alert" v-if="isSuccess">{{ isSuccess }}</div>
    <div class="alert alert-danger mt-3" role="alert" v-else-if="isError">{{ isError }}</div>
    <form @submit.prevent="updateData(this.$route.params.id)">
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
      <button type="submit" class="btn btn-primary form-control mt-3">Update</button>
    </form>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Edit Data",
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
      user: '',
      isSuccess: false,
      isError: false
    }
  },
  mounted(){
    this.getOne(this.$route.params.id)
  },
  methods: {
    getOne(id){
      axios.get(`http://localhost:8000/users/getId/${id}`).then((res)=>{
        this.form.fullName = res.data.result.name;
        this.form.gender = res.data.result.sex;
        this.form.religion = res.data.result.religion;
        this.form.address = res.data.result.address;
        this.form.phoneNumber = res.data.result.phone;
        this.form.NIK = res.data.result.nik;
      })
      .catch((err)=>{
        console.log(err.response)
      })
    },
    updateData(id){
      const data = {
        fullName: this.form.fullName,
        gender: this.form.gender,
        religion: this.form.religion,
        address: this.form.address,
        phoneNumber: this.form.phoneNumber,
        NIK: this.form.NIK
      }
      axios.patch(`http://localhost:8000/users/update/${id}`, data).then((res)=>{
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