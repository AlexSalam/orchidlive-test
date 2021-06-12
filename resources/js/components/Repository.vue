<template>
    <div class="container main-body">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header main-title"><h1>Projects for: {{ this.name }}</h1></div>
                    <div class="card-body">
                        <p class="error" v-if="error">{{ this.error }}</p>
                        <ul class="repository-list">
                            <li v-for="repository in this.repositories">
                                <h2 v-on:click="fetchCommitsFor(repository)" class="repo-title">{{ repository.full_name }}</h2>
                                <ul :id="repository.name" class="commits-list">
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {

        },
        props: {
            name: String,
            repositories: Array,
            error: String
        },
        methods: {
            fetchCommitsFor(repo)
            {
                axios.get('https://api.github.com/repos/' + repo.full_name + '/commits').then((response) => {

                    const data = response.data;
                    let html = '';
                    data.forEach((commit) => {
                        html += '<li>' + commit.commit.author.name + ' - ' + commit.commit.message + '</li>';
                    });
                    document.getElementById(repo.name).innerHTML = html;

                }).catch((error) => {
                    console.log(error);
                    console.error('Failed to fetch commits for ' + repo.full_name);
                });
            }
        }

    }
</script>

<style scoped>
    .main-body {
        margin-top: 40px;
    }

    .main-title {
        text-align: center;
    }

    .repository-list {
        list-style-type: none;
    }

    .error {
        color: red;
        font-weight: bold;
        font-size: 16px;
    }
</style>
