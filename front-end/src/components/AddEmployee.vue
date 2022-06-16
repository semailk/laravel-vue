<template>
    <div>
        <h3 class="text-center">Add Employee</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="AddEmployee">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="employee.name">
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Add Employee</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from "axios";
    export default {
        name: "AddEmployee",
        data() {
            return {
                employee: {}
            }
        },
        methods: {
            AddEmployee() {
                axios.post('http://localhost:8000/api/add/employee', this.employee)
                    .then(
                        this.$router.push({name: 'home'})
                        // console.log(response.data)
                    )
                    .catch(error => console.log(error))
                    .finally(() => this.loading = false)
            }
        }
    }
</script>

<style scoped>

</style>