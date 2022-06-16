<template>
    <div>
        <h3 class="text-center">Add Client</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="AddClient">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="client.name">
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Add Client</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from "axios";
    export default {
        name: "AddClient",
        data() {
            return {
                client: {}
            }
        },
        methods: {
            AddClient() {
                axios.post('http://localhost:8000/api/add-client', this.client)
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