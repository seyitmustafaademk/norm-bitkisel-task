import axios from "axios";

let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
axios.defaults.withCredentials = true;
axios.defaults.headers.common['X-CSRF-TOKEN'] = token;

// Get basket information
axios.get('/api/user')
    .then(function (response) {
        console.log(response.data);
    })
    .catch(function (error) {
        console.error(error);
    });
