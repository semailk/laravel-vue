<template>
    <div>
        <h3 class="text-center">Add Rent</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="AddRent">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="rent.name">
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Add Rent</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from "axios";
    export default {
        name: "AddRent",
        data() {
            return {
                rent: {}
            }
        },
        methods: {
            AddRent() {
                axios.post('http://localhost:8000/api/add-rent', this.rent)
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